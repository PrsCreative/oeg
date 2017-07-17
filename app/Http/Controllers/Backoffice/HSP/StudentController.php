<?php

namespace App\Http\Controllers\Backoffice\HSP;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\ContactInfo;
use App\Models\EducationInfo;
use App\Models\HighSchoolExchangeAdmissionTestLocation;
use App\Models\HighSchoolExchangeApplication;
use App\Models\HighSchoolExchangeExciteCampLocation;
use App\Models\HighSchoolExchangeParentInformationMeetingLocation;
use App\Models\OtherInfo;
use App\Models\PersonalInfo;
use App\Repositories\Storage\HSPGlobalRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use DateTime;

class StudentController extends Controller {

    protected $hspAppModel;
    protected $userModel;

    public function __construct(HighSchoolExchangeApplication $hspAppModel, User $userModel)
    {
        $this->hspAppModel = $hspAppModel;
        $this->userModel = $userModel;
    }

    public function getStudentList()
    {
       $data = $this->hspAppModel;

        if(Input::has("search")) {

            $keyword = Input::get("search");
            $data = $this->hspAppModel->whereHas("getUserPersonalInfo", function ($query) use($keyword) {

                $query->where("firstname", "like", "%".$keyword."%")
                ->orWhere("lastname", "like", "%".$keyword."%")
                ->orWhere("nickname", "like", "%".$keyword."%")
                ->orWhere("email", "like", "%".$keyword."%")
                ->orWhere("phone", "=", $keyword)
                ->orWhere('national_id', 'LIKE', '%'.$keyword.'%');

                $birthdates = explode("/", $keyword);
                if(sizeof($birthdates) == 3) {
                    $birthdate = $birthdates[2] . "-" . $birthdates[1] . "-" . $birthdates[0];
                    $query->orWhere("date_of_birth", "=", $birthdate);
                }

            }) ->orWhereHas("getUserEducationInfo", function($query) use($keyword) {
                $query->where("gpa", "=", $keyword);
            })->orWhere(function ($query) use($keyword) {
                $query->where("status_application", "=", $keyword);
                $query->orWhere("status_payment", "=", $keyword);
                $query->orWhere("admission_test_status", "=", $keyword);
            });

        }

        $ret["page"] = empty(Input::get("page")) ? 1 : Input::get("page");
        $ret["limit"] = 10;
        $ret["studentList"] = $data->paginate($ret["limit"]);

        return view('backoffice.pages.hsp.student.list', $ret);
    }

    public function getStudentProfile($id)
    {
        $data['studentProfile'] = $this->userModel->findOrFail($id);
        $data['provinceList'] = City::orderBy('cityNameEN')->get();

        return view('backoffice.pages.hsp.student.profile', $data);
    }

    public function getExportStudentExcel(Request $request)
    {
        if ($request->has('search')) {

            if ($request->get('search'))
            $students = $this->hspAppModel
                ->where('status_application', $request->get('search'))
                ->orWhere('status_payment', $request->get('search'))
                ->get();
        } else {
            $students = $this->hspAppModel->get();
        }

        Excel::create('HSP_Student_List', function($excel) use ($students) {
            // Set the title
            $excel->setTitle('HSP Student List');

            // Chain the setters
            $excel->setCreator('OEG')->setCompany('OEG Company');

            $excel->sheet('Sheet1', function($sheet) use ($students) {
                $sheet->row(1, [
                    'ID','Title','Firstname','Lastname','Nickname','Email','Phone','National ID','BirthDate', "Nationality", "Line id",
                    "Personal Sickness", "Has American Visa", "High School Level", "Study Program", "School Name", "Province",
                    "GPA", "Apply Country 1", "Apply Country 2", "Status", "Emergency Contact Name", "Emergency Contact Relationship",
                    "Emergency Phone", "Emergency E-mail", "Teacher Name", "Promotion Code", "Source of Apply", 'Apply Date',
                    'Application Status', 'Payment Status', 'Payment Status 2', 'Transcript Status', 'Copy of identification card', 'Admission Test Location', 'Admission Test Status', 'Admission Test Score'
                ] );

                $sheet->row(2, [] );

                foreach($students as $key => $student) {
                    $stu_buff   = [];
                    $stu_buff[] = $key+1;
                    $stu_buff[] = $student->getUserPersonalInfo['title'];
                    $stu_buff[] = $student->getUserPersonalInfo['firstname'];
                    $stu_buff[] = $student->getUserPersonalInfo['lastname'];
                    $stu_buff[] = $student->getUserPersonalInfo['nickname'];
                    $stu_buff[] = $student->getUserPersonalInfo['email'];
                    $stu_buff[] = $student->getUserPersonalInfo['phone'];
                    $stu_buff[] = $student->getUserPersonalInfo['national_id'];
                    $stu_buff[] = $student->getUserPersonalInfo['date_of_birth'];
                    $stu_buff[] = $student->getUserPersonalInfo['nationality'];
                    $stu_buff[] = $student->getUserPersonalInfo['line_id'];
                    $stu_buff[] = $student->getUserPersonalInfo['personal_sickness'];
                    $stu_buff[] = $student->getUserPersonalInfo['has_american_visa'] ? "Yes" : "No";

                    $stu_buff[] = $student->getUserEducationInfo['high_school_level'];
                    $stu_buff[] = $student->getUserEducationInfo['study_program'];
                    $stu_buff[] = $student->getUserEducationInfo['school_name'];
                    $stu_buff[] = $student->getUserEducationInfo['province'];
                    $stu_buff[] = $student->getUserEducationInfo['gpa'];

                    $stu_buff[] = $student->country_to_apply_1;
                    $stu_buff[] = $student->country_to_apply_2;
                    $stu_buff[] = $student->status;

                    $stu_buff[] = $student->getUserContactInfo['emergency_contact_name'].' '.$student->getUserContactInfo['emergency_contact_surname'];
                    $stu_buff[] = $student->getUserContactInfo['emergency_contact_relationship'];
                    $stu_buff[] = $student->getUserContactInfo['emergency_phone'];
                    $stu_buff[] = $student->getUserContactInfo['emergency_email'];

                    $stu_buff[] = $student->getUserOtherInfo['teacher_name'];
                    $stu_buff[] = $student->getUserOtherInfo['promotion_code'];
                    $stu_buff[] = $student->getUserOtherInfo['source_of_apply'];

                    $stu_buff[] = $student->created_at;
                    $stu_buff[] = $student->status_application;
                    $stu_buff[] = $student->status_payment;
                    $stu_buff[] = $student->status_payment2;

                    // Status upload file
                    $uploadFile = json_decode($student->json_file_path, true);
                    $stu_buff[] = (isset($uploadFile['transcript']['status_file']) ? $uploadFile['transcript']['status_file'] : 'pending');
                    $stu_buff[] = (isset($uploadFile['national_copy']['status_file']) ? $uploadFile['national_copy']['status_file'] : 'pending');

                    $stu_buff[] = $student->getApplicationTestLocationInfo['name'];
                    $stu_buff[] = $student->admission_test_status;
                    $stu_buff[] = $student->admission_test_score;

                    $sheet->row($key+3, $stu_buff );
                }

            });

        })->export('xlsx');
    }

    public function getEditStudentProfile($id, City $city)
    {
        $data['studentProfile'] = $this->userModel->findOrFail($id);
        $data['provinceList'] = $city->orderBy('cityNameEN')->get();

        $data['admissionTestLocationList'] = HighSchoolExchangeAdmissionTestLocation::whereColumn('amount', '>', 'used')
            ->where('status', 'open')
            ->get();

        $data['pimLocationList'] = HighSchoolExchangeParentInformationMeetingLocation::whereColumn('amount', '>', 'used')
            ->where('status', 'open')
            ->get();

        $data['exciteLocationList'] = HighSchoolExchangeExciteCampLocation::whereColumn('amount', '>', 'used')
            ->where('status', 'open')
            ->get();

        $data['defaultTab'] = old('tab', 'true');

        return view('backoffice.pages.hsp.student.edit.edit', $data);
    }
    
    public function postEditPersonal($id)
    {
        // Validation
        $rules = [
            'title'             => '',
            'firstname'         => 'required|regex:/^[ก-เ]+$/',
            'lastname'          => 'required|regex:/^[ก-เ]+$/',
            'nickname'          => 'required|regex:/^[ก-เ]+$/',
            'national_id'       => 'required|numeric|digits:13',
            'date_of_birth'     => 'required|date_format:Y-m-d',
            'nationality'       => 'required',
            'phone'             => 'required|min:10|regex:/^(0[0-9\s\-\(\)]*)$/',
            'email'             => 'required|email',
            'line_id'           => '',
            'facebook'          => '',
            'personal_sickness' => '',
            'has_american_visa' => ''
        ];

        $ruleMessage = [
            'phone.regex'           => 'Please input 0-9 letter and start with 0 only.',
            'regex'                 => 'Please input thai letter only.',
        ];

        $this->validate(request(), $rules, $ruleMessage);

        // Update Personal Info
        $personalInfo = PersonalInfo::where('user_id', $id);

        $personalInfo->update(array_only(request()->all(), array_keys($rules)));

        // Update Remark
        $hspApp = HighSchoolExchangeApplication::where('user_id', $id);

        $hspApp->update(['remark' => request()->get('remark')]);

        return redirect()->route('backoffice.hsp.student-profile.get', $id);
    }

    public function postEditEducation($id)
    {
        // Validation
        $rules = [
            'high_school_level'     => 'required',
            'study_program'         => '',
            'school_name'           => 'required',
            'province'              => 'required',
            'gpa'                   => 'required|numeric|between:0.00,4.00',
        ];

        $this->validate(request(), $rules);

        // Update Personal Info
        $educationInfo = EducationInfo::where('user_id', $id);

        $educationInfo->update(array_only(request()->all(), array_keys($rules)));

        // Update Remark
        $hspApp = HighSchoolExchangeApplication::where('user_id', $id);

        $hspApp->update(['remark' => request()->get('remark')]);

        return redirect()->route('backoffice.hsp.student-profile.get', $id);
    }

    public function postEditContact($id)
    {
        // Validation
        $rules = [
            'emergency_contact_relationship'    => 'required',
            'emergency_contact_name'            => 'required',
            'emergency_contact_surname'         => 'required',
            'emergency_phone'                   => 'required|min:10|regex:/^(0[0-9\s\-\(\)]*)$/',
            'emergency_email'                   => 'nullable|email'
        ];

        $ruleMessage = [
            'emergency_phone.regex' => 'Please input 0-9 letter and start with 0 only.',
        ];

        $this->validate(request(), $rules, $ruleMessage);

        // Update Personal Info
        $contactInfo = ContactInfo::where('user_id', $id);

        $contactInfo->update(array_only(request()->all(), array_keys($rules)));

        // Update Remark
        $hspApp = HighSchoolExchangeApplication::where('user_id', $id);

        $hspApp->update(['remark' => request()->get('remark')]);

        return redirect()->route('backoffice.hsp.student-profile.get', $id);
    }

    public function postEditApplicant($id, HSPGlobalRepository $hspGlobalRepository)
    {
        $rules = [
            'status_application'        => 'required',
            'status_payment'            => 'required',
            'status_payment2'           => 'required',
            'json_file_path'            => '',
            'country_to_apply_1'        => 'required',
            'country_to_apply_2'        => '',
        ];

        $this->validate(request(), $rules);

        // Query HSP by ID
        $hspApp = HighSchoolExchangeApplication::where('user_id', $id);

        $hspAppDetail = $hspApp->first();

        // Default value from db
        request()['json_file_path'] = $hspAppDetail->json_file_path;

        // Check has change transcript upload status
        if (request()->get('transcript') == 'approved' || request()->get('transcript') == 'reject') {
            $tempJsonFilePath = json_decode(request()['json_file_path'], true);
            $tempJsonFilePath['transcript']['status_file'] = request()->get('transcript');
            request()['json_file_path'] = json_encode($tempJsonFilePath);
        }

        // Check has change transcript upload status
        if (request()->get('national_copy') == 'approved' || request()->get('national_copy') == 'reject') {
            $tempJsonFilePath = json_decode(request()['json_file_path'], true);
            $tempJsonFilePath['national_copy']['status_file'] = request()->get('national_copy');
            request()['json_file_path'] = json_encode($tempJsonFilePath);
        }

        // Check for change state to 2
        if ((request()->get('status_application') == 'approved') &&
            (request()->get('status_payment') == 'approved') &&
            ($hspAppDetail->state < 2)) {

            $rules['state'] = '';
            request()['state'] = 2;
        }

        // Update HSP App
        $hspApp->update(array_only(request()->all(), array_keys($rules)));

        // Update Remark
        $hspApp = HighSchoolExchangeApplication::where('user_id', $id);

        $hspApp->update(['remark' => request()->get('remark')]);

        if (request()->has('teacher_name')) {
            OtherInfo::where('user_id', $id)->update(['teacher_name' => request()->get('teacher_name')]);
        }

        // Change State to 5
        if (request()->get('status_payment2') == 'approved') {
            $hspGlobalRepository->changeStateHSPtoExciteCamp($id);
        }

        return redirect()->route('backoffice.hsp.student-profile.get', $id);
    }

    public function postEditAdmissionTest($id, HSPGlobalRepository $hspGlobalRepository)
    {
        $rules = [
            'admission_test_status'     => '',
            'admission_test_score'      => '',
            'admission_test_remark'     => '',
        ];

        // Check has change admission test location and check remaining for rule validation
        if (request()->has('admission_test_location_id')) {
            $rules['admission_test_location_id'] = 'compare_column:high_school_exchange_admission_test_location,'.request()->get('admission_test_location_id').',amount,>,used';
        }

        $this->validate(request(), $rules);

        // Query
        $hspApp = HighSchoolExchangeApplication::where('user_id', $id);

        // Check has change admission test location
        if (request()->has('admission_test_location_id')) {
            $hspGlobalRepository->studentChangeAdmissionTestLocationLogic($id, request()->get('admission_test_location_id'));
        }

        // Check has change admission_test_status is success
        if (request()->get('admission_test_status') == 'pass') {
            $hspAdmissionTestResult['statuspassfail'] = request()->get('admission_test_status');
            $hspAdmissionTestResult['score'] = request()->get('admission_test_score');
            
            $hspGlobalRepository->changeStateHSPtoStudentInfo($id, $hspAdmissionTestResult);
        }

        // Update HSP App
        $hspApp->update(array_only(request()->all(), array_keys($rules)));

        // Update Remark
        $hspApp = HighSchoolExchangeApplication::where('user_id', $id);

        $hspApp->update(['remark' => request()->get('remark')]);

        return redirect()->route('backoffice.hsp.student-profile.get', $id);
    }

    public function postEditPIM($id, HSPGlobalRepository $hspGlobalRepository)
    {

        $rules = [];

        // Query
        $hspApp = HighSchoolExchangeApplication::where('user_id', $id);

        $hspAppDetail = $hspApp->where('status_application', '!=' , 'reject')->first();

        // Check has change parent information location or amount for rule validation
        if (request()->get('parent_location_id') != $hspAppDetail->parent_location_id ||
            request()->get('parent_location_amount') != $hspAppDetail->parent_location_amount)
        {
            $newPIMDetail = HighSchoolExchangeParentInformationMeetingLocation::find(request()->get('parent_location_id'));

            $rules['parent_location_id'] = 'required';

            if (count($newPIMDetail) > 0) {
                $rules['parent_location_amount'] = 'required|numeric|min:1|max:'.($newPIMDetail['amount']-$newPIMDetail['used']);
            }
        }

        $this->validate(request(), $rules);

        // Check has change parent information location or amount
        if (request()->get('parent_location_id') != $hspAppDetail->parent_location_id ||
            request()->get('parent_location_amount') != $hspAppDetail->parent_location_amount) {

            $hspGlobalRepository->studentChangePIMLocationLogic(
                $hspAppDetail->parent_location_id,
                $hspAppDetail->parent_location_amount,
                request()->get('parent_location_id'),
                request()->get('parent_location_amount')
            );
        }

        // Update HSP App
        $hspApp->update(array_only(request()->all(), array_keys($rules)));

        // Update Remark
        $hspApp = HighSchoolExchangeApplication::where('user_id', $id);

        $hspApp->update(['remark' => request()->get('remark')]);

        return redirect()->route('backoffice.hsp.student-profile.get', $id);
    }

    public function postEditExCITECamp($id, HSPGlobalRepository $hspGlobalRepository)
    {
        $rules = [];

        // Query
        $hspApp = HighSchoolExchangeApplication::where('user_id', $id);

        $hspAppDetail = $hspApp->where('status_application', '!=' , 'reject')->first();

        // Check has change excite camp location
        if (request()->has('excite_camp_id')) {
            $rules['excite_camp_id'] = 'compare_column:high_school_exchange_excite_camp_location,'.request()->get('excite_camp_id').',amount,>,used';
        }

        $this->validate(request(), $rules);

        // Check has change ExCITE Camp Location
        if (request()->has('excite_camp_id')) {
            $hspGlobalRepository->studentChangeExCITECampLocationLogic(
                $hspAppDetail->excite_camp_id,
                request()->get('excite_camp_id')
            );
        }

        // Update HSP App
        $hspApp->update(array_only(request()->all(), array_keys($rules)));

        // Update Remark
        $hspApp = HighSchoolExchangeApplication::where('user_id', $id);

        $hspApp->update(['remark' => request()->get('remark')]);

        return redirect()->route('backoffice.hsp.student-profile.get', $id);
    }

    public function postEditStudentInfo($id)
    {
        // Validate Rule for Personal Information
        $userPersonalInfoRules = [
            'title'         => 'required',
            'firstname'     => 'required|regex:/^[ก-เ]+$/',
            'lastname'      => 'required|regex:/^[ก-เ]+$/',
            'nickname'      => 'required|regex:/^[ก-เ]+$/',
            'firstname_en'  => 'required|regex:/^[a-zA-Z]+$/',
            'lastname_en'   => 'required|regex:/^[a-zA-Z]+$/',
            'nickname_en'   => 'required|regex:/^[a-zA-Z]+$/',
            'phone_home'    => '',
            'phone'         => 'required|min:10|regex:/^(0[0-9\s\-\(\)]*)$/',
            'nationality'   => 'required',
            'province_born' => 'required',
            'country_born'  => 'required',
            'facebook'                  => '',
            'line_id'                   => '',
        ];

        // Validate Rule for Address && Emergency Contact
        $userContactInfoRules = [
            'address_parent'                    => 'required',
            'address_province'                  => 'required',
            'address_postcode'                  => 'required',
            'address_order_checkbox'            => 'required',
            'address_order'                     => '',
            'address_order_province'            => '',
            'address_order_postcode'            => '',
            'emergency_contact_relationship'    => 'required',
            'emergency_contact_name'            => 'required|required|regex:/^[ก-เ]+$/',
            'emergency_contact_surname'         => 'required|required|regex:/^[ก-เ]+$/',
            'emergency_phone'                   => 'required|min:10|regex:/^(0[0-9\s\-\(\)]*)$/',
            'emergency_email'                   => '',
            'dad_firstname'                     => 'required|required|regex:/^[ก-เ]+$/',
            'dad_lastname'                      => 'required|required|regex:/^[ก-เ]+$/',
            'dad_age'                           => '',
            'dad_phone'                         => 'required|min:10|regex:/^(0[0-9\s\-\(\)]*)$/',
            'dad_email'                         => '',
            'dad_job'                           => '',
            'dad_position'                      => '',
            'dad_office'                        => '',
            'mom_firstname'                     => 'required|required|regex:/^[ก-เ]+$/',
            'mom_lastname'                      => 'required|required|regex:/^[ก-เ]+$/',
            'mom_age'                           => '',
            'mom_phone'                         => 'required|min:10|regex:/^(0[0-9\s\-\(\)]*)$/',
            'mom_email'                         => '',
            'mom_job'                           => '',
            'mom_position'                      => '',
            'mom_office'                        => ''
        ];

        if (request()->get('address_order_checkbox') == 'on') {
            $userContactInfoRules['address_order'] = 'required';
            $userContactInfoRules['address_order_province'] = 'required';
            $userContactInfoRules['address_order_postcode'] = 'required';
        }

        // Validate Rule for Survey
        $userOtherInfoRules = [
            'has_join'                  => 'required',
            'has_parent'                => 'required',
            'has_experience'            => 'required',
            'has_experience_with'       => '',
            'has_experience_time'       => '',
            'feel_to_black_human'       => 'required',
            'feel_to_other_friend'      => 'required',
            'personal_medical'          => 'required',
            'personal_medical_phoom'    => 'required',
            'personal_medical_drug'     => 'required',
            'personal_medical_animal'   => 'required',
            'personal_medical_food'     => 'required',
            'to_be_future'              => 'required',
            'to_be_future_desc'         => 'required',
            're_learn'                  => 'required',
            'advantage'                 => 'required',
            'disadvantage'              => 'required',
            'hobbies'                   => '',
            'talent'                    => '',
            'sport'                     => '',
            'has_sport_man'             => 'required',
            'music'                     => '',
            'use_computer'              => 'numeric',
            'use_computer_for'          => '',
            'social_media1'             => '',
            'social_media2'             => '',
            'social_media3'             => '',
            'feel_to_block_internet'    => 'required'
        ];

        $this->validate(request(), array_merge($userPersonalInfoRules, $userContactInfoRules, $userOtherInfoRules));

        PersonalInfo::where('user_id', $id)->update(array_only(request()->all(), array_keys($userPersonalInfoRules)));
        ContactInfo::where('user_id', $id)->update(array_only(request()->all(), array_keys($userContactInfoRules)));
        OtherInfo::where('user_id', $id)->update(array_only(request()->all(), array_keys($userOtherInfoRules)));

        // Update Remark
        HighSchoolExchangeApplication::where('user_id', $id)->update(['remark' => request()->get('remark')]);

        return redirect()->route('backoffice.hsp.student-profile.get', $id);
    }

    public function getDeleteStudentProfile($id)
    {
        // Delete
        HighSchoolExchangeApplication::where('user_id', $id)->delete();
        PersonalInfo::where('user_id', $id)->delete();
        EducationInfo::where('user_id', $id)->delete();
        ContactInfo::where('user_id', $id)->delete();
        OtherInfo::where('user_id', $id)->delete();

        return redirect()->route('backoffice.hsp.student.get');
    }

    public function getUploadDocument($id, $documentType)
    {
        $data['id'] = $id;
        $data['documentType'] = $documentType;

        return view('backoffice.pages.hsp.student.upload', $data);
    }

    public function postUploadDocument($id, $documentType)
    {
        $rules = [
            'file_upload' => 'required',
            'file_upload.*' => 'required|max:2048|mimes:pdf,jpeg,png',
        ];

        $ruleMessage = [
            'file_upload.*.mimes'       => "Invalid file extension",
            'file_upload.*.max'         => "Invalid file size",
            'file_upload.*.required'    => "Required file upload",
            'file_upload.required'      => "Required file upload"
        ];

        $this->validate(request(), $rules, $ruleMessage);


        $userApp = HighSchoolExchangeApplication::where('user_id', $id)->first();
        $jsonPathObj = json_decode($userApp['json_file_path'],true);
        $type = str_replace('-', '_', $documentType);
        $prevCount = 0;
        $jsonPathObj[$type]['path'] = [];

        foreach (request()->file('file_upload') as $index => $file) {

            $extension = $file->getClientOriginalExtension();

            $indexAdding = $prevCount+$index;
            $date           = new DateTime();
            $dateText       = $date->format('Ymd_His');
            $uniqueFileName = $id . "_" . $type . "_" . $dateText . "_" . $indexAdding . "." . $extension;

            // Check type for init data format
            if ($type == 'national_copy') {
                if( $file->move(public_path("") . "/uploads", $uniqueFileName ) ){
                    $jsonPathObj[$type]['path'] = "/uploads/$uniqueFileName";
                }
            } else {
                if( $file->move(public_path("") . "/uploads", $uniqueFileName ) ){
                    $jsonPathObj[$type]['path'][$indexAdding] = "/uploads/$uniqueFileName";
                }
            }

            // Check has status not have default uploaded
            if (!isset($jsonPathObj[$type]['status_file']) || $jsonPathObj[$type]['status_file'] == 'pending') {
                $jsonPathObj[$type]['status_file'] = 'uploaded';
            }
        }

        HighSchoolExchangeApplication::where('user_id', $id)->update(['json_file_path' => json_encode($jsonPathObj)]);

        return redirect()->route('backoffice.hsp.student-profile.get', $id);
    }
}