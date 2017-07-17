@extends('frontend.users.dashboard_template')

@section('content')

    <!-- CSS  -->
    <link rel="stylesheet" href="{{ asset('css/apply-application.css') }}">
    <link rel="stylesheet" href="{{ asset('css/student_info.css') }}">
    <!-- End CSS -->

    <!-- JS  -->
    <script src="{{ asset('js/student_info.js') }}"></script>
    <!-- End JS  -->

        @if($errors->any())
            {!! '<div class="text-red font-size-detail">Pleas Check All Field</div>' !!}
        @endif

        {{--tab --}}
        <div class="row" style="height: 40px">
            <div class="col-md-2">
                <span id="nav_profile_personal_info" class="title-info font-size-detail font-blue display-none">Personal Info</span>
            </div>
            <div class="col-md-2">
                <span id="nav_profile_address" class="title-info font-size-detail font-blue display-none">Address</span>
            </div>
            <div class="col-md-2">
                <span id="nav_profile_contact_emergency" class="title-info font-size-detail font-blue display-none">Emergency Contact</span>
            </div>
            <div class="col-md-2">
                <span id="nav_profile_education_info" class="title-info font-size-detail font-blue display-none">Education</span>
            </div>
            <div class="col-md-2">
                <span id="nav_profile_survey" class="title-info font-size-detail font-blue display-none">Survey</span>
            </div>
        </div>

        <div class="row border-bottom border-top padding-bottom padding-top">
            <div class="col-md-2 text-center">
                <a href="#personal_info" class="nav_profile fa fa-file-text-o fa-lg" data-nav="personal_info" data-toggle="tab" aria-expanded="true"></a>
            </div>
            <div class="col-md-2 text-center">
                <a href="#address" class="nav_profile fa fa-home fa-lg" data-nav="address" data-toggle="tab" aria-expanded="false"></a>
            </div>
            <div class="col-md-2 text-center">
                <a href="#contact_emergency" class="nav_profile fa fa-users fa-lg" data-nav="contact_emergency" data-toggle="tab" aria-expanded="false"></a>
            </div>
            <div class="col-md-2 text-center">
                <a href="#education_info" class="nav_profile fa fa-graduation-cap fa-lg" data-nav="education_info" data-toggle="tab" aria-expanded="false"></a>
            </div>
            <div class="col-md-2 text-center">
                <a href="#survey" class="nav_profile fa fa-pencil fa-lg" data-nav="survey" data-toggle="tab" aria-expanded="false"></a>
            </div>
        </div>

        <?php
        $tab_parameter = request()->input('tab','personal_info');
        $expect_parameter = ['personal_info','address','contact_emergency','education_info','survey'];
        $tab_parameter = in_array($tab_parameter,$expect_parameter) ? $tab_parameter : 'personal_info';
        ?>

        <form id="form_student_info" action="{{ route('frontend.dashboard.student-info.post') }}" method="post">

            {{ csrf_field() }}

            <input type="hidden" id="tab" name="tab" value="{{ $tab_parameter }}">
            <input type="hidden" id="state" name="state" value="edit">

            {{--content--}}
            <div class="row tab-content">

                <!-- Personal Info -->
                <div class="tab-pane {{ $tab_parameter == 'personal_info' ? 'active' : '' }}" id="personal_info">

                    <div class="panel-heading border-bottom">
                        <h2 class="font-size-title font-blue">
                            Personal Info
                        </h2>
                    </div>

                    <div class="panel-body padding-none">

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="radio-inline">
                                    <input type="radio" id="title_mr" name="title"
                                           value="mr" {{ old('title', $studentProfile->getUserPersonalInfo['title']) == 'mr' ? 'checked' : 'checked'}} >
                                    Mr.
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" id="title_miss" name="title"
                                           value="miss" {{ old('title', $studentProfile->getUserPersonalInfo['title']) == 'miss' ? 'checked' : ''}}>
                                    Miss
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" id="title_other" name="title"
                                           value="other" {{ !in_array(old('title', $studentProfile->getUserPersonalInfo['title']),['mr','miss']) ? 'checked' : ''}}>
                                    Other
                                </label>
                                <input type="text" name="title_specify" class="form-control width-20 inline"
                                       value="{{ old('title_specify', '') }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('title').'</div>' !!}
                                {!! '<div class="text-red font-size-detail">'.$errors->first('title_specify').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="firstname" class="col-sm-3 font-th">ชื่อ (ไทย)*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="firstname" name="firstname"
                                       value="{{  old('firstname', $studentProfile->getUserPersonalInfo['firstname']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('firstname').'</div>' !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lastname" class="col-sm-3 font-th">นามสกุล (ไทย)*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="lastname" name="lastname"
                                       value="{{ old('lastname', $studentProfile->getUserPersonalInfo['lastname']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('lastname').'</div>' !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nickname" class="col-sm-3 font-th">ชื่อเล่น (ไทย)*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nickname" name="nickname"
                                       value="{{ old('nickname', $studentProfile->getUserPersonalInfo['nickname']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('nickname').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="firstname" class="col-sm-3">First Name(English) *</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="firstnameEn" name="firstnameEn"
                                       value="{{ old('firstnameEn', $studentProfile->getUserPersonalInfo['firstname_en']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('firstnameEn').'</div>' !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lastname" class="col-sm-3">Last Name(English) *</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="lastnameEn" name="lastnameEn"
                                       value="{{ old('lastnameEn', $studentProfile->getUserPersonalInfo['lastname_en']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('lastnameEn').'</div>' !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nickname" class="col-sm-3">Nick Name(English) *</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nicknameEn" name="nicknameEn"
                                       value="{{ old('nicknameEn', $studentProfile->getUserPersonalInfo['nickname_en']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('nicknameEn').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 font-th" for="phone">โทรศัพท์บ้าน</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="phoneHome" name="phoneHome"
                                       value="{{ old('phoneHome', $studentProfile->getUserPersonalInfo['phone_home']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('phoneHome').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 font-th" for="phone">เบอร์ติดต่อ (นักเรียน)*</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="phone" name="phone"
                                       value="{{ old('phone', $studentProfile->getUserPersonalInfo['phone']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('phone').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">สัญชาติ*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nationality" name="nationality"
                                       value="{{ old('nationality', $studentProfile->getUserPersonalInfo['nationality']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('nationality').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">จังหวัดที่เกิด*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="provinceBorn" name="provinceBorn"
                                       value="{{ old('provinceBorn', $studentProfile->getUserPersonalInfo['province_born']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('provinceBorn').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">ประเทศที่เกิด*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="countryBorn" name="countryBorn"
                                       value="{{ old('countryBorn', $studentProfile->getUserPersonalInfo['country_born']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('countryBorn').'</div>' !!}
                            </div>
                        </div>


                        <div class="box-footer">
                            <div class="col-md-3">
                                <button type="submit" class="btn-blue">Save</button>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn-green btn-next">Next</button>
                            </div>
                        </div>


                    </div>

                </div><!-- /.tab-pane -->

                <!-- Address -->
                <div class="tab-pane {{ $tab_parameter == 'address' ? 'active' : '' }}" id="address">

                    <div class="panel-heading border-bottom">
                        <h2 class="font-size-title font-blue">
                            Address
                        </h2>
                    </div>

                    <div class="panel-body padding-none">

                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">ที่อยู่ปัจจุบัน*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="addressParent" name="addressParent" value="{{ old('addressParent', $studentProfile->getContactInfo['address_parent']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('addressParent').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="province_born" class="col-sm-3 font-th">จังหวัด*</label>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select id="province_born" name="addressProvince" class="form-control">
                                        @foreach($provinceList as $province)
                                            <option value="{{ $province['cityNameTH'] }}" {{ old('addressProvince', $studentProfile->getContactInfo['address_province']) == $province['cityNameTH'] ? 'selected' : '' }}>{{ $province['cityNameTH'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {!! '<div class="text-red font-size-detail">'.$errors->first('addressProvince').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">รหัสไปรษณีย์*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="addressPostCode" name="addressPostCode" value="{{ old('addressPostCode', $studentProfile->getContactInfo['address_postcode']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('addressPostCode').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">Facebook ID</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="facebookId" name="facebookId" value="{{ old('facebookId', $studentProfile->getUserPersonalInfo['facebook']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('facebookId').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">Line ID</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="lineId" name="lineId" value="{{ old('lineId', $studentProfile->getUserPersonalInfo['line_id']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('lineId').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <input class="col-sm-1" type="checkbox" id="addressOrderCheckbox" name="addressOrderCheckbox" {{ empty(old('addressOrderCheckbox', $studentProfile->getContactInfo['address_order_checkbox'])) ? '' : 'checked' }} >
                            <label for="addressOrderCheckbox" class="col-sm-7 font-th cursor-pointer">ที่อยู่ในการจัดส่งข้อมูลแตกต่างจากที่อยู่ข้างต้น</label>
                        </div>

                        <div class="form-group address-order">

                            <div class="row">
                                <label for="province_born" class="col-sm-3 font-th">ที่อยู่ที่ใช้จัดส่ง *</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="addressOrder" name="addressOrder" value="{{ old('addressOrder', $studentProfile->getContactInfo['address_order']) }}">
                                    {!! '<div class="text-red font-size-detail">'.$errors->first('addressOrder').'</div>' !!}
                                </div>
                            </div>

                            <div class="row margin-top">
                                <label for="province_born" class="col-sm-3 font-th">จังหวัด *</label>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <select id="addressOrderProvince" name="addressOrderProvince" class="form-control">
                                            @foreach($provinceList as $province)
                                                <option value="{{ $province['cityNameTH'] }}" {{ old('addressOrderProvince', $studentProfile->getContactInfo['address_order_province']) == $province['cityNameTH'] ? 'selected' : '' }}>{{ $province['cityNameTH'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {!! '<div class="text-red font-size-detail">'.$errors->first('addressOrderProvince').'</div>' !!}
                                </div>
                            </div>

                            <div class="row">
                                <label for="nationality" class="col-sm-3 font-th">รหัสไปรษณีย์ *</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="addressOrderPostcode" name="addressOrderPostcode" value="{{ old('addressOrderPostcode', $studentProfile->getContactInfo['address_order_postcode']) }}">
                                    {!! '<div class="text-red font-size-detail">'.$errors->first('addressOrderPostcode').'</div>' !!}
                                </div>
                            </div>

                        </div>

                        <div class="box-footer">
                            <div class="col-md-3">
                                <button type="submit" class="btn-blue">Save</button>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn-green btn-next">Next</button>
                            </div>
                        </div>

                    </div>

                </div><!-- /.tab-pane -->

                <!-- Contact Emergency -->
                <div class="tab-pane {{ $tab_parameter == 'contact_emergency' ? 'active' : '' }}" id="contact_emergency">

                    <div class="panel-heading border-bottom">
                        <h2 class="font-size-title font-blue">
                            Emergency Contact
                        </h2>
                    </div>

                    <div class="panel-body padding-none">

                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">ความสัมพันธ์*</label>
                            <div class="col-sm-9">
                                <label class="radio-inline">
                                    <input type="radio" id="relationship_father" name="relationship" value="father" {{ old('relationship', $studentProfile->getContactInfo['emergency_contact_relationship']) == 'father' ? 'checked' : 'checked'}}> Father
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="relationship" value="mother" {{ old('relationship', $studentProfile->getContactInfo['emergency_contact_relationship']) == 'mother' ? 'checked' : ''}}> Mother
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="relationship" value="other" {{ !in_array(old('relationship', $studentProfile->getContactInfo['emergency_contact_relationship']),['father','mother']) ? 'checked' : ''}}> Other
                                </label>
                                <input type="text" name="relationship_specify" class="form-control width-40 inline" value="{{ old('relationship_specify', $studentProfile->getContactInfo['emergency_contact_relationship']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('relationship').'</div>' !!}
                                {!! '<div class="text-red font-size-detail">'.$errors->first('relationship_specify').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="relationshipName" class="col-sm-3 font-th">ชื่อ-ผู้ที่ติดต่อได้ในกรณีฉุกเฉิน (ไทย)*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="emergencyFirstName" name="emergencyFirstName" value="{{ old('emergencyFirstName', $studentProfile->getContactInfo['emergency_contact_name']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('emergencyFirstName').'</div>' !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">นามสกุล (ไทย)*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="emergencyLastName" name="emergencyLastName" value="{{ old('emergencyLastName', $studentProfile->getContactInfo['emergency_contact_surname']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('emergencyLastName').'</div>' !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">เบอร์ติดต่อ*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="emergencyPhone" name="emergencyPhone" value="{{ old('emergencyPhone', $studentProfile->getContactInfo['emergency_phone']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('emergencyPhone').'</div>' !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emergency_email" class="col-sm-3">Email</label>
                            <div class="col-sm-9">
                                <input type="email" id="emergencyEmail" class="form-control" name="emergencyEmail" placeholder="Email" value="{{ old('emergencyEmail', $studentProfile->getContactInfo['emergency_email']) }}" >
                                {!! '<div class="text-red font-size-detail">'.$errors->first('emergencyEmail').'</div>' !!}
                            </div>
                        </div>

                        {{--<h2 class="font-size-title">--}}
                            {{--บิดา--}}
                        {{--</h2>--}}
                        <div class="form-group row  margin-top-40">
                            <label for="nationality" class="col-sm-3 font-th">ชื่อ-บิดา (ไทย)*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="dadFirstName" name="dadFirstName" value="{{ old('dadFirstName', $studentProfile->getContactInfo['dad_firstname']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('dadFirstName').'</div>' !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">นามสกุล (ไทย)*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="dadLastName" name="dadLastName" value="{{ old('dadLastName', $studentProfile->getContactInfo['dad_lastname']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('dadLastName').'</div>' !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">อายุ</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="dadAge" name="dadAge" value="{{ old('dadAge', $studentProfile->getContactInfo['dad_age']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('dadAge').'</div>' !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">เบอร์ติดต่อ*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="dadPhone" name="dadPhone" value="{{ old('dadPhone', $studentProfile->getContactInfo['dad_phone']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('dadPhone').'</div>' !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emergency_email" class="col-sm-3">Email</label>
                            <div class="col-sm-9">
                                <input type="email" id="emergency_email" class="form-control" name="dadEmail" placeholder="Email" value="{{ old('dadEmail', $studentProfile->getContactInfo['dad_email']) }}" >
                                {!! '<div class="text-red font-size-detail">'.$errors->first('dadEmail').'</div>' !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">อาชีพ*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="dadJob" name="dadJob" value="{{ old('dadJob', $studentProfile->getContactInfo['dad_job']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('dadJob').'</div>' !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">ตำแหน่ง</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="dadPosition" name="dadPosition" value="{{ old('dadPosition', $studentProfile->getContactInfo['dad_position']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('dadPosition').'</div>' !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">สถานที่ทำงาน</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="dadOffice" name="dadOffice" value="{{ old('dadOffice', $studentProfile->getContactInfo['dad_office']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('dadOffice').'</div>' !!}
                            </div>
                        </div>

                        {{--<h2 class="font-size-title">--}}
                            {{--มารดา--}}
                        {{--</h2>--}}
                        <div class="form-group row margin-top-40">
                            <label for="nationality" class="col-sm-3 font-th">ชื่อ-มารดา (ไทย)*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="momFirstName" name="momFirstName" value="{{ old('momFirstName', $studentProfile->getContactInfo['mom_firstname']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('momFirstName').'</div>' !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">นามสกุล (ไทย)*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="momLastName" name="momLastName" value="{{ old('momLastName', $studentProfile->getContactInfo['mom_lastname']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('momLastName').'</div>' !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">อายุ</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="momAge" name="momAge" value="{{ old('momAge', $studentProfile->getContactInfo['mom_age']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('momAge').'</div>' !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">เบอร์ติดต่อ*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="momPhone" name="momPhone" value="{{ old('momPhone', $studentProfile->getContactInfo['mom_phone']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('momPhone').'</div>' !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emergency_email" class="col-sm-3">Email</label>
                            <div class="col-sm-9">
                                <input type="email" id="emergency_email" class="form-control" name="momEmail" placeholder="Email" value="{{ old('momEmail', $studentProfile->getContactInfo['mom_email']) }}" >
                                {!! '<div class="text-red font-size-detail">'.$errors->first('momEmail').'</div>' !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">อาชีพ*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="momJob" name="momJob" value="{{ old('momJob', $studentProfile->getContactInfo['mom_job']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('momJob').'</div>' !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">ตำแหน่ง</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="momPosition" name="momPosition" value="{{ old('momPosition', $studentProfile->getContactInfo['mom_position']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('momPosition').'</div>' !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">สถานที่ทำงาน</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="momOffice" name="momOffice" value="{{ old('momOffice', $studentProfile->getContactInfo['mom_office']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('momOffice').'</div>' !!}
                            </div>
                        </div>

                        <div class="box-footer">
                            <div class="col-md-3">
                                <button type="submit" class="btn-blue">Save</button>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn-green btn-next">Next</button>
                            </div>
                        </div>

                    </div>

                </div><!-- /.tab-pane -->

                <!-- Education Info -->
                <div class="tab-pane {{ $tab_parameter == 'education_info' ? 'active' : '' }}" id="education_info">

                    <div class="panel-heading border-bottom">
                        <h2 class="font-size-title font-blue">
                            Education Info
                        </h2>
                    </div>

                    <div class="panel-body padding-none">

                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">กำลังศึกษาอยู่ ชั้นมัธยมศึกษาปีที่*</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="schoolLevel">
                                    @for($i=1;$i<=6;$i++)
                                        <option value="m-{{$i}}" {{ old('schoolLevel', $studentProfile->getEducationInfo['high_school_level']) == "m-$i" ? 'selected' : ''}}>M {{$i}}</option>
                                    @endfor
                                </select>
                                {!! '<div class="text-red font-size-detail">'.$errors->first('schoolLevel').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">แผนการเรียน</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="studyProgram" name="studyProgram" value="{{ old('studyProgram', $studentProfile->getEducationInfo['study_program']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('studyProgram').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">โรงเรียน*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="schoolName" name="schoolName" value="{{ old('schoolName', $studentProfile->getEducationInfo['school_name'])  }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('schoolName').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">จังหวัด*</label>
                            <div class="col-sm-9">
                                <select id="provinceSchool" name="provinceSchool" class="form-control">
                                    @foreach($provinceList as $province)
                                        <option value="{{ $province['cityNameEN'] }}" {{ old('provinceSchool', $studentProfile->getEducationInfo['province']) == $province['cityNameEN'] ? 'selected' : '' }}>{{ $province['cityNameEN'] }}</option>
                                    @endforeach
                                </select>
                                {!! '<div class="text-red font-size-detail">'.$errors->first('provinceSchool').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">GPA ปีล่าสุด*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="gpa" name="gpa" value="{{ old('gpa', $studentProfile->getEducationInfo['gpa'])  }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('gpa').'</div>' !!}
                            </div>
                        </div>

                        <div class="box-footer">
                            <div class="col-md-3">
                                <button type="submit" class="btn-blue">Save</button>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn-green btn-next">Next</button>
                            </div>
                        </div>

                    </div>

                </div><!-- /.tab-pane -->

                <!-- Survey -->
                <div class="tab-pane {{ $tab_parameter == 'survey' ? 'active' : '' }}" id="survey">

                    <div class="panel-heading border-bottom">
                        <h2 class="font-size-title font-blue">
                            Survey
                        </h2>
                    </div>

                    <div class="panel-body padding-none">

                        <div class="form-group row">
                            <label for="nationality" class="col-sm-6 font-th">นักเรียนเคยได้รับวีซ่านักเรียนประเทศสหรัฐอเมริกา (วีซ่าประเภท J1 หรือ F1)*</label>
                            <div class="col-sm-6">
                                <label class="radio-inline">
                                    <input type="radio" id="relationship_father" name="haveVisa" value="0" {{ old('haveVisa', $studentProfile->getUserPersonalInfo['has_american_visa']) == 0 ? 'checked' : 'checked'}}> ไม่เคย
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="haveVisa" value="1" {{ old('haveVisa', $studentProfile->getUserPersonalInfo['has_american_visa']) == 1 ? 'checked' : ''}}> เคย
                                </label>
                                {!! '<div class="text-red font-size-detail">'.$errors->first('haveVisa').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-6 font-th" for="medical-problem">เคยเข้าร่วมโครงการนักเรียนแลกเปลี่ยนฯ หรือโครงการอื่นๆ ระหว่างประเทศหรือไม่*</label>
                            <div class="col-sm-6">
                                <label class="radio-inline">
                                    <input type="radio" id="hasJoin" name="hasJoin" value="no" {{ old('hasJoin', $studentProfile->getOtherInfo['has_join'])  == 'no' ? 'checked' : 'checked'}}> ไม่เคย
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" id="hasJoin" name="hasJoin" value="yes" {{ old('hasJoin', $studentProfile->getOtherInfo['has_join'])  != 'no' ? 'checked' : ''}}> เคย
                                </label>
                                <span class="margin-left">ระบุ</span>
                                <input type="text" name="hasJoinDesc" class="form-control width-40 inline" value="{{ old('hasJoinDesc', $studentProfile->getOtherInfo['has_join']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('hasJoin').'</div>' !!}
                                {!! '<div class="text-red font-size-detail">'.$errors->first('hasJoinDesc').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 font-th" for="medical-problem">มีญาติที่อาศัยอยู่ต่างประเทศไหม*</label>
                            <div class="col-sm-8">
                                <label class="radio-inline">
                                    <input type="radio" id="hasParent" name="hasParent" value="no" {{ old('hasParent', $studentProfile->getOtherInfo['has_parent'])  == 'no' ? 'checked' : 'checked'}}> ไม่มี
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" id="hasParent" name="hasParent" value="yes" {{ old('hasParent', $studentProfile->getOtherInfo['has_parent'])  != 'no' ? 'checked' : ''}}> มี
                                </label>
                                <span class="margin-left">ประเทศ</span>
                                <input type="text" name="hasParentDesc" class="form-control width-40 inline" value="{{ old('hasParentDesc', $studentProfile->getOtherInfo['has_parent']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('hasParent').'</div>' !!}
                                {!! '<div class="text-red font-size-detail">'.$errors->first('hasParentDesc').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 font-th" for="medical-problem">ประสบการณ์ไปต่างประเทศ*</label>
                            <div class="col-sm-8">
                                <label class="radio-inline">
                                    <input type="radio" id="hasExperience" name="hasExperience" value="no" {{ old('hasExperience', $studentProfile->getOtherInfo['has_experience'])  == 'no' ? 'checked' : 'checked'}}> ไม่เคย
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" id="hasExperience" name="hasExperience" value="yes" {{ old('hasExperience', $studentProfile->getOtherInfo['has_experience'])  != 'no' ? 'checked' : ''}}> เคย
                                </label>
                                <span class="margin-left exp-travel">ประเทศ</span>
                                <input type="text" name="hasExperienceDesc" class="form-control width-40 inline " value="{{ old('hasExperienceDesc', $studentProfile->getOtherInfo['has_experience']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('medical-problem').'</div>' !!}
                                {!! '<div class="text-red font-size-detail">'.$errors->first('specify').'</div>' !!}
                            </div>
                        </div>
                        <div class="form-group row exp-travel">
                            <div class="col-sm-offset-6 col-sm-6">
                                <span class="margin-left">เดินทางกับ</span>
                                <input type="text"
                                       name="hasExperienceWith"
                                       class="form-control width-60 inline"
                                       style="width: 150px"
                                       value="{{ old('hasExperienceWith', $studentProfile->getOtherInfo['has_experience_with']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('hasExperienceWith').'</div>' !!}
                            </div>
                        </div>
                        <div class="form-group row exp-travel">
                            <div class="col-sm-offset-6 col-sm-6">
                                <span class="margin-left">ระยะเวลา</span>
                                <input type="text"
                                       name="hasExperienceTime"
                                       class="form-control width-60 inline"
                                       value="{{ old('hasExperienceTime', $studentProfile->getOtherInfo['has_experience_time']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('hasExperienceTime').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 font-th" for="medical-problem">รู้สึกอย่างไร หากได้อยู่กับ Host Family เป็นคนสีผิว (เช่นผิวขาว/ผิวเหลือง/ผิวดำ)*</label>
                            <div class="col-sm-8">
                                <label class="radio-inline">
                                    <input type="radio" id="feelToBlackHuman" name="feelToBlackHuman" value="4" {{ old('feelToBlackHuman', $studentProfile->getOtherInfo['feel_to_black_human']) == '4' ? 'checked' : 'checked'}}> มากที่สุด
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" id="feelToBlackHuman" name="feelToBlackHuman" value="3" {{ old('feelToBlackHuman', $studentProfile->getOtherInfo['feel_to_black_human']) == '3' ? 'checked' : ''}}> มาก
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" id="feelToBlackHuman" name="feelToBlackHuman" value="2" {{ old('feelToBlackHuman', $studentProfile->getOtherInfo['feel_to_black_human']) == '2' ? 'checked' : ''}}> ปานกลาง
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" id="feelToBlackHuman" name="feelToBlackHuman" value="1" {{ old('feelToBlackHuman', $studentProfile->getOtherInfo['feel_to_black_human']) == '1' ? 'checked' : ''}}> น้อย
                                </label>
                                {!! '<div class="text-red font-size-detail">'.$errors->first('feelToBlackHuman').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 font-th" for="medical-problem">รู้สึกอย่างไรหากต้องอยู่ร่วมห้องกับคนอื่นในบ้าน*</label>
                            <div class="col-sm-8">
                                <label class="radio-inline">
                                    <input type="radio" id="feelToOtherFriend" name="feelToOtherFriend" value="4" {{ old('feelToOtherFriend', $studentProfile->getOtherInfo['feel_to_other_friend']) == '4' ? 'checked' : 'checked'}}> มากที่สุด
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" id="feelToOtherFriend" name="feelToOtherFriend" value="3" {{ old('feelToOtherFriend', $studentProfile->getOtherInfo['feel_to_other_friend']) == '3' ? 'checked' : ''}}> มาก
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" id="feelToOtherFriend" name="feelToOtherFriend" value="2" {{ old('feelToOtherFriend', $studentProfile->getOtherInfo['feel_to_other_friend']) == '2' ? 'checked' : ''}}> ปานกลาง
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" id="feelToOtherFriend" name="feelToOtherFriend" value="1" {{ old('feelToOtherFriend', $studentProfile->getOtherInfo['feel_to_other_friend']) == '1' ? 'checked' : ''}}> น้อย
                                </label>
                                {!! '<div class="text-red font-size-detail">'.$errors->first('feelToOtherFriend').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-5 font-th" for="medical-problem">โรคประจำตัว *</label>
                            <div class="col-sm-7">
                                <label class="radio-inline">
                                    <input type="radio" id="personalMedical" name="personalMedical" value="no" {{ old('personalMedical', $studentProfile->getOtherInfo['personal_medical']) == 'no' ? 'checked' : 'checked'}}> ไม่มี
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" id="personalMedical" name="personalMedical" value="yes" {{ old('personalMedical', $studentProfile->getOtherInfo['personal_medical']) != 'no' ? 'checked' : ''}}> มี
                                </label>
                                <span class="margin-left">ระบุ อาการ</span>
                                <input type="text" name="personalMedicalDesc" class="form-control width-40 inline" value="{{ old('personalMedicalDesc', $studentProfile->getOtherInfo['personal_medical']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('personalMedical').'</div>' !!}
                                {!! '<div class="text-red font-size-detail">'.$errors->first('personalMedicalDesc').'</div>' !!}

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-5 font-th" for="medical-problem">โรคภูมิแพ้*</label>
                            <div class="col-sm-7">
                                <label class="radio-inline">
                                    <input type="radio" id="personalMedicalPhoom" name="personalMedicalPhoom" value="no" {{ old('personalMedicalPhoom', $studentProfile->getOtherInfo['personal_medical_phoom']) == 'no' ? 'checked' : 'checked'}}> ไม่มี
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" id="personalMedicalPhoom" name="personalMedicalPhoom" value="yes" {{ old('personalMedicalPhoom', $studentProfile->getOtherInfo['personal_medical_phoom']) != 'no' ? 'checked' : ''}}> มี
                                </label>
                                <span class="margin-left">ระบุ อาการ</span>
                                <input type="text" name="personalMedicalPhoomDesc" class="form-control width-40 inline" value="{{ old('personalMedicalPhoomDesc', $studentProfile->getOtherInfo['personal_medical_phoom']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('personalMedicalPhoom').'</div>' !!}
                                {!! '<div class="text-red font-size-detail">'.$errors->first('personalMedicalPhoomDesc').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-5 font-th" for="medical-problem">แพ้ยา*</label>
                            <div class="col-sm-7">
                                <label class="radio-inline">
                                    <input type="radio" id="personalMedicalDrug" name="personalMedicalDrug" value="no" {{ old('personalMedicalDrug', $studentProfile->getOtherInfo['personal_medical_drug']) == 'no' ? 'checked' : 'checked'}}> ไม่มี
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" id="personalMedicalDrug" name="personalMedicalDrug" value="yes" {{ old('personalMedicalDrug', $studentProfile->getOtherInfo['personal_medical_drug']) != 'no' ? 'checked' : ''}}> มี
                                </label>
                                <span class="margin-left">ระบุ อาการ</span>
                                <input type="text" name="personalMedicalDrugDesc" class="form-control width-40 inline" value="{{ old('personalMedicalDrugDesc', $studentProfile->getOtherInfo['personal_medical_drug']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('personalMedicalDrug').'</div>' !!}
                                {!! '<div class="text-red font-size-detail">'.$errors->first('personalMedicalDrugDesc').'</div>' !!}

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-6 font-th" for="medical-problem">แพ้สัตว์*</label>
                            <div class="col-sm-6">
                                <label class="radio-inline">
                                    <input type="radio" id="personalMedicalAnimal" name="personalMedicalAnimal" value="no" {{ old('personalMedicalAnimal', $studentProfile->getOtherInfo['personal_medical_animal']) == 'no' ? 'checked' : 'checked'}}> ไม่มี
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" id="personalMedicalAnimal" name="personalMedicalAnimal" value="yes" {{ old('personalMedicalAnimal', $studentProfile->getOtherInfo['personal_medical_animal']) != 'no' ? 'checked' : ''}}> มี
                                </label>
                                <span class="margin-left">ระบุ อาการ</span>
                                <input type="text" name="personalMedicalAnimalDesc" class="form-control width-40 inline" value="{{ old('personalMedicalAnimalDesc', $studentProfile->getOtherInfo['personal_medical_animal']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('personalMedicalAnimal').'</div>' !!}
                                {!! '<div class="text-red font-size-detail">'.$errors->first('personalMedicalAnimalDesc').'</div>' !!}

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-6 font-th" for="medical-problem">แพ้อาหาร*</label>
                            <div class="col-sm-6">
                                <label class="radio-inline">
                                    <input type="radio" id="personalMedicalFood" name="personalMedicalFood" value="no" {{ old('personalMedicalFood', $studentProfile->getOtherInfo['personal_medical_food']) == 'no' ? 'checked' : 'checked'}}> ไม่มี
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" id="personalMedicalFood" name="personalMedicalFood" value="yes" {{ old('personalMedicalFood', $studentProfile->getOtherInfo['personal_medical_food']) != 'no' ? 'checked' : ''}}> มี
                                </label>
                                <span class="margin-left">ระบุ อาการ</span>
                                <input type="text" name="personalMedicalFoodDesc" class="form-control width-40 inline" value="{{ old('personalMedicalFoodDesc', $studentProfile->getOtherInfo['personal_medical_food']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('personalMedicalFood').'</div>' !!}
                                {!! '<div class="text-red font-size-detail">'.$errors->first('personalMedicalFoodDesc').'</div>' !!}

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">อนาคตอยากเป็นอะไร*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="toBeFuture" name="toBeFuture" value="{{ old('toBeFuture', $studentProfile->getOtherInfo['to_be_future']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('toBeFuture').'</div>' !!}
                            </div>
                            <label for="nationality" class="col-sm-1 font-th margin-top-10">เพราะ</label>
                            <div class="col-sm-6 margin-top-10">
                                <input type="text" class="form-control" id="toBeFutureDesc" name="toBeFutureDesc" value="{{ old('toBeFutureDesc', $studentProfile->getOtherInfo['to_be_future_desc']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('toBeFutureDesc').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-6 font-th" for="medical-problem">หากต้องกลับมาซ้ำชั้นเรียน*</label>
                            <div class="col-sm-6">
                                <label class="radio-inline">
                                    <input type="radio" id="reLearn" name="reLearn" value="yes" {{ old('reLearn', $studentProfile->getOtherInfo['re_learn']) != 'no' ? 'checked' : ''}}> ได้
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" id="reLearn" name="reLearn" value="no" {{ old('reLearn', $studentProfile->getOtherInfo['re_learn']) == 'no' ? 'checked' : 'checked' }}> ไม่ได้
                                </label>
                                <span class="margin-left">เพราะ</span>
                                <input type="text" name="reLearnDesc" class="form-control width-40 inline" value="{{request()->old('specify')}}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('reLearn').'</div>' !!}
                                {!! '<div class="text-red font-size-detail">'.$errors->first('reLearnDesc').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">คิดว่าตัวเองมีจุดเด่น/ข้อดีอะไรบ้าง*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="advantage" name="advantage" value="{{ old('advantage', $studentProfile->getOtherInfo['advantage']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('advantage').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">คิดว่าตัวเองมีจุดด้อย/ข้อเสียอะไรบ้าง*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="disAdvantage" name="disAdvantage" value="{{ old('disAdvantage', $studentProfile->getOtherInfo['disadvantage']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('disAdvantage').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">งานอดิเรก</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="hobbies" name="hobbies" value="{{ old('hobbies', $studentProfile->getOtherInfo['hobbies']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('hobbies').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">ความสามารถพิเศษ/รางวัลที่ได้รับ</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="talent" name="talent" value="{{ old('talent', $studentProfile->getOtherInfo['talent']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('talent').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">เล่นกีฬาอะไร</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="sport" name="sport" value="{{ old('sport', $studentProfile->getOtherInfo['sport']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('sport').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-6 font-th" for="medical-problem">เป็นนักกีฬาของโรงเรียน ?</label>
                            <div class="col-sm-6">
                                <label class="radio-inline">
                                    <input type="radio" id="hasSportMan" name="hasSportMan" value="no" {{ old('hasSportMan', $studentProfile->getOtherInfo['has_sport_man']) == 'no' ? 'checked' : 'checked' }}> ไม่เป็น
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" id="hasSportMan" name="hasSportMan" value="yes" {{ old('hasSportMan', $studentProfile->getOtherInfo['has_sport_man']) != 'no' ? 'checked' : ''}}> เป็น
                                </label>
                                <span class="margin-left">ระบุ</span>
                                <input type="text" name="hasSportManDesc" class="form-control width-40 inline" value="{{ old('hasSportManDesc', $studentProfile->getOtherInfo['has_sport_man']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('hasSportMan').'</div>' !!}
                                {!! '<div class="text-red font-size-detail">'.$errors->first('hasSportManDesc').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">เล่นดนตรีอะไรบ้าง</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="music" name="music" value="{{ old('music', $studentProfile->getOtherInfo['music']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('music').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">ใช้คอมพิวเตอร์เฉลี่ยกี่วัน/สัปดาห์</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="useComputer" name="useComputer" value="{{ old('useComputer', $studentProfile->getOtherInfo['use_computer']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('useComputer').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">ใช้คอมพิวเตอร์ทำอะไรบ้าง</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="useComputerFor" name="useComputerFor" value="{{ old('useComputerFor', $studentProfile->getOtherInfo['use_computer_for']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('useComputerFor').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">สื่อสังคมออนไลน์ (social Media) ที่ใช้บ่อยที่สุด</label>
                            <label for="nationality" class="col-sm-1 font-th">1</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="socialMedia1" name="socialMedia1" value="{{ old('socialMedia1', $studentProfile->getOtherInfo['social_media1']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('socialMedia1').'</div>' !!}
                            </div>
                            <label for="nationality" class="col-sm-1 font-th">2</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="socialMedia2" name="socialMedia2" value="{{ old('socialMedia2', $studentProfile->getOtherInfo['social_media2']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('socialMedia2').'</div>' !!}
                            </div>
                            <label for="nationality" class="col-sm-1 font-th">3</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="socialMedia3" name="socialMedia3" value="{{ old('socialMedia3', $studentProfile->getOtherInfo['social_media3']) }}">
                                {!! '<div class="text-red font-size-detail">'.$errors->first('socialMedia3').'</div>' !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nationality" class="col-sm-3 font-th">หากถูกกำหนดการเข้าถึง Internet / Social Network จะมีผลต่อชีวิตประจำวันมาก-น้อยเพียงไร</label>
                            <div class="col-sm-9">
                                <label class="radio-inline">
                                    <input type="radio" id="feelToBlockInternet" name="feelToBlockInternet" value="4" {{ old('feelToBlockInternet', $studentProfile->getOtherInfo['feel_to_block_internet']) == '4' ? 'checked' : 'checked'}}> มากที่สุด
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" id="feelToBlockInternet" name="feelToBlockInternet" value="3" {{ old('feelToBlockInternet', $studentProfile->getOtherInfo['feel_to_block_internet']) == '3' ? 'checked' : ''}}> มาก
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" id="feelToBlockInternet" name="feelToBlockInternet" value="2" {{ old('feelToBlockInternet', $studentProfile->getOtherInfo['feel_to_block_internet']) == '2' ? 'checked' : ''}}> ปานกลาง
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" id="feelToBlockInternet" name="feelToBlockInternet" value="1" {{ old('feelToBlockInternet', $studentProfile->getOtherInfo['feel_to_block_internet']) == '1' ? 'checked' : ''}}> น้อย
                                </label>
                                {!! '<div class="text-red font-size-detail">'.$errors->first('feelToBlockInternet').'</div>' !!}
                            </div>
                        </div>

                        <div class="box-footer">
                            <div class="col-md-3">
                                <button type="submit" class="btn-blue">Save</button>
                            </div>
                        </div>

                    </div>

                </div><!-- /.tab-pane -->

                <div class="box-footer display-none" id="submit_all_form">
                    <div class="row col-md-offset-6 col-md-6">
                        <button type="button" id="btn_all_submit" class="btn-green width-250">COMPLETE AND SUBMIT</button>
                    </div>
                </div>

            </div><!-- /.tab-content -->

        </form>

    @include('frontend.users.dashboard.modal.confirm_book',['msg_confirm' => ['th' => 'เมื่อ submit ข้อมูลแล้วจะไม่สามารถเปลี่ยนแปลงได้' , 'en' => 'Are You Sure ?'] ])

@endsection