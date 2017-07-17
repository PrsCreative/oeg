<?php

namespace App\Http\Controllers\Frontend;

use App\Models\ContactInfo;
use App\Models\EducationInfo;
use App\Models\HighSchoolExchangeAdmissionTestLocation;
use App\Models\HighSchoolExchangeApplication;
use App\Models\HighSchoolExchangeExciteCampLocation;
use App\Models\HighSchoolExchangeParentInformationMeetingLocation;
use App\Models\OtherInfo;
use App\Models\PersonalInfo;
use Carbon\Carbon;
use DateTime;
use App\Models\City;
use App\Models\Country;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    public function index() {
        $user_id = Auth::user()->getAuthIdentifier();
        $hspApp = HighSchoolExchangeApplication::where('user_id',$user_id)->first();
        return view("frontend.users.dashboard.index",[
            'hspApp'    =>  $hspApp
        ]);
    }

    public function getInfoPage(User $userModel) {

        $data['user'] = $userModel->find(Auth::user()->getAuthIdentifier());

        //re-format source of apply
        $keepSourceOfApplies            = trans('source_of_apply');
        $keepKeySourceOfApplies         = array_keys($keepSourceOfApplies);
        $userSourceOfApplies            = explode(',',str_replace(' ','',$data['user']->getOtherInfo['source_of_apply']));
        $arrValueSourceOfApplies        = [];
        foreach ($userSourceOfApplies as $userSourceOfApply){
            if(in_array($userSourceOfApply,$keepKeySourceOfApplies)){
                $arrValueSourceOfApplies[]  =   $keepSourceOfApplies[$userSourceOfApply];
                continue;
            }
            $arrValueSourceOfApplies[]  =   $userSourceOfApply;
        }
        $data['user_source_of_apply']   =   implode(',',$arrValueSourceOfApplies);

        return view("frontend.users.dashboard.info",$data);
    }

    public function getStudentInfoPage(User $userModel,City $city)
    {
        if(session('hspApp')->status_editable == 'submit'){
            return redirect()->route('frontend.dashboard.student-info-detail.get');
        }

        $data['studentProfile']             = $userModel->findOrFail(Auth::user()->getAuthIdentifier());
        $data['provinceList']               = $city->orderBy('cityNameTH', 'ASC')->get()->toArray();

        return view("frontend.users.dashboard.student_info",$data);
    }

    public function getStudentInfoDetailPage(User $userModel,City $city)
    {
        if(session('hspApp')->status_editable != 'submit'){
            return redirect()->route('frontend.dashboard.student-info.get');
        }

        $data['studentProfile']             = $userModel->findOrFail(Auth::user()->getAuthIdentifier());

        return view("frontend.users.dashboard.student_info_detail",$data);
    }


    public function saveStudentInfo(Request $request)
    {
        // Validation
        $personaInfoRules = [
            'title'         => '',
            'firstname'     => 'required|regex:/^[ก-เ]+$/',
            'firstnameEn'   => 'required|regex:/^[a-zA-Z]+$/',
            'lastname'      => 'required|regex:/^[ก-เ]+$/',
            'lastnameEn'    => 'required|regex:/^[a-zA-Z]+$/',
            'nickname'      => 'required|regex:/^[ก-เ]+$/',
            'nicknameEn'    => 'required|regex:/^[a-zA-Z]+$/',
            'nationality'   => 'required',
            'provinceBorn'  => 'required',
            'countryBorn'   => 'required',
            'phone'         => 'required|min:10|regex:/^(0[0-9\s\-\(\)]*)$/',
            'phoneHome'     => ''
        ];

        $addressRules = [
            'addressParent'        => 'required',
            'addressProvince'      => 'required',
            'addressPostCode'      => 'required',
            'addressOrder'         => empty($request->input('addressOrderCheckbox')) ? '' : 'required',
            'addressOrderProvince' => empty($request->input('addressOrderCheckbox')) ? '' : 'required',
            'addressOrderPostcode' => empty($request->input('addressOrderCheckbox')) ? '' : 'required',
            'facebookId'           => '',
            'lineId'               => '',
        ];

        $contactInfo = [
            'relationship'          => 'required',
            'emergencyFirstName'    => 'required',
            'emergencyLastName'     => 'required',
            'emergencyPhone'        => 'required',
            'emergencyEmail'        => '',
            'dadFirstName'          => 'required',
            'dadLastName'           => 'required',
            'dadAge'                => '',
            'dadPhone'              => 'required',
            'dadEmail'              => '',
            'dadJob'                => 'required',
            'dadPosition'           => '',
            'dadOffice'             => '',
            'momFirstName'          => 'required',
            'momLastName'           => 'required',
            'momAge'                => '',
            'momPhone'              => 'required',
            'momEmail'              => '',
            'momJob'                => 'required',
            'momPosition'           => '',
            'momOffice'             => '',
        ];

        $educationInfo = [
            'schoolLevel'           => 'required',
            'studyProgram'          => '',
            'schoolName'            => 'required',
            'provinceSchool'        => 'required',
            'gpa'                   => 'required',
        ];

        $surveyInfo = [
            'haveVisa'                      => 'required',
            'hasJoin'                       => 'required',
            'hasJoinDesc'                   => '',
            'hasParent'                     => 'required',
            'hasParentDesc'                 => '',
            'hasExperience'                 => 'required',
            'hasExperienceDesc'             => '',
            'hasExperienceWith'             => '',
            'hasExperienceTime'             => '',
            'feelToBlackHuman'              => 'required',
            'feelToOtherFriend'             => 'required',
            'personalMedical'               => 'required',
            'personalMedicalDesc'           => '',
            'personalMedicalPhoom'          => 'required',
            'personalMedicalPhoomDesc'      => '',
            'personalMedicalDrug'           => 'required',
            'personalMedicalDrugDesc'       => '',
            'personalMedicalAnimal'         => 'required',
            'personalMedicalAnimalDesc'     => '',
            'personalMedicalFood'           => 'required',
            'personalMedicalFoodDesc'       => '',
            'toBeFuture'                    => 'required',
            'toBeFutureDesc'                => '',
            'reLearn'                       => 'required',
            'reLearnDesc'                   => '',
            'advantage'                     => 'required',
            'disAdvantage'                  => 'required',
            'hobbies'                       => '',
            'talent'                        => '',
            'sport'                         => '',
            'hasSportMan'                   => 'required',
            'hasSportManDesc'               => '',
            'music'                         => '',
            'useComputer'                   => empty($request->input('useComputer')) ? '' : 'integer|between:1,7',
            'useComputerFor'                => empty($request->input('useComputer')) ? '' : 'required',
            'socialMedia1'                  => '',
            'socialMedia2'                  => '',
            'socialMedia3'                  => '',
            'socialMedia4'                  => '',
            'feelToBlockInternet'           => '',
        ];

        $allRules = array_merge( $personaInfoRules, $addressRules, $contactInfo, $educationInfo, $surveyInfo);
        $ruleMessage = [
            'emergency-phone.regex' => 'Please input 0-9 letter and start with 0 only.',
            'phone.regex'           => 'Please input 0-9 letter and start with 0 only.',
            'regex'                 => 'Please input thai letter only.',
            'firstnameEn.regex'     => 'Please input english letter only.',
            'lastnameEn.regex'      => 'Please input english letter only.',
            'nicknameEn.regex'      => 'Please input english letter only.',
        ];

        $state = $request->get('state','edit');
        if($state == 'submit'){

            $validate = Validator::make($request->all(),$allRules,$ruleMessage);
            if ($validate->fails()) {
                $failRules = $validate->failed();
                $validateData = [];
                if(!empty($failRules)){
                    $firstKey = '';
                    foreach ($failRules as $key => $failRule){
                        $firstKey = $key;
                        break;
                    }

                    if(in_array($firstKey,array_keys($personaInfoRules))) $validateData['tab'] = 'personal_info';
                    elseif(in_array($firstKey,array_keys($addressRules))) $validateData['tab'] = 'address';
                    elseif(in_array($firstKey,array_keys($contactInfo))) $validateData['tab'] = 'contact_emergency';
                    elseif(in_array($firstKey,array_keys($educationInfo))) $validateData['tab'] = 'education_info';
                    elseif(in_array($firstKey,array_keys($surveyInfo))) $validateData['tab'] = 'survey';
                    else $validateData['tab'] = $request->get('tab');
                }
                return redirect()->route('frontend.dashboard.student-info.get', $validateData)->withErrors($validate)->withInput();
            }

        }

        //Save Data

        //high school exchange application
        $high_school_exchange_app = HighSchoolExchangeApplication::where('user_id', Auth::user()->getAuthIdentifier())->where('status_application', 'approved')->first();
        if(empty($high_school_exchange_app)){
            return redirect()->route('frontend.dashboard.info');
        }
        $high_school_exchange_app->state = $high_school_exchange_app->state <= 4 ? 4 : $high_school_exchange_app->state;
        $high_school_exchange_app->status_editable = $state == 'submit' ? 'submit' : 'edit';
        $high_school_exchange_app->save();


        //personal info
        $personal_info = PersonalInfo::where('user_id', Auth::user()->getAuthIdentifier())->first();
        $personal_info->title           = $request->input('title') == 'other' ? $request->input('title_specify') : $request->input('title');
        $personal_info->firstname       = $request->input('firstname');
        $personal_info->lastname        = $request->input('lastname');
        $personal_info->nickname        = $request->input('nickname');
        $personal_info->nationality     = $request->input('nationality');
        $personal_info->phone           = strlen($request->input('phone'))      == 10 ? $request->input('phone') : "0" . $request->input('phone');
        $personal_info->firstname_en    = $request->input('firstnameEn');
        $personal_info->lastname_en     = $request->input('lastnameEn');
        $personal_info->nickname_en     = $request->input('nicknameEn');
        $personal_info->phone_home      = strlen($request->input('phoneHome'))  == 10 ? $request->input('phoneHome') : "0" . $request->input('phoneHome');
        $personal_info->province_born   = $request->input('provinceBorn');
        $personal_info->country_born    = $request->input('countryBorn');

        //address
        $contact_info = ContactInfo::where('user_id', Auth::user()->getAuthIdentifier())->first();
        $contact_info->address_parent           = $request->input('addressParent');
        $contact_info->address_province         = $request->input('addressProvince');
        $contact_info->address_postcode         = $request->input('addressPostCode');
        $contact_info->address_order_checkbox   = $request->input('addressOrderCheckbox');
        $contact_info->address_order            = empty($request->input('addressOrderCheckbox')) ? '' : $request->input('addressOrder');
        $contact_info->address_order_province   = empty($request->input('addressOrderCheckbox')) ? '' : $request->input('addressOrderProvince');
        $contact_info->address_order_postcode   = empty($request->input('addressOrderCheckbox')) ? '' : $request->input('addressOrderPostcode');
        $personal_info->facebook                = $request->input('facebookId');
        $personal_info->line_id                 = $request->input('lineId');

        //contact emergency
        $contact_info->emergency_contact_relationship   = $request->input('relationship') == 'other' ? $request->input('relationship_specify') : $request->input('relationship');
        $contact_info->emergency_contact_name           = $request->input('emergencyFirstName');
        $contact_info->emergency_contact_surname        = $request->input('emergencyLastName');
        $contact_info->emergency_email                  = $request->input('emergencyEmail');
        $contact_info->emergency_phone                  = strlen($request->input('emergencyPhone')) == 10 ? $request->input('emergencyPhone') : "0" . $request->input('emergencyPhone');
        $contact_info->dad_firstname                    = $request->input('dadFirstName');
        $contact_info->dad_lastname                     = $request->input('dadLastName');
        $contact_info->dad_age                          = $request->input('dadAge');
        $contact_info->dad_phone = $request->input('dadPhone');
        $contact_info->dad_email = $request->input('dadEmail');
        $contact_info->dad_job = $request->input('dadJob');
        $contact_info->dad_position = $request->input('dadPosition');
        $contact_info->dad_office = $request->input('dadOffice');
        $contact_info->mom_firstname = $request->input('momFirstName');
        $contact_info->mom_lastname = $request->input('momLastName');
        $contact_info->mom_age = $request->input('momAge');
        $contact_info->mom_phone = $request->input('momPhone');
        $contact_info->mom_email = $request->input('momEmail');
        $contact_info->mom_job = $request->input('momJob');
        $contact_info->mom_position = $request->input('momPosition');
        $contact_info->mom_office = $request->input('momOffice');

        //education info
        $education_info = EducationInfo::where('user_id', Auth::user()->getAuthIdentifier())->first();
        $education_info->high_school_level = $request->input('schoolLevel');
        $education_info->study_program = $request->input('studyProgram');
        $education_info->school_name = $request->input('schoolName');
        $education_info->province = $request->input('provinceSchool');
        $education_info->gpa = $request->input('gpa');

        //survey
        $other_info = OtherInfo::where('user_id', Auth::user()->getAuthIdentifier())->first();
        $personal_info->has_american_visa = $request->input('haveVisa');

        $other_info->has_join = $request->input('hasJoin') == 'no' ? 'no' : $request->input('hasJoinDesc');
        $other_info->has_parent = $request->input('hasParent') == 'no' ? 'no' : $request->input('hasParentDesc');
        $other_info->has_experience = $request->input('hasExperience') == 'no' ? 'no' : $request->input('hasExperienceDesc');
        $other_info->has_experience_with = $request->input('hasExperienceWith');
        $other_info->has_experience_time = $request->input('hasExperienceTime');
        $other_info->feel_to_black_human = $request->input('feelToBlackHuman');
        $other_info->feel_to_other_friend = $request->input('feelToOtherFriend');
        $other_info->personal_medical = $request->input('personalMedical') == 'no' ? 'no' : $request->input('personalMedicalDesc');
        $other_info->personal_medical_phoom = $request->input('personalMedicalPhoom') == 'no' ? 'no' : $request->input('personalMedicalPhoomDesc');
        $other_info->personal_medical_drug = $request->input('personalMedicalDrug') == 'no' ? 'no' : $request->input('personalMedicalDrugDesc');
        $other_info->personal_medical_animal = $request->input('personalMedicalAnimal') == 'no' ? 'no' : $request->input('personalMedicalAnimalDesc');
        $other_info->personal_medical_food = $request->input('personalMedicalFood') == 'no' ? 'no' : $request->input('personalMedicalFoodDesc');
        $other_info->to_be_future = $request->input('toBeFuture');
        $other_info->to_be_future_desc = $request->input('toBeFutureDesc');
        $other_info->re_learn = $request->input('reLearn') == 'yes' ? $request->input('reLearnDesc') : 'no';
        $other_info->advantage = $request->input('advantage');
        $other_info->disadvantage = $request->input('disAdvantage');
        $other_info->hobbies = $request->input('hobbies');
        $other_info->talent = $request->input('talent');
        $other_info->sport = $request->input('sport');
        $other_info->has_sport_man = $request->input('hasSportMan') == 'yes' ? $request->input('hasSportManDesc') : 'no';
        $other_info->music = $request->input('music');
        $other_info->use_computer = $request->input('useComputer');
        $other_info->use_computer_for = $request->input('useComputerFor');
        $other_info->social_media1 = $request->input('socialMedia1');
        $other_info->social_media2 = $request->input('socialMedia2');
        $other_info->social_media3 = $request->input('socialMedia3');
        $other_info->feel_to_block_internet = $request->input('feelToBlockInternet');

        $tab = $request->get('tab','');

        $personal_info->save();
        $education_info->save();
        $contact_info->save();
        $other_info->save();

        //Redirect Data
        $data['tab']   = $tab;

        if($state == 'edit'){
            return redirect()->route('frontend.dashboard.student-info.get',$data);
        }

        return redirect()->route('frontend.dashboard.parent-information-meeting.get');
        //return redirect()->route('frontend.dashboard.student-info-detail.get');
    }

    public function getPaymentPage(User $userModel) {

        $data['user'] = $userModel->find(Auth::user()->getAuthIdentifier());

        return view("frontend.users.dashboard.payment",$data);
    }

    public function getApplyApplicationPage() {

        $user_id            = Auth::user()->getAuthIdentifier();
        $hasHspApp          = UserController::hasHspApplication($user_id);
        if($hasHspApp){
            return redirect()->route('frontend.dashboard.info');
        }

        $cities = City::all()->sortBy('cityNameEN');
        $data['cities']  =   $cities;

        return view("frontend.users.dashboard.apply_application",$data);
    }

    public function getUploadPage(User $userModel) {

        $user_id  = Auth::user()->getAuthIdentifier();
        $userAuth = $userModel->find($user_id);
        $jsonPathObj = (array)json_decode($userAuth->getHspAppInfo['json_file_path']);
        $data['transcript']     =   !empty($jsonPathObj['transcript'])      ? $jsonPathObj['transcript'] : null;
        $data['national_copy']  =   !empty($jsonPathObj['national_copy'])   ? $jsonPathObj['national_copy'] : null;

        return view("frontend.users.dashboard.upload",$data);
    }

    public function uploadPDF(Request $request,User $userModel) {

        $user_id  = Auth::user()->getAuthIdentifier();
        $userAuth = $userModel->find($user_id);
        $files = $request->file('file_upload');
        $type = $request->get("type");

        $validator = $this->validate($request, [
            'file_upload' => 'required',
            'file_upload.*' => 'required|max:2048|mimes:pdf,jpeg,png',
            "type" => "required"
        ], [
            "file_upload.*.mimes" => "Invalid file extension",
            "file_upload.*.max" => "Invalid file size",
            "file_upload.*.required" => "Required file upload",
            "file_upload.required" => "Required file upload"
        ]);

        $jsonPathObj = json_decode($userAuth->getHspAppInfo['json_file_path'],true);
//        $jsonPathObj = [];
        $prevCount = 0;
//        if(!empty($jsonPathObj[$type]['path'])) {
//            $prevCount = sizeof($jsonPathObj[$type]['path']);
//        }

        $isSuccess = false;
        $jsonPathObj[$type] = [];
        foreach ($files as $index => $file) {

            $extension = $file->getClientOriginalExtension();

            $indexAdding = $prevCount+$index;
            $userId         = Auth::user()->getAuthIdentifier();
            $date           = new DateTime();
            $dateText       = $date->format('Ymd_His');
            $uniqueFileName = $userId . "_" . $type . "_" . $dateText . "_" . $indexAdding . "." . $extension;

            // Check type for init data format
            if ($type == 'national_copy') {
                if( $file->move(public_path("") . "/uploads", $uniqueFileName ) ){
                    $jsonPathObj[$type]['path'] = "/uploads/$uniqueFileName";
                    $isSuccess = true;
                }
            } else {
                if( $file->move(public_path("") . "/uploads", $uniqueFileName ) ){
                    //prepare properties json obj file
                    $jsonPathObj[$type]['path'][$indexAdding]         = "/uploads/$uniqueFileName";
                    $isSuccess = true;
                }
            }

        }

        if($isSuccess) {
            $jsonPathObj[$type]['status_file']  = 'uploaded';
        }
        
        //save json obj to DB
        HighSchoolExchangeApplication::where('user_id', $user_id)
            ->update(
                [
                    'json_file_path'    =>  json_encode($jsonPathObj)
                ]
            );
        $data[$type.'_success']   =   'File uploaded successfully.';
//            $data[$type.'_uploaded']  =   "/uploads/$uniqueFileName";
        return redirect()->back()->with($data);
        
    }

    public function getHspAdmissionTestPage(Request $request)
    {
        $province = $request->get('province');
       
        $hspAppTest  = DB::table('users_high_school_exchange_application AS hsp_app')
            ->join('high_school_exchange_admission_test_location AS hsp_locate', 'hsp_app.admission_test_location_id', '=', 'hsp_locate.id')
            ->select('hsp_locate.*')
            ->where('hsp_app.user_id',Auth::user()->getAuthIdentifier())
            ->where('hsp_app.admission_test_location_id','!=',NULL)
            ->where('hsp_app.admission_test_location_id','!=','0')
            ->first();

        if(!empty($hspAppTest)) {
            return redirect()->route('frontend.dashboard.hsp-school-admission-test-detail.get');
        }

        //list of provinces
        $hspProvinces = HighSchoolExchangeAdmissionTestLocation::where('date','>=',Carbon::now()->toDateString())
            ->where('status','open')
            ->where('year','>=',Carbon::now()->year)
            ->where('province','!=',NULL)
            ->where('province','!=','')
            ->whereRaw(' amount > used ')
            ->groupBy('province')
            ->get();

        $hspAdmissionTestLocations = HighSchoolExchangeAdmissionTestLocation::where('date','>=',Carbon::now()->toDateString())
            ->where('status','open')
            ->where('year','>=',Carbon::now()->year)
            ->whereRaw(' amount > used ');

        //check province
        if(!empty($province)){
            $hspAdmissionTestLocations = $hspAdmissionTestLocations->where('province',$province);
        }
        $hspAdmissionTestLocations = $hspAdmissionTestLocations->paginate(env('PAGINATE_HSP_LOCATION',4));

        return view('frontend.users.dashboard.hsp_admission_test',[
            'hspAdmissionTestLocations'     =>  $hspAdmissionTestLocations,
            'hspProvinces'                  =>  $hspProvinces,
            'provinceSelected'              =>  $province
        ]);
    }

    public function getHspAdmissionTestDetailPage()
    {
        //validate hsp app
        $hspApp = HighSchoolExchangeApplication::where('user_id',Auth::user()->getAuthIdentifier())
            ->where('admission_test_location_id','!=',NULL)
            ->where('admission_test_location_id','!=','0')
            ->first();
        if(empty($hspApp)){
            return redirect()->route('frontend.dashboard.hsp-school-admission-test.get');
        }

        //validate hsp location
        $hspAdmissionTestLocation = HighSchoolExchangeAdmissionTestLocation::find($hspApp->admission_test_location_id);
        if(empty($hspAdmissionTestLocation)){
            return redirect()->route('frontend.dashboard.hsp-school-admission-test.get');
        }

        return view('frontend.users.dashboard.hsp_admission_test_book_detail',[
            'hspAdmissionTestLocation'    =>  $hspAdmissionTestLocation
        ]);
    }

    public function bookHspAdmissionTest(Request $request)
    {
        //validate
        $validate = Validator::make($request->all(),
            [
                'user_id'           =>
                    'required','numeric',
                    Rule::exists('users', 'id')->where(function($query) use ($request) {
                        $query->where('role', 'Student')
                            ->where('year', '>=', Carbon::now()->year)
                            ->whereRaw(' amount > used ');
                    }),
                'hsp_locate_id'     =>  [
                    'required','numeric',
                    Rule::exists('high_school_exchange_admission_test_location' , 'id')->where(function($query) use ($request) {
                        $query->where('status', 'open')
                            ->where('year', '>=', Carbon::now()->year)
                            ->whereRaw(' amount > used ');
                    }),
                ]
            ]);

        if ($validate->fails()) {
            return redirect()->route('frontend.dashboard.hsp-school-admission-test.get');
        }

        //transaction
        try{
            DB::beginTransaction();

            //update used hsp location
            HighSchoolExchangeAdmissionTestLocation::find($request->get('hsp_locate_id'))
                ->update([
                    'used' => DB::raw('used + 1'),
                ]);

            //update hsp test locate to user hsp app
            HighSchoolExchangeApplication::where('user_id', $request->get('user_id'))->first()
                ->update([
                    'admission_test_location_id'    =>  $request->get('hsp_locate_id')
                ]);

            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->route('frontend.dashboard.hsp-school-admission-test.get');
        }

        return  redirect()->route('frontend.dashboard.hsp-school-admission-test-detail.get');
    }

    public function getParentInformationMeetingPage(Request $request)
    {
        $province            = $request->get('province');

        $hspAppParentLocate  = DB::table('users_high_school_exchange_application AS hsp_app')
            ->join('high_school_exchange_parent_information_meeting_location AS parent_location', 'hsp_app.parent_location_id', '=', 'parent_location.id')
            ->select('parent_location.*')
            ->where('hsp_app.user_id',Auth::user()->getAuthIdentifier())
            ->where('hsp_app.parent_location_id','!=',NULL)
            ->where('hsp_app.parent_location_id','!=','0')
            ->first();

        if(!empty($hspAppParentLocate)) {
            return redirect()->route('frontend.dashboard.parent-information-meeting-detail.get');
        }

        //list of provinces
        $hspAppParentProvinces = HighSchoolExchangeParentInformationMeetingLocation::where('date','>=',Carbon::now()->toDateString())
            ->where('status','open')
            ->where('year','>=',Carbon::now()->year)
            ->where('province','!=',NULL)
            ->where('province','!=','')
            ->whereRaw(' amount > used ')
            ->groupBy('province')
            ->get();

        //list of parent info meetings
        $hspAppParents = HighSchoolExchangeParentInformationMeetingLocation::where('date','>=',Carbon::now()->toDateString())
            ->where('status','open')
            ->where('year','>=',Carbon::now()->year)
            ->whereRaw(' amount > used ');

        //check province
        if(!empty($province)){
            $hspAppParents = $hspAppParents->where('province',$province);
        }
        $hspAppParents = $hspAppParents->paginate(env('PAGINATE_HSP_LOCATION',4));

        return view('frontend.users.dashboard.parent_information_meeting',[
            'hspAppParents'             =>  $hspAppParents,
            'hspAppParentProvinces'     =>  $hspAppParentProvinces,
            'provinceSelected'          =>  $province
        ]);
    }

    public function getParentInformationMeetingDetailPage(Request $request)
    {
        $parent_location_id = $request->get('parent_locate_id');

        //validate case request detail page
        $hspAppParentLocate     = DB::table('users_high_school_exchange_application AS hsp_app')
            ->join('high_school_exchange_parent_information_meeting_location AS parent_location', 'hsp_app.parent_location_id', '=', 'parent_location.id')
            ->select('hsp_app.*')
            ->where('hsp_app.user_id',Auth::user()->getAuthIdentifier())
            ->where('hsp_app.parent_location_id','!=',NULL)
            ->where('hsp_app.parent_location_id','!=','0')
            ->first();

        if(empty($hspAppParentLocate) && empty($parent_location_id)){
            return redirect()->route('frontend.dashboard.parent-information-meeting.get');
        }

        $parent_location_id = !empty($parent_location_id) ? $parent_location_id : $hspAppParentLocate->parent_location_id;

        //validate case confirm page
        $hspAppParentLocate     = HighSchoolExchangeParentInformationMeetingLocation::find($parent_location_id);

        //decision view detail or confirm
        $view = empty($request->get('parent_locate_id')) ? 'frontend.users.dashboard.parent_information_meeting_detail' : 'frontend.users.dashboard.parent_information_meeting_confirm';

        return view( $view, [
            'hspAppParentLocate'    =>  $hspAppParentLocate
        ]);
    }

    public function bookParentInformationMeeting(Request $request)
    {
        //validate
        $validate = Validator::make($request->all(),
            [
                'user_id'               =>
                    'required','numeric',
                    Rule::exists('users', 'id')->where(function($query) use ($request) {
                        $query->where('role', 'Student')
                            ->where('year', '>=', Carbon::now()->year)
                            ->whereRaw(' amount > used ');
                }),
                'parent_locate_id'      =>  [
                    'required','numeric',
                    Rule::exists('high_school_exchange_parent_information_meeting_location' , 'id')->where(function($query) use ($request) {
                        $query->where('status', 'open')
                            ->where('year', '>=', Carbon::now()->year)
                            ->whereRaw(' amount > used ');
                    }),
                ],
                'amount'                =>  [
                    'required','numeric','min:1','max_compare_column_hsp_parent:'.$request->get('parent_locate_id')
                ]
            ],[
                'amount.max_compare_column_hsp_parent' => 'The :attribute may not be greater than available seat.'
            ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput()->with('parent_locate_id',$request->get('parent_locate_id'));
        }

        //transaction
        try{
            DB::beginTransaction();

            //update used parent location
            HighSchoolExchangeParentInformationMeetingLocation::find($request->get('parent_locate_id'))
                ->update([
                    'used' => DB::raw('used + '.$request->get('amount') ),
                ]);

            //update parent location to user hsp app
            HighSchoolExchangeApplication::where('user_id', $request->get('user_id'))->first()
                ->update([
                    'parent_location_id'        =>  $request->get('parent_locate_id'),
                    'parent_location_amount'    =>  $request->get('amount'),
                ]);

            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->route('frontend.dashboard.parent-information-meeting.get');
        }

        return  redirect()->route('frontend.dashboard.parent-information-meeting-detail.get');
    }

    public function getExciteCampPage(Request $request)
    {

        $province = $request->get('province');

        $exciteCamp  = DB::table('users_high_school_exchange_application AS hsp_app')
            ->join('high_school_exchange_excite_camp_location AS excite_camp', 'hsp_app.excite_camp_id', '=', 'excite_camp.id')
            ->select('excite_camp.*')
            ->where('hsp_app.user_id',Auth::user()->getAuthIdentifier())
            ->where('hsp_app.excite_camp_id','!=',NULL)
            ->where('hsp_app.excite_camp_id','!=','0')
            ->first();

        if(!empty($exciteCamp)) {
            return redirect()->route('frontend.dashboard.excite-camp-detail.get');
        }

        //list of provinces
        $exciteCampProvinces = HighSchoolExchangeExciteCampLocation::where('date','>=',Carbon::now()->toDateString())
            ->where('status','open')
            ->where('year','>=',Carbon::now()->year)
            ->where('province','!=',NULL)
            ->where('province','!=','')
            ->whereRaw(' amount > used ')
            ->groupBy('province')
            ->get();

        $exciteCamps = HighSchoolExchangeExciteCampLocation::where('date','>=',Carbon::now()->toDateString())
            ->where('status','open')
            ->where('year','>=',Carbon::now()->year)
            ->whereRaw(' amount > used ');

        //check province
        if(!empty($province)){
            $exciteCamps = $exciteCamps->where('province',$province);
        }
        $exciteCamps = $exciteCamps->paginate(env('PAGINATE_HSP_LOCATION',4));

        return view('frontend.users.dashboard.excite_camp',[
            'exciteCamps'               =>  $exciteCamps,
            'exciteCampProvinces'       =>  $exciteCampProvinces,
            'provinceSelected'          =>  $province
        ]);
    }

    public function getExciteCampDetailPage()
    {
        //validate hsp app
        $hspApp = HighSchoolExchangeApplication::where('user_id',Auth::user()->getAuthIdentifier())
            ->where('admission_test_location_id','!=',NULL)
            ->where('admission_test_location_id','!=','0')
            ->first();
        if(empty($hspApp)){
            return redirect()->route('frontend.dashboard.excite-camp.get');
        }

        //validate excite camp
        $exciteCamp = HighSchoolExchangeExciteCampLocation::find($hspApp->excite_camp_id);
        if(empty($exciteCamp)){
            return redirect()->route('frontend.dashboard.excite-camp.get');
        }

        return view('frontend.users.dashboard.excite_camp_detail',[
            'exciteCamp'    =>  $exciteCamp
        ]);
    }

    public function bookExciteCamp(Request $request)
    {
        //validate
        $validate = Validator::make($request->all(),
            [
                'user_id'           =>
                    'required','numeric',
                Rule::exists('users', 'id')->where(function($query) use ($request) {
                    $query->where('role', 'Student')
                        ->where('year', '>=', Carbon::now()->year)
                        ->whereRaw(' amount > used ');
                }),
                'excite_camp_id'     =>  [
                    'required','numeric',
                    Rule::exists('high_school_exchange_excite_camp_location' , 'id')->where(function($query) use ($request) {
                        $query->where('status', 'open')
                            ->where('year', '>=', Carbon::now()->year)
                            ->whereRaw(' amount > used ');
                    }),
                ]
            ]);

        if ($validate->fails()) {
            return redirect()->route('frontend.dashboard.excite-camp.get');
        }

        //transaction
        try{
            DB::beginTransaction();

            //update used excite camp
            HighSchoolExchangeExciteCampLocation::find($request->get('excite_camp_id'))
                ->update([
                    'used' => DB::raw('used + 1'),
                ]);

            //update hsp test locate to user hsp app
            HighSchoolExchangeApplication::where('user_id', $request->get('user_id'))->first()
                ->update([
                    'excite_camp_id'    =>  $request->get('excite_camp_id')
                ]);

            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->route('frontend.dashboard.excite-camp.get');
        }

        return  redirect()->route('frontend.dashboard.excite-camp-detail.get');
    }

}
