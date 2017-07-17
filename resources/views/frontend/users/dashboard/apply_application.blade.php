@extends('frontend.template')

@section('main')

<!-- CSS  -->
<link rel="stylesheet" href="{{ asset('css/apply-application.css') }}">
<!-- End CSS -->

<!-- JS  -->
<script src="{{ asset('js/apply_application.js') }}"></script>
<!-- End JS  -->

   <div class="container">
    <div class="row">
        <form class="form-horizontal"
              method="post"
              action="{{route('frontend.dashboard.apply_application.post')}}">
            {{ csrf_field() }}
            <div class="col-md-12">
                <h1 class="font-size-header-long-text">โครงการนักเรียนแลกเปลี่ยน โออีจี 2018/2019 รุ่นที่ 25 - High School Exchange Program 2018/2019</h1>
                <br>
            </div>
            <div class="col-md-9 col-md-offset-3">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            กรุณาเลือกประเทศที่ต้องการสมัคร (เลือกได้ 2 อันดับ)
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <span class="font-blue" id="orderCountry"></span>
                            <input type="hidden"    id="orderCountryStr" name="orderCountryStr" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="checkbox">
                                <input type="checkbox" name="country[]" id="countryUSA" value="usa" {{ !empty(request()->old('country')) && in_array('usa',request()->old('country'))? 'checked' : '' }}>
                                <label for="countryUSA">USA</label>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" name="country[]" id="countryFrench" value="french" {{ !empty(request()->old('country')) && in_array('french',request()->old('country'))? 'checked' : '' }}>
                                <label for="countryFrench">ประเทศที่ใช้ภาษาฝรั่งเศส (ฝรั่งเศส,เบลเยี่ยม)</label>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" name="country[]" id="countryItalian" value="italian" {{ !empty(request()->old('country')) && in_array('italian',request()->old('country'))? 'checked' : '' }}>
                                <label for="countryItalian">ประเทศที่ใช้ภาษาอิตาเลี่ยน</label>
                            </div>
                            {!! '<div class="text-red font-size-detail">'.$errors->first('country').'</div>' !!}
                        </div>
                        <div class="col-md-6">
                            <div class="checkbox">
                                <input type="checkbox" name="country[]" id="countryGerman" value="german" {{ !empty(request()->old('country')) && in_array('german',request()->old('country'))? 'checked' : '' }}>
                                <label for="countryGerman">ประเทศที่ใช้ภาษาเยอรมัน</label>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" name="country[]" id="countryChinese" value="chinese" {{ !empty(request()->old('country')) && in_array('chinese',request()->old('country'))? 'checked' : '' }}>
                                <label for="countryChinese">ประเทศที่ใช้ภาษาจีน</label>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" name="country[]" id="countryScan" value="scan" {{ !empty(request()->old('country')) && in_array('scan',request()->old('country'))? 'checked' : '' }}>
                                <label for="countryScan">ประเทศแถบสแกนดิเนเวีย</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-md-offset-3">
                <h2 class="font-size-title title-section"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Personal info</h2>
                 <div class="form-group">
                    <div class="col-sm-12">
                        <label class="radio-inline">
                        <input type="radio" id="title_mr" name="title" value="mr" {{request()->old('title') == 'mr' ? 'checked' : 'checked'}} > Mr.
                        </label>
                        <label class="radio-inline">
                        <input type="radio" id="title_miss" name="title" value="miss" {{request()->old('title') == 'miss' ? 'checked' : ''}}> Miss
                        </label>
                        <label class="radio-inline">
                        <input type="radio" id="title_other" name="title" value="other" {{request()->old('title') == 'other' ? 'checked' : ''}}> Other
                        </label>
                        <input type="text" name="title_specify" class="form-control width-20 inline" value="{{request()->old('title_specify')}}">
                        {!! '<div class="text-red font-size-detail">'.$errors->first('title').'</div>' !!}
                        {!! '<div class="text-red font-size-detail">'.$errors->first('title_specify').'</div>' !!}
                    </div>
                </div>
                 <div class="form-group">
                     <label for="firstname" class="col-sm-3">First Name (Thai) *</label>
                     <div class="col-sm-9">
						    <input type="text" class="form-control" id="first_name" name="first-name" value="{{request()->old('first-name')}}">
                            {!! '<div class="text-red font-size-detail">'.$errors->first('first-name').'</div>' !!}
					</div>
                 </div>
                 <div class="form-group">
                     <label for="lastname" class="col-sm-3">Last Name (Thai) *</label>
                     <div class="col-sm-9">
						    <input type="text" class="form-control" id="last_name" name="last-name" value="{{request()->old('last-name')}}">
                         {!! '<div class="text-red font-size-detail">'.$errors->first('last-name').'</div>' !!}
					</div>
                 </div>
                 <div class="form-group">
                     <label for="nickname" class="col-sm-3">Nick Name (Thai) *</label>
                     <div class="col-sm-9">
						    <input type="text" class="form-control" id="nickname" name="nickname" value="{{request()->old('nickname')}}">
                         {!! '<div class="text-red font-size-detail">'.$errors->first('nickname').'</div>' !!}
					</div>
                 </div>
                 <div class="form-group">
                     <label for="birthdate" class="col-sm-3">Birthdate *</label>
                     <div class="col-sm-9">
						    <input type="text" class="form-control" id="birthdate" name="birthdate" data-provide="datepicker" value="{{request()->old('birthdate')}}" readonly>
                            <span class="font-size-recommend"> * เกิดระหว่างวันที่ 1 มีนาคม 2543-31 กรกฎาคม 2546</span>
                         {!! '<div class="text-red font-size-detail">'.$errors->first('birthdate').'</div>' !!}
					</div>
                 </div>
                 <div class="form-group">
                     <label for="nationality" class="col-sm-3">Nationality *</label>
                     <div class="col-sm-9">
						    <input type="text" class="form-control" id="nationality" name="nationality" value="{{request()->old('nationality')}}">
                         {!! '<div class="text-red font-size-detail">'.$errors->first('nationality').'</div>' !!}
					</div>
                 </div>
                 <div class="form-group">
                    <label class="col-sm-3" for="phone">Phone *</label>
                    <div class="col-sm-4">
                            <input type="text" class="form-control" id="phone" name="phone" value="{{request()->old('phone')}}">
                        {!! '<div class="text-red font-size-detail">'.$errors->first('phone').'</div>' !!}
                    </div>
                </div>
                 <div class="form-group">
                     <label for="email" class="col-sm-3">Email *</label>
                     <div class="col-sm-9">
						    <input type="email" class="form-control" id="email" name="email" value="{{request()->old('email')}}">
                         {!! '<div class="text-red font-size-detail">'.$errors->first('email').'</div>' !!}
					</div>
                 </div>
                <div class="form-group">
                   <label class="col-sm-3" for="lineID">Line ID</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="lineid" name="lineid" value="{{request()->old('lineid')}}">
                        {!! '<div class="text-red font-size-detail">'.$errors->first('lineid').'</div>' !!}
                    </div>
                </div>
                <div class="form-group">
                   <label class="col-sm-3" for="medical-problem">Medical Problems *</label>
                    <div class="col-sm-9">
                        <label class="radio-inline">
                            <input type="radio" id="medical_problem_no" name="medical-problem" value="no" {{request()->old('medical-problem') == 'no' ? 'checked' : 'checked'}}> No
                        </label>
                        <label class="radio-inline">
                            <input type="radio" id="medical_problem_yes" name="medical-problem" value="yes" {{request()->old('medical-problem') == 'yes' ? 'checked' : ''}}> Yes
                        </label>
                        <input type="text" name="specify" class="form-control width-40 inline" value="{{request()->old('specify')}}">
                        {!! '<div class="text-red font-size-detail">'.$errors->first('medical-problem').'</div>' !!}
                        {!! '<div class="text-red font-size-detail">'.$errors->first('specify').'</div>' !!}
                    </div>
                </div>
                 <div class="form-group">
                    <div class="col-sm-12">
                        <label for="have-visa" class="margin-right">เคยได้รับวีซ่านักเรียนประเทศสหรัฐอเมริกา ( J-1 หรือ F-1 )</label>
                        <label class="radio-inline">
                            <input type="radio" id="have_visa_yes" name="have-visa" value="yes" {{request()->old('have-visa') == 'yes' ? 'checked' : 'checked'}}> เคย
                        </label>
                        <label class="radio-inline">
                            <input type="radio" id="have_visa_no" name="have-visa" value="no" {{request()->old('have-visa') == 'no' ? 'checked' : ''}}> ไม่เคย
                        </label>
                        {!! '<div class="text-red font-size-detail">'.$errors->first('have-visa').'</div>' !!}
                    </div>
                </div>
                
            </div>
            <div class="col-md-9 col-md-offset-3">
                <h2 class="font-size-title title-section"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> Education info</h2>
                <div class="form-group">
                   <label class="col-sm-3" for="school-level">High School Level</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="school-level">
                            @for($i=1;$i<=6;$i++)
                                <option value="m-{{$i}}" {{request()->old('school-level') == "m-$i" ? 'selected' : ''}}>M {{$i}}</option>
                            @endfor
                        </select>
                        {!! '<div class="text-red font-size-detail">'.$errors->first('school-level').'</div>' !!}
                    </div>
                </div>
                <div class="form-group">
                   <label class="col-sm-3" for="study-program">Study Program</label>
                    <div class="col-sm-9">
                        <input type="text" id="study_program" class="form-control" name="study-program" value="{{request()->old('study-program')}}">
                        {!! '<div class="text-red font-size-detail">'.$errors->first('study-program').'</div>' !!}
                    </div>
                </div>
                <div class="form-group">
                   <label class="col-sm-3" for="school-name">School Name *</label>
                    <div class="col-sm-9">
                        <input type="text" id="school_name" class="form-control" name="school-name" value="{{request()->old('school-name')}}">
                        {!! '<div class="text-red font-size-detail">'.$errors->first('school-name').'</div>' !!}
                    </div>
                </div>
                <div class="form-group">
                   <label class="col-sm-3" for="province">Province *</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="province">
                            @foreach($cities as $city)
                                <option value="{{$city->cityNameEN}}" {{request()->old('province') == $city->cityNameEN ? 'selected' : ''}}>{{$city->cityNameEN}}</option>
                            @endforeach
                        </select>
                        {!! '<div class="text-red font-size-detail">'.$errors->first('province').'</div>' !!}
                    </div>
                </div>
                <div class="form-group">
                   <label class="col-sm-3" for="gpa">GPA *</label>
                    <div class="col-sm-9">
                        <input type="text" id="gpa" class="form-control" name="gpa" value="{{request()->old('gpa')}}">
                        {!! '<div class="text-red font-size-detail">'.$errors->first('gpa').'</div>' !!}
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-md-offset-3">
                <h2 class="font-size-title title-section"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Contact info</h2>
                <div class="form-group">
                    <label class="col-sm-3" for="relationship">Relationship</label>
                    <div class="col-sm-9">
                        <label class="radio-inline">
                            <input type="radio" id="relationship_father" name="relationship" value="father" {{request()->old('relationship') == 'father' ? 'checked' : 'checked'}}> Father
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="relationship" value="mother" {{request()->old('relationship') == 'mother' ? 'checked' : ''}}> Mother
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="relationship" value="other" {{request()->old('relationship') == 'other' ? 'checked' : ''}}> Other
                        </label>
                        <input type="text" name="relationship_specify" class="form-control width-40 inline" value="{{request()->old('relationship_specify')}}">
                        {!! '<div class="text-red font-size-detail">'.$errors->first('relationship').'</div>' !!}
                        {!! '<div class="text-red font-size-detail">'.$errors->first('relationship_specify').'</div>' !!}
                    </div>
                </div>
                <div class="form-group">
                   <label class="col-sm-3" for="contact-name">Emergency Contact *</label>
                    <div class="col-sm-9">
                        <input type="text" id="emergency_contact_name" class="form-control" name="emergency-contact-name" placeholder="Name" value="{{request()->old('emergency-contact-name')}}" >
                        {!! '<div class="text-red font-size-detail">'.$errors->first('emergency-contact-name').'</div>' !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3" for="contact-surname"></label>
                    <div class="col-sm-9">
                        <input type="text" id="emergency_contact_surname" class="form-control" name="emergency-contact-surname" placeholder="Surname" value="{{request()->old('emergency-contact-surname')}}">
                        {!! '<div class="text-red font-size-detail">'.$errors->first('emergency-contact-surname').'</div>' !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3" for="emergency_phone"></label>
                    <div class="col-sm-4">
                            <input type="text" id="emergency_phone" class="form-control" name="emergency-phone" placeholder="phone number" value="{{request()->old('emergency-phone')}}" >
                        {!! '<div class="text-red font-size-detail">'.$errors->first('emergency-phone').'</div>' !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3" for="contact-mail"></label>
                    <div class="col-sm-9">
						    <input type="email" id="emergency_email" class="form-control" name="emergency-email" placeholder="Email" value="{{request()->old('emergency-email')}}" >
                        {!! '<div class="text-red font-size-detail">'.$errors->first('emergency-email').'</div>' !!}
					</div>
                </div>
            </div>
            <div class="col-md-9 col-md-offset-3">
                <h2 class="font-size-title title-section"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Other</h2>
                
                <div class="form-group">
                   <label class="col-sm-3" for="teacher-name">Teacher Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="teacher_name" class="form-control" name="teacher-name" placeholder="กรณีสมัครผ่านอาจารย์ที่แนะนำ" value="{{request()->old('teacher-name')}}">
                        {!! '<div class="text-red font-size-detail">'.$errors->first('teacher-name').'</div>' !!}
                    </div>
                </div>
                <div class="form-group">
                   <label class="col-sm-3" for="promo-code">Promotion Code</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="promo-code" value="{{request()->old('promo-code')}}">
                        {!! '<div class="text-red font-size-detail">'.$errors->first('promo-code').'</div>' !!}
                    </div>
                </div>
                <div class="form-group">
                   <label class="col-sm-12" for="source_apply">Sources of Apply Information</label>
                    <div class="col-sm-12">
                       <div class="checkbox">
                            <input type="checkbox" name="source_apply[]" id="sourceBooth" value="oeg-booth" {{ !empty(request()->old('source_apply')) && in_array('oeg-booth',request()->old('source_apply'))? 'checked' : '' }}>
                            <label for="sourceBooth">บูธ OEG</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" name="source_apply[]" id="sourcePoster" value="oeg-poster" {{ !empty(request()->old('source_apply')) && in_array('oeg-poster',request()->old('source_apply'))? 'checked' : '' }}>
                            <label for="sourcePoster">OEG Poster/Brochure</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" name="source_apply[]" id="sourceOEGWebsite" value="oeg-website" {{ !empty(request()->old('source_apply')) && in_array('oeg-website',request()->old('source_apply'))? 'checked' : '' }}>
                            <label for="sourceOEGWebsite">OEG Website</label>
                        </div> 
                        <div class="checkbox">
                            <input type="checkbox" name="source_apply[]" id="sourceMedia" value="media" {{ !empty(request()->old('source_apply')) && in_array('media',request()->old('source_apply'))? 'checked' : '' }}>
                            <label for="sourceMedia">สื่อสิ่งพิมพ์</label>
                        </div>   
                        <div class="checkbox">
                            <input type="checkbox" name="source_apply[]" id="sourceTV" value="tv" {{ !empty(request()->old('source_apply')) && in_array('tv',request()->old('source_apply'))? 'checked' : '' }}>
                            <label for="sourceTV">TV/Radio</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" name="source_apply[]" id="sourceWebsite" value="website" {{ !empty(request()->old('source_apply')) && in_array('website',request()->old('source_apply'))? 'checked' : '' }}>
                            <label for="sourceWebsite">Website</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" name="source_apply[]" id="sourceFacebook" value="facebook" {{ !empty(request()->old('source_apply')) && in_array('facebook',request()->old('source_apply'))? 'checked' : '' }}>
                            <label for="sourceFacebook">Facebook</label>
                        </div>   
                         <div class="checkbox">
                            <input type="checkbox" name="source_apply[]" id="sourceInstagram" value="instagram" {{ !empty(request()->old('source_apply')) && in_array('instagram',request()->old('source_apply'))? 'checked' : '' }}>
                            <label for="sourceInstagram">Instagram</label>
                        </div>  
                         <div class="checkbox">
                            <input type="checkbox" name="source_apply[]" id="sourceYoutube" value="youtube" {{ !empty(request()->old('source_apply')) && in_array('youtube',request()->old('source_apply'))? 'checked' : '' }}>
                            <label for="sourceYoutube">Youtube</label>
                        </div>  
                        <div class="checkbox">
                            <input type="checkbox" name="source_apply[]" id="sourceTeacher" value="teacher" {{ !empty(request()->old('source_apply')) && in_array('teacher',request()->old('source_apply'))? 'checked' : '' }}>
                            <label for="sourceTeacher">Teacher</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" name="source_apply[]" id="sourceFriends" value="friend" {{ !empty(request()->old('source_apply')) && in_array('friend',request()->old('source_apply'))? 'checked' : '' }}>
                            <label for="sourceFriends">Friends/Parents/Cousin</label>
                        </div>  
                        <div class="checkbox">
                            <input type="checkbox" name="source_apply[]" id="sourceOEGFriend" value="oeg-friend" {{ !empty(request()->old('source_apply')) && in_array('oeg-friend',request()->old('source_apply'))? 'checked' : '' }}>
                            <label for="sourceOEGFriend">OEG Friend</label>
                        </div> 
                        <div class="checkbox">
                            <input type="checkbox" name="source_apply[]" id="sourceOther" value="other" {{ !empty(request()->old('source_apply')) && in_array('other',request()->old('source_apply'))? 'checked' : '' }}>
                            <label for="sourceOther">Other</label>
                            <input type="text" name="sourceOther" class="form-control width-40 inline" value="">
                        </div>
                        {!! '<div class="text-red font-size-detail">'.$errors->first('source_apply').'</div>' !!}
                    </div>
                </div>
                
            </div>

            <div class="col-md-9 col-md-offset-3">
                <!-- // Terms & condition -->

                <div class="term-block">
                    <h2>Terms and conditions</h2>
                    <div class="term-block-content">
                        <div class="term-content">
                            <p>
                                ข้อกำหนดและเงื่อนไข
                                ผู้สมัครกรุณาอ่านข้อกำหนดและเงื่อนไขอย่างละเอียด เพื่อความเข้าใจที่ถูกต้องในการสมัครสอบเข้าร่วมโครงการนักเรียนแลกเปลี่ยน โออีจี
                            </p>
                            <p>
                                1.การสมัครสอบ ผู้สมัครยินดีปฏิบัติตามขั้นตอนการสมัครสอบที่โออีจีกำหนดไว้ กรอกข้อมูลและส่งเอกสารของผู้สมัครตามความเป็นจริงอย่างครบถ้วน กรณีผู้สมัครไม่สามารถเข้าสอบในวันที่กำหนด ถือว่าสละสิทธิ์ในการสอบ
                            </p>
                            <p>
                                2. คุณสมบัตินักเรียนแลกเปลี่ยน โออีจี ผู้สมัครต้องมีคุณสมบัติตามที่โออีจีกำหนดไว้ และโออีจีขอสงวนสิทธิ์การคัดเลือกเข้าร่วมโครงการฯ ที่โออีจีเห็นว่าการสมัครนั้นๆ ไม่เป็นไปตามข้อกำหนด หรือเงื่อนไขของโครงการฯ
                            </p>
                            <p>
                                3.การชำระเงิน โออีจีขอสงวนสิทธิ์การคืนเงินค่าสมัครสอบทุกกรณี หากผู้สมัครไม่สามารถมาสอบตามวันที่กำหนด
                            </p>
                            <p>
                                4.ผู้สมัครยินยอมให้โออีจีนำรูปภาพ ข้อความ ภาพเคลื่อนไหว เสียง ชื่อ-นามสกุล หรือผลงานอื่นๆ ของผู้สมัคร ในขณะเข้าร่วมกิจกรรมที่เกี่ยวข้องกับโครงการนักเรียนแลกเปลี่ยนโออีจี ไปใช้ในการประชาสัมพันธ์โครงการฯ ได้
                            </p>
                        </div>
                    </div>
                </div>

                <div class="checkbox">
                    <input type="checkbox" name="source-apply" id="confirm" value="check-box">
                    <label for="confirm">I have read and agree to these Terms and Conditions</label>
                </div>

                <button type="submit" id="submitForm" class="btn btn-success btn-confirm">Confirm</button>
            </div>

        </form>
    </div><!--.row-->
</div><!--.container-->

   
@endsection