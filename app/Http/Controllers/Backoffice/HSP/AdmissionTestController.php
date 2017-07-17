<?php

namespace App\Http\Controllers\Backoffice\HSP;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\HighSchoolExchangeAdmissionTestLocation;
use App\Repositories\Storage\HSPGlobalRepository;
use App\User;
use Maatwebsite\Excel\Facades\Excel;

class AdmissionTestController extends Controller {

    private $hspGlobalRepository;

    public function __construct(HSPGlobalRepository $hspGlobalRepository)
    {
        $this->hspGlobalRepository = $hspGlobalRepository;
    }

    public function getAdmissionTestList()
    {
        // Init param for pagination
        $data['page'] = ( !empty(request()->get('page')) ? request()->get('page') : 1 );
        $data['limit'] = ( !empty(request()->get('limit')) ? request()->get('limit') : 10 );

        // Check has search
        if (request()->has('search')) {
            $query = HighSchoolExchangeAdmissionTestLocation::where('year', 'LIKE', '%'.request()->get('search').'%');
            $query = $query->orWhere('province', 'LIKE', '%'.request()->get('search').'%');
            $query = $query->orWhere('name', 'LIKE', '%'.request()->get('search').'%');
            $query = $query->orWhere('status', 'LIKE', '%'.request()->get('search').'%');
        } else {
            $query = new HighSchoolExchangeAdmissionTestLocation();
        }

        // Query and Pagination
        $data['admissionTestList'] = $query->paginate($data['limit']);

        return view('backoffice.pages.hsp.admission-test.list', $data);
    }

    public function getCreateAdmissionTest()
    {
        // Province List
        $data['provinceList'] = City::orderBy('cityNameTH', 'ASC')->get();

        return view('backoffice.pages.hsp.admission-test.create', $data);
    }

    public function postCreateAdmissionTest()
    {
        $rules = [
            'year'      => 'required',
            'province'  => 'required',
            'name'      => 'required',
            'date'      => 'required',
            'amount'    => 'required|numeric',
            'status'    => 'required'
        ];

        $this->validate(request(), $rules);

        HighSchoolExchangeAdmissionTestLocation::create(array_only(request()->all(), array_keys($rules)));

        return redirect()->route('backoffice.hsp.admission-test.get');
    }

    public function getEditAdmissionTest($id)
    {
        $data['admissionTest'] = HighSchoolExchangeAdmissionTestLocation::findOrFail($id);

        // Province List
        $data['provinceList'] = City::orderBy('cityNameTH', 'ASC')->get();

        return view('backoffice.pages.hsp.admission-test.edit', $data);
    }

    public function postEditAdmissionTest($id)
    {
        $admissionTestDetail = HighSchoolExchangeAdmissionTestLocation::findOrFail($id);

        $rules = [
            'year'      => 'required',
            'province'  => 'required',
            'name'      => 'required',
            'date'      => 'required',
            'amount'    => 'required|numeric|min:'.$admissionTestDetail->used,
            'status'    => 'required'
        ];

        $this->validate(request(), $rules);

        $query = HighSchoolExchangeAdmissionTestLocation::findOrFail($id);

        $query->update(array_only(request()->all(), array_keys($rules)));

        return redirect()->route('backoffice.hsp.admission-test.get');
    }

    public function getDeleteAdmissionTest($id)
    {
        $query = HighSchoolExchangeAdmissionTestLocation::findOrFail($id);

        $query->delete();

        return redirect()->route('backoffice.hsp.admission-test.get');
    }

    public function getExportAdmissionTestExcel($id)
    {
        $location = HighSchoolExchangeAdmissionTestLocation::findOrFail($id);
        
        Excel::create($location->name, function ($excel) use ($location) {

            // Set the Title
            $excel->setTitle('Location '.$location->name);

            // Chain the setters
            $excel->setCreator('OEG')->setCompany('OEG Company');

            $studentList = $location->HSPStudentList()->get();

            $excel->sheet('Student List', function($sheet) use ($studentList, $location) {

                $sheet->row(1, [
                    'ID', 'Firstname', 'Lastname', 'Nickname', 'Phone', 'Email', 'Emergency Contact Name',
                    'Emergency Contact Relationship', 'Emergency Phone', 'Emergency E-mail', 'Admission Test Location Name'
                ]);

                foreach ($studentList as $key => $student) {
                    $stu_buff   = [];
                    $stu_buff[] = $key+1;
                    $stu_buff[] = $student->getUserPersonalInfo['firstname'];
                    $stu_buff[] = $student->getUserPersonalInfo['lastname'];
                    $stu_buff[] = $student->getUserPersonalInfo['nickname'];
                    $stu_buff[] = $student->getUserPersonalInfo['phone'];
                    $stu_buff[] = $student->getUserPersonalInfo['email'];
                    $stu_buff[] = $student->getUserContactInfo['emergency_contact_name'].' '.$student->getUserContactInfo['emergency_contact_surname'];
                    $stu_buff[] = $student->getUserContactInfo['emergency_contact_relationship'];
                    $stu_buff[] = $student->getUserContactInfo['emergency_phone'];
                    $stu_buff[] = $student->getUserContactInfo['emergency_email'];
                    $stu_buff[] = $location->name;

                    $sheet->row($key+2, $stu_buff);
                }

            });
        })->export('xlsx');;
    }
    
    public function getImportAdmissionTestResult()
    {
        return view('backoffice.pages.hsp.admission-test.import-result');
    }

    public function postImportAdmissionTestResult()
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
                return view('backoffice.pages.hsp.admission-test.import-result')->withErrors(['globalErrorMessage' => 'Import fail, Identify Id not correct all.']);
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
            return view('backoffice.pages.hsp.admission-test.import-result')->withErrors(['globalErrorMessage' => 'Import fail!.']);
        }
    }
}