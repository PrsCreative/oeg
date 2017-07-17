<form action="{{ route('backoffice.hsp.student.edit-student.post', $studentProfile->id) }}" method="post">
    {{ csrf_field() }}

    <input type="hidden" name="tab" value="student_info">

    <!-- Personal Info -->
    <div class="row">
        <br>
        <div class="col-md-12">
            <h4>Personal Info</h4>
            <hr>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Title *</label>
                <select class="form-control" name="title">
                    <option value="mr" {{ (old('title', $studentProfile->getUserPersonalInfo['title']) == 'mr' ? 'selected' : '') }}>Mr</option>
                    <option value="miss" {{ (old('title', $studentProfile->getUserPersonalInfo['title']) == 'miss' ? 'selected' : '') }}>Miss</option>
                </select>
                {!! '<div class="text-red">'.$errors->first('title').'</div>' !!}
            </div>

            <div class="form-group">
                <label>ชื่อ *</label>
                <input type="text" class="form-control" name="firstname"
                       value="{{ old('firstname', $studentProfile->getUserPersonalInfo['firstname']) }}">
                {!! '<div class="text-red">'.$errors->first('firstname').'</div>' !!}
            </div>

            <div class="form-group">
                <label>นามสกุล *</label>
                <input type="text" class="form-control" name="lastname"
                       value="{{ old('lastname', $studentProfile->getUserPersonalInfo['lastname']) }}">
                {!! '<div class="text-red">'.$errors->first('lastname').'</div>' !!}
            </div>

            <div class="form-group">
                <label>ชื่อเล่น *</label>
                <input type="text" class="form-control" name="nickname"
                       value="{{ old('nickname', $studentProfile->getUserPersonalInfo['nickname']) }}">
                {!! '<div class="text-red">'.$errors->first('nickname').'</div>' !!}
            </div>

            <div class="form-group">
                <label>Firstname *</label>
                <input type="text" class="form-control" name="firstname_en"
                       value="{{ old('firstname_en', $studentProfile->getUserPersonalInfo['firstname_en']) }}">
                {!! '<div class="text-red">'.$errors->first('firstname_en').'</div>' !!}
            </div>

            <div class="form-group">
                <label>Lastname *</label>
                <input type="text" class="form-control" name="lastname_en"
                       value="{{ old('lastname_en', $studentProfile->getUserPersonalInfo['lastname_en']) }}">
                {!! '<div class="text-red">'.$errors->first('lastname_en').'</div>' !!}
            </div>

            <div class="form-group">
                <label>Nickname *</label>
                <input type="text" class="form-control" name="nickname_en"
                       value="{{ old('nickname_en', $studentProfile->getUserPersonalInfo['nickname_en']) }}">
                {!! '<div class="text-red">'.$errors->first('nickname_en').'</div>' !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>โทรศัพท์บ้าน</label>
                <input type="text" class="form-control" name="phone_home"
                       value="{{ old('phone_home', $studentProfile->getUserPersonalInfo['phone_home']) }}">
                {!! '<div class="text-red">'.$errors->first('phone_home').'</div>' !!}
            </div>

            <div class="form-group">
                <label>เบอร์ติดต่อ (นักเรียน) *</label>
                <input type="text" class="form-control" name="phone"
                       value="{{ old('phone', $studentProfile->getUserPersonalInfo['phone']) }}">
                {!! '<div class="text-red">'.$errors->first('phone').'</div>' !!}
            </div>

            <div class="form-group">
                <label>สัญชาติ *</label>
                <input type="text" class="form-control" name="nationality"
                       value="{{ old('nationality', $studentProfile->getUserPersonalInfo['nationality']) }}">
                {!! '<div class="text-red">'.$errors->first('nationality').'</div>' !!}
            </div>

            <div class="form-group">
                <label>จังหวัดที่เกิด *</label>
                <input type="text" class="form-control" name="province_born"
                       value="{{ old('province_born', $studentProfile->getUserPersonalInfo['province_born']) }}">
                {!! '<div class="text-red">'.$errors->first('province_born').'</div>' !!}
            </div>

            <div class="form-group">
                <label>ประเทศที่เกิด *</label>
                <input type="text" class="form-control" name="country_born"
                       value="{{ old('country_born', $studentProfile->getUserPersonalInfo['country_born']) }}">
                {!! '<div class="text-red">'.$errors->first('country_born').'</div>' !!}
            </div>
        </div>
    </div>

    <!-- Address -->
    <div class="row">
        <br>
        <div class="col-md-12">
            <h4>Address</h4>
            <hr>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>ที่อยู่ปัจจุบัน *</label>
                <input type="text" class="form-control" name="address_parent"
                       value="{{ old('address_parent', $studentProfile->getContactInfo['address_parent']) }}">
                {!! '<div class="text-red">'.$errors->first('address_parent').'</div>' !!}
            </div>

            <div class="form-group">
                <label>จังหวัด *</label>
                <select class="form-control" name="address_province">
                    @foreach($provinceList as $province)
                        <option value="{{ $province['cityNameTH'] }}" {{ (old('address_province', $studentProfile->getContactInfo['address_province']) == $province['cityNameTH'] ? 'selected' : '') }}>{{ $province['cityNameTH'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>รหัสไปรษณีย์ *</label>
                <input type="text" class="form-control" name="address_postcode"
                       value="{{ old('address_postcode', $studentProfile->getContactInfo['address_postcode']) }}">
                {!! '<div class="text-red">'.$errors->first('address_postcode').'</div>' !!}
            </div>

            <div class="form-group">
                <label>Facebook</label>
                <input type="text" class="form-control" name="facebook"
                       value="{{ old('facebook', $studentProfile->getUserPersonalInfo['facebook']) }}">
                {!! '<div class="text-red">'.$errors->first('facebook').'</div>' !!}
            </div>

            <div class="form-group">
                <label>Line ID</label>
                <input type="text" class="form-control" name="line_id"
                       value="{{ old('line_id', $studentProfile->getUserPersonalInfo['line_id']) }}">
                {!! '<div class="text-red">'.$errors->first('line_id').'</div>' !!}
            </div>

        </div>

        <div class="col-md-6">
            <div class="form-group">
                <input type="hidden" name="address_order_checkbox" value="off">
                <input type="checkbox" name="address_order_checkbox"
                       value="on" {{ (old('address_order_checkbox', $studentProfile->getContactInfo['address_order_checkbox']) == 'on' ? 'checked' : '') }}>
                <label>ที่อยู่ในการจัดส่งแตกต่างจากที่อยู่ปัจจุบัน</label>
            </div>

            <div class="form-group">
                <label>ที่อยู่ปัจจุบัน *</label>
                <input type="text" class="form-control" name="address_order"
                       value="{{ old('address_order', $studentProfile->getContactInfo['address_order']) }}">
                {!! '<div class="text-red">'.$errors->first('address_order').'</div>' !!}
            </div>

            <div class="form-group">
                <label>จังหวัด *</label>
                <select class="form-control" name="address_order_province">
                    @foreach($provinceList as $province)
                        <option value="{{ $province['cityNameTH'] }}" {{ (old('address_order_province', $studentProfile->getContactInfo['address_order_province']) == $province['cityNameTH'] ? 'selected' : '') }}>{{ $province['cityNameTH'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>รหัสไปรษณีย์ *</label>
                <input type="text" class="form-control" name="address_order_postcode"
                       value="{{ old('address_order_postcode', $studentProfile->getContactInfo['address_order_postcode']) }}">
                {!! '<div class="text-red">'.$errors->first('address_order_postcode').'</div>' !!}
            </div>
        </div>
    </div>

    <!-- Emergency Contact -->
    <div class="row">
        <br>
        <div class="col-md-12">
            <h4>Emergency Contact</h4>
            <hr>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>ความสัมพันธุ์ *</label>
                <input type="text" class="form-control" name="emergency_contact_relationship"
                       value="{{ old('emergency_contact_relationship', $studentProfile->getContactInfo['emergency_contact_relationship']) }}">
                {!! '<div class="text-red">'.$errors->first('emergency_contact_relationship').'</div>' !!}
            </div>

            <div class="form-group">
                <label>ชื่อ-ผู้ที่ติดต่อได้ในกรณีฉุกเฉิน (ไทย) *</label>
                <input type="text" class="form-control" name="emergency_contact_name"
                       value="{{ old('emergency_contact_name', $studentProfile->getContactInfo['emergency_contact_name']) }}">
                {!! '<div class="text-red">'.$errors->first('emergency_contact_name').'</div>' !!}
            </div>

            <div class="form-group">
                <label>นามสกุล *</label>
                <input type="text" class="form-control" name="emergency_contact_surname"
                       value="{{ old('emergency_contact_surname', $studentProfile->getContactInfo['emergency_contact_surname']) }}">
                {!! '<div class="text-red">'.$errors->first('emergency_contact_surname').'</div>' !!}
            </div>

            <div class="form-group">
                <label>เบอร์ติดต่อ *</label>
                <input type="text" class="form-control" name="emergency_phone"
                       value="{{ old('emergency_phone', $studentProfile->getContactInfo['emergency_phone']) }}">
                {!! '<div class="text-red">'.$errors->first('emergency_phone').'</div>' !!}
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="emergency_email"
                       value="{{ old('emergency_email', $studentProfile->getContactInfo['emergency_email']) }}">
                {!! '<div class="text-red">'.$errors->first('emergency_email').'</div>' !!}
            </div>

            <div class="form-group">
                <label>ชื่อ-บิดา (ไทย) *</label>
                <input type="text" class="form-control" name="dad_firstname"
                       value="{{ old('dad_firstname', $studentProfile->getContactInfo['dad_firstname']) }}">
                {!! '<div class="text-red">'.$errors->first('dad_firstname').'</div>' !!}
            </div>

            <div class="form-group">
                <label>นามสกุล (ไทย) *</label>
                <input type="text" class="form-control" name="dad_lastname"
                       value="{{ old('dad_lastname', $studentProfile->getContactInfo['dad_lastname']) }}">
                {!! '<div class="text-red">'.$errors->first('dad_lastname').'</div>' !!}
            </div>

            <div class="form-group">
                <label>อายุ</label>
                <input type="text" class="form-control" name="dad_age"
                       value="{{ old('dad_age', $studentProfile->getContactInfo['dad_age']) }}">
                {!! '<div class="text-red">'.$errors->first('dad_age').'</div>' !!}
            </div>

            <div class="form-group">
                <label>เบอร์ติดต่อ *</label>
                <input type="text" class="form-control" name="dad_phone"
                       value="{{ old('dad_phone', $studentProfile->getContactInfo['dad_phone']) }}">
                {!! '<div class="text-red">'.$errors->first('dad_phone').'</div>' !!}
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="dad_email"
                       value="{{ old('dad_email', $studentProfile->getContactInfo['dad_email']) }}">
                {!! '<div class="text-red">'.$errors->first('dad_email').'</div>' !!}
            </div>

            <div class="form-group">
                <label>อาชีพ</label>
                <input type="text" class="form-control" name="dad_job"
                       value="{{ old('dad_job', $studentProfile->getContactInfo['dad_job']) }}">
                {!! '<div class="text-red">'.$errors->first('dad_job').'</div>' !!}
            </div>

            <div class="form-group">
                <label>ตำแหน่ง</label>
                <input type="text" class="form-control" name="dad_position"
                       value="{{ old('dad_position', $studentProfile->getContactInfo['dad_position']) }}">
                {!! '<div class="text-red">'.$errors->first('dad_position').'</div>' !!}
            </div>

            <div class="form-group">
                <label>สถานที่ทำงาน</label>
                <input type="text" class="form-control" name="dad_office"
                       value="{{ old('dad_office', $studentProfile->getContactInfo['dad_office']) }}">
                {!! '<div class="text-red">'.$errors->first('dad_office').'</div>' !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>ชื่อ-มารดา (ไทย) *</label>
                <input type="text" class="form-control" name="mom_firstname"
                       value="{{ old('mom_firstname', $studentProfile->getContactInfo['mom_firstname']) }}">
                {!! '<div class="text-red">'.$errors->first('mom_firstname').'</div>' !!}
            </div>

            <div class="form-group">
                <label>นามสกุล (ไทย) *</label>
                <input type="text" class="form-control" name="mom_lastname"
                       value="{{ old('mom_lastname', $studentProfile->getContactInfo['mom_lastname']) }}">
                {!! '<div class="text-red">'.$errors->first('mom_lastname').'</div>' !!}
            </div>

            <div class="form-group">
                <label>อายุ</label>
                <input type="text" class="form-control" name="mom_age"
                       value="{{ old('mom_age', $studentProfile->getContactInfo['mom_age']) }}">
                {!! '<div class="text-red">'.$errors->first('mom_age').'</div>' !!}
            </div>

            <div class="form-group">
                <label>เบอร์ติดต่อ *</label>
                <input type="text" class="form-control" name="mom_phone"
                       value="{{ old('mom_phone', $studentProfile->getContactInfo['mom_phone']) }}">
                {!! '<div class="text-red">'.$errors->first('mom_phone').'</div>' !!}
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="mom_email"
                       value="{{ old('mom_email', $studentProfile->getContactInfo['mom_email']) }}">
                {!! '<div class="text-red">'.$errors->first('mom_email').'</div>' !!}
            </div>

            <div class="form-group">
                <label>อาชีพ</label>
                <input type="text" class="form-control" name="mom_job"
                       value="{{ old('mom_job', $studentProfile->getContactInfo['mom_job']) }}">
                {!! '<div class="text-red">'.$errors->first('mom_job').'</div>' !!}
            </div>

            <div class="form-group">
                <label>ตำแหน่ง</label>
                <input type="text" class="form-control" name="mom_position"
                       value="{{ old('mom_position', $studentProfile->getContactInfo['mom_position']) }}">
                {!! '<div class="text-red">'.$errors->first('mom_position').'</div>' !!}
            </div>

            <div class="form-group">
                <label>สถานที่ทำงาน</label>
                <input type="text" class="form-control" name="mom_office"
                       value="{{ old('mom_office', $studentProfile->getContactInfo['mom_office']) }}">
                {!! '<div class="text-red">'.$errors->first('mom_office').'</div>' !!}
            </div>
        </div>
    </div>

    <!-- Survey -->
    <div class="row">
        <br>
        <div class="col-md-12">
            <h4>Survey</h4>
            <hr>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>เคยเข้าร่วมโครงการนักเรียนแลกเปลี่ยนฯ หรือโครงการอื่นๆ ระหว่างประเทศหรือไม่ *</label>
                <input type="text" class="form-control" name="has_join"
                       value="{{ old('has_join', $studentProfile->getOtherInfo['has_join']) }}">
                {!! '<div class="text-red">'.$errors->first('has_join').'</div>' !!}
            </div>

            <div class="form-group">
                <label>มีญาติที่อาศัยอยู่ต่างประเทศไหม *</label>
                <input type="text" class="form-control" name="has_parent"
                       value="{{ old('has_parent', $studentProfile->getOtherInfo['has_parent']) }}">
                {!! '<div class="text-red">'.$errors->first('has_parent').'</div>' !!}
            </div>

            <div class="form-group">
                <label>ประสบการณ์ไปต่างประเทศ *</label>
                <input type="text" class="form-control" name="has_experience"
                       value="{{ old('has_experience', $studentProfile->getOtherInfo['has_experience']) }}">
                {!! '<div class="text-red">'.$errors->first('has_experience').'</div>' !!}
            </div>

            <div class="form-group">
                <label>เดินทางกับ (กรณีเคยไปต่างประเทศ)</label>
                <input type="text" class="form-control" name="has_experience_with"
                       value="{{ old('has_experience_with', $studentProfile->getOtherInfo['has_experience_with']) }}">
                {!! '<div class="text-red">'.$errors->first('has_experience_with').'</div>' !!}
            </div>

            <div class="form-group">
                <label>ระยะเวลา (กรณีเคยไปต่างประเทศ)</label>
                <input type="text" class="form-control" name="has_experience_time"
                       value="{{ old('has_experience_time', $studentProfile->getOtherInfo['has_experience_time']) }}">
                {!! '<div class="text-red">'.$errors->first('has_experience_time').'</div>' !!}
            </div>

            <div class="form-group">
                <label>รู้สึกอย่างไร หากได้อยู่กับ Host Family เป็นคนสีผิว (เช่นผิวขาว/ผิวเหลือง/ผิวดำ) *</label>
                <select class="form-control" name="feel_to_black_human">
                    <option value="1" selected>น้อย</option>
                    <option value="2" {{ (old('feel_to_black_human', $studentProfile->getOtherInfo['feel_to_black_human']) == 2 ? 'selected' : '') }}>ปานกลาง</option>
                    <option value="3" {{ (old('feel_to_black_human', $studentProfile->getOtherInfo['feel_to_black_human']) == 3 ? 'selected' : '') }}>มาก</option>
                    <option value="4" {{ (old('feel_to_black_human', $studentProfile->getOtherInfo['feel_to_black_human']) == 4 ? 'selected' : '') }}>มากที่สุด</option>
                </select>
                {!! '<div class="text-red">'.$errors->first('feel_to_black_human').'</div>' !!}
            </div>

            <div class="form-group">
                <label>รู้สึกอย่างไรหากต้องอยู่ร่วมห้องกับคนอื่นในบ้าน *</label>
                <select class="form-control" name="feel_to_other_friend">
                    <option value="1" selected>น้อย</option>
                    <option value="2" {{ (old('feel_to_other_friend', $studentProfile->getOtherInfo['feel_to_other_friend']) == 2 ? 'selected' : '') }}>ปานกลาง</option>
                    <option value="3" {{ (old('feel_to_other_friend', $studentProfile->getOtherInfo['feel_to_other_friend']) == 3 ? 'selected' : '') }}>มาก</option>
                    <option value="4" {{ (old('feel_to_other_friend', $studentProfile->getOtherInfo['feel_to_other_friend']) == 4 ? 'selected' : '') }}>มากที่สุด</option>
                </select>
                {!! '<div class="text-red">'.$errors->first('feel_to_black_human').'</div>' !!}
            </div>

            <div class="form-group">
                <label>โรคประจำตัว *</label>
                <input type="text" class="form-control" name="personal_medical"
                       value="{{ old('personal_medical', $studentProfile->getOtherInfo['personal_medical']) }}">
                {!! '<div class="text-red">'.$errors->first('personal_medical').'</div>' !!}
            </div>

            <div class="form-group">
                <label>โรคภูมิแพ้ *</label>
                <input type="text" class="form-control" name="personal_medical_phoom"
                       value="{{ old('personal_medical_phoom', $studentProfile->getOtherInfo['personal_medical_phoom']) }}">
                {!! '<div class="text-red">'.$errors->first('personal_medical_phoom').'</div>' !!}
            </div>

            <div class="form-group">
                <label>แพ้ยา *</label>
                <input type="text" class="form-control" name="personal_medical_drug"
                       value="{{ old('personal_medical_drug', $studentProfile->getOtherInfo['personal_medical_drug']) }}">
                {!! '<div class="text-red">'.$errors->first('personal_medical_drug').'</div>' !!}
            </div>

            <div class="form-group">
                <label>แพ้สัตว์ *</label>
                <input type="text" class="form-control" name="personal_medical_animal"
                       value="{{ old('personal_medical_animal', $studentProfile->getOtherInfo['personal_medical_animal']) }}">
                {!! '<div class="text-red">'.$errors->first('personal_medical_animal').'</div>' !!}
            </div>

            <div class="form-group">
                <label>แพ้อาหาร *</label>
                <input type="text" class="form-control" name="personal_medical_food"
                       value="{{ old('personal_medical_food', $studentProfile->getOtherInfo['personal_medical_food']) }}">
                {!! '<div class="text-red">'.$errors->first('personal_medical_food').'</div>' !!}
            </div>

            <div class="form-group">
                <label>อนาคตอยากเป็นอะไร *</label>
                <input type="text" class="form-control" name="to_be_future"
                       value="{{ old('to_be_future', $studentProfile->getOtherInfo['to_be_future']) }}">
                {!! '<div class="text-red">'.$errors->first('to_be_future').'</div>' !!}
            </div>

            <div class="form-group">
                <label>(เหตุผลที่อยากเป็นในอนาคต)</label>
                <input type="text" class="form-control" name="to_be_future_desc"
                       value="{{ old('to_be_future_desc', $studentProfile->getOtherInfo['to_be_future_desc']) }}">
                {!! '<div class="text-red">'.$errors->first('to_be_future_desc').'</div>' !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>หากต้องกลับมาซ้ำชั้นเรียน *</label>
                <input type="text" class="form-control" name="re_learn"
                       value="{{ old('re_learn', $studentProfile->getOtherInfo['re_learn']) }}">
                {!! '<div class="text-red">'.$errors->first('re_learn').'</div>' !!}
            </div>

            <div class="form-group">
                <label>คิดว่าตัวเองมีจุดเด่น/ข้อดีอะไรบ้าง *</label>
                <input type="text" class="form-control" name="advantage"
                       value="{{ old('advantage', $studentProfile->getOtherInfo['advantage']) }}">
                {!! '<div class="text-red">'.$errors->first('advantage').'</div>' !!}
            </div>

            <div class="form-group">
                <label>คิดว่าตัวเองมีจุดด้อย/ข้อเสียอะไรบ้าง *</label>
                <input type="text" class="form-control" name="disadvantage"
                       value="{{ old('disadvantage', $studentProfile->getOtherInfo['disadvantage']) }}">
                {!! '<div class="text-red">'.$errors->first('disadvantage').'</div>' !!}
            </div>

            <div class="form-group">
                <label>งานอดิเรก</label>
                <input type="text" class="form-control" name="hobbies"
                       value="{{ old('hobbies', $studentProfile->getOtherInfo['hobbies']) }}">
                {!! '<div class="text-red">'.$errors->first('hobbies').'</div>' !!}
            </div>

            <div class="form-group">
                <label>ความสามารถพิเศษ/รางวัลที่ได้รับ</label>
                <input type="text" class="form-control" name="talent"
                       value="{{ old('talent', $studentProfile->getOtherInfo['talent']) }}">
                {!! '<div class="text-red">'.$errors->first('talent').'</div>' !!}
            </div>

            <div class="form-group">
                <label>เล่นกีฬาอะไร</label>
                <input type="text" class="form-control" name="sport"
                       value="{{ old('sport', $studentProfile->getOtherInfo['sport']) }}">
                {!! '<div class="text-red">'.$errors->first('sport').'</div>' !!}
            </div>

            <div class="form-group">
                <label>เป็นนักกีฬาของโรงเรียน ? *</label>
                <input type="text" class="form-control" name="has_sport_man"
                       value="{{ old('has_sport_man', $studentProfile->getOtherInfo['has_sport_man']) }}">
                {!! '<div class="text-red">'.$errors->first('has_sport_man').'</div>' !!}
            </div>

            <div class="form-group">
                <label>เล่นดนตรีอะไรบ้าง</label>
                <input type="text" class="form-control" name="music"
                       value="{{ old('music', $studentProfile->getOtherInfo['music']) }}">
                {!! '<div class="text-red">'.$errors->first('music').'</div>' !!}
            </div>

            <div class="form-group">
                <label>ใช้คอมพิวเตอร์เฉลี่ยกี่วัน/สัปดาห์</label>
                <input type="text" class="form-control" name="use_computer"
                       value="{{ old('use_computer', $studentProfile->getOtherInfo['use_computer']) }}">
                {!! '<div class="text-red">'.$errors->first('use_computer').'</div>' !!}
            </div>

            <div class="form-group">
                <label>ใช้คอมพิวเตอร์ทำอะไรบ้าง</label>
                <input type="text" class="form-control" name="use_computer_for"
                       value="{{ old('use_computer_for', $studentProfile->getOtherInfo['use_computer_for']) }}">
                {!! '<div class="text-red">'.$errors->first('use_computer_for').'</div>' !!}
            </div>

            <div class="form-group">
                <label>สื่อสังคมออนไลน์ (social Media) ที่ใช้บ่อย อันดับ 1</label>
                <input type="text" class="form-control" name="social_media1"
                       value="{{ old('social_media1', $studentProfile->getOtherInfo['social_media1']) }}">
                {!! '<div class="text-red">'.$errors->first('social_media1').'</div>' !!}
            </div>

            <div class="form-group">
                <label>สื่อสังคมออนไลน์ (social Media) ที่ใช้บ่อย อันดับ 2</label>
                <input type="text" class="form-control" name="social_media2"
                       value="{{ old('social_media2', $studentProfile->getOtherInfo['social_media2']) }}">
                {!! '<div class="text-red">'.$errors->first('social_media2').'</div>' !!}
            </div>

            <div class="form-group">
                <label>สื่อสังคมออนไลน์ (social Media) ที่ใช้บ่อย อันดับ 3</label>
                <input type="text" class="form-control" name="social_media3"
                       value="{{ old('social_media3', $studentProfile->getOtherInfo['social_media3']) }}">
                {!! '<div class="text-red">'.$errors->first('social_media3').'</div>' !!}
            </div>

            <div class="form-group">
                <label>หากถูกกำหนดการเข้าถึง Internet / Social Network จะมีผลต่อชีวิตประจำวันมาก-น้อยเพียงไร *</label>
                <select class="form-control" name="feel_to_block_internet">
                    <option value="1" selected>น้อย</option>
                    <option value="2" {{ (old('feel_to_block_internet', $studentProfile->getOtherInfo['feel_to_block_internet']) == 2 ? 'selected' : '') }}>ปานกลาง</option>
                    <option value="3" {{ (old('feel_to_block_internet', $studentProfile->getOtherInfo['feel_to_block_internet']) == 3 ? 'selected' : '') }}>มาก</option>
                    <option value="4" {{ (old('feel_to_block_internet', $studentProfile->getOtherInfo['feel_to_block_internet']) == 4 ? 'selected' : '') }}>มากที่สุด</option>
                </select>
                {!! '<div class="text-red">'.$errors->first('feel_to_block_internet').'</div>' !!}
            </div>
        </div>
    </div>

    <div class="box-body" style="background-color: white;">
        <label>Remark</label>
        <textarea class="form-control" name="remark" rows="5">{{ old('remark', $studentProfile->getHspAppInfo['remark']) }}</textarea>
    </div>

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Save Student Info</button>
    </div>
</form>