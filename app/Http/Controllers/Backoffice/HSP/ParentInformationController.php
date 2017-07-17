<?php

namespace App\Http\Controllers\Backoffice\HSP;

use App\Http\Controllers\Controller;
use App\Models\HighSchoolExchangeParentInformationMeetingLocation;
use App\Models\City;
use App\User;
use Maatwebsite\Excel\Facades\Excel;

class ParentInformationController extends Controller
{
    public function getParentInformationLocationList()
    {
        // Init param for pagination
        $data['page'] = (!empty(request()->get('page')) ? request()->get('page') : 1);
        $data['limit'] = (!empty(request()->get('limit')) ? request()->get('limit') : 10);

        // Check has search
        if (request()->has('search')) {
            $query = HighSchoolExchangeParentInformationMeetingLocation::where('year', 'LIKE', '%' . request()->get('search') . '%');
            $query = $query->orWhere('province', 'LIKE', '%' . request()->get('search') . '%');
            $query = $query->orWhere('name', 'LIKE', '%' . request()->get('search') . '%');
            $query = $query->orWhere('status', 'LIKE', '%' . request()->get('search') . '%');
        } else {
            $query = new HighSchoolExchangeParentInformationMeetingLocation();
        }

        // Query and Pagination
        $data['pimLocationList'] = $query->paginate($data['limit']);

        return view('backoffice.pages.hsp.pim.list', $data);
    }

    public function getCreateParentInformationLocation()
    {
        // Province List
        $data['provinceList'] = City::orderBy('cityNameTH', 'ASC')->get();

        return view('backoffice.pages.hsp.pim.create', $data);
    }

    public function postCreateParentInformationLocation()
    {
        $rules = [
            'year' => 'required',
            'province' => 'required',
            'name' => 'required',
            'date' => 'required',
            'amount' => 'required|numeric',
            'status' => 'required'
        ];

        $this->validate(request(), $rules);

        HighSchoolExchangeParentInformationMeetingLocation::create(array_only(request()->all(), array_keys($rules)));

        return redirect()->route('backoffice.hsp.pim.location.list.get');
    }

    public function getEditParentInformationLocation($id)
    {
        $data['pimLocationDetail'] = HighSchoolExchangeParentInformationMeetingLocation::findOrFail($id);

        // Province List
        $data['provinceList'] = City::orderBy('cityNameTH', 'ASC')->get();

        return view('backoffice.pages.hsp.pim.edit', $data);
    }

    public function postEditParentInformationLocation($id)
    {
        $rules = [
            'year' => 'required',
            'province' => 'required',
            'name' => 'required',
            'date' => 'required',
            'amount' => 'required|numeric',
            'status' => 'required'
        ];

        $this->validate(request(), $rules);

        $query = HighSchoolExchangeParentInformationMeetingLocation::findOrFail($id);
        $query->update(array_only(request()->all(), array_keys($rules)));

        return redirect()->route('backoffice.hsp.pim.location.list.get');
    }

    public function getDeleteParentInformationLocation($id)
    {
        $query = HighSchoolExchangeParentInformationMeetingLocation::findOrFail($id);
        $query->delete();

        return redirect()->route('backoffice.hsp.pim.location.list.get');
    }

    public function getExportParentInformationLocationExcel($id)
    {
        $location = HighSchoolExchangeParentInformationMeetingLocation::findOrFail($id);

        Excel::create($location->name, function ($excel) use ($location) {

            // Set the Title
            $excel->setTitle('Location ' . $location->name);

            // Chain the setters
            $excel->setCreator('OEG')->setCompany('OEG Company');

            $studentList = $location->HSPStudentList()->get();

            $excel->sheet('Student List', function ($sheet) use ($studentList, $location) {

                $sheet->row(1, [
                    'ID', 'Firstname', 'Lastname', 'Phone', 'Email', 'Emergency Contact Name',
                    'Emergency Phone', 'Emergency E-mail', 'Amount', 'Location'
                ]);

                foreach ($studentList as $key => $student) {
                    $stu_buff = [];
                    $stu_buff[] = $key + 1;
                    $stu_buff[] = $student->getUserPersonalInfo['firstname'];
                    $stu_buff[] = $student->getUserPersonalInfo['lastname'];
                    $stu_buff[] = $student->getUserPersonalInfo['phone'];
                    $stu_buff[] = $student->getUserPersonalInfo['email'];
                    $stu_buff[] = $student->getUserContactInfo['emergency_contact_name'] . ' ' . $student->getUserContactInfo['emergency_contact_surname'];
                    $stu_buff[] = $student->getUserContactInfo['emergency_phone'];
                    $stu_buff[] = $student->getUserContactInfo['emergency_email'];
                    $stu_buff[] = $student->parent_location_amount;
                    $stu_buff[] = $location->name;

                    $sheet->row($key + 2, $stu_buff);
                }

            });
        })->export('xlsx');;
    }

    public function getImportParentInformationLocationResult()
    {
        return view('backoffice.pages.hsp.pim.import-result');
    }

    public function postImportParentInformationLocationResult()
    {
        // Validation
        $rules = [
            'import'    => 'required|mimes:xls,xlsx'
        ];

        $this->validate(request(), $rules);

        try {
            // Load Excel File
            $studentResultList = Excel::load(request()->file('import'), function ($reader) {});
            $tempForCount = Excel::load(request()->file('import'), function ($reader) {});

            // For check correct id all
            $studentResultListForCheck = collect($tempForCount->select(['identify_id'])->toArray());
            $studentResultListForCheck = $studentResultListForCheck->flatten();
            $countStudentResultList = User::whereIn('username', $studentResultListForCheck)->count();
            $studentResultListForCheck = array_filter($studentResultListForCheck->toArray());

            if (count($studentResultListForCheck) != $countStudentResultList) {
                return view('backoffice.pages.hsp.pim.import-result')->withErrors(['globalErrorMessage' => 'Import fail, Identify Id not correct all.']);
            }

            $studentResultList = $studentResultList->toArray();

            // Temp for check has student by Identify ID
            foreach ($studentResultList as $key => $studentResult) {
                $query = User::where('username', $studentResult['identify_id'])->first();

                if (count($query) > 0) {
                    if ($studentResult['statuspassfail'] == 'pass' || $studentResult['statuspassfail'] == 'fail') {
                        $this->hspGlobalRepository->changeStateHSPtoStudentInfo($query->id, $studentResult);
                    }
                }
            }

            return redirect()->back()->with('globalSuccessMessage', 'Import Success.');

        } catch (\Exception $e) {

            dd($e->getMessage());
            return view('backoffice.pages.hsp.pim.import-result')->withErrors(['globalErrorMessage' => 'Import fail!.']);
        }
    }
}