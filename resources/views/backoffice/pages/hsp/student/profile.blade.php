@extends('backoffice.layouts.default')

<!-- Fancy Box CSS -->
<link rel="stylesheet" href="{{ asset('backoffice/plugins/fancybox/jquery.fancybox.min.css') }}">

@section('breadcrumb')
    <section class="content-header">
        <h1>HSP Student Management</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('backoffice.dashboard.get') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('backoffice.hsp.student.get') }}"> HSP Student List</a></li>
            <li class="active">Profile</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row text-right">
            <div class="col-md-12">
                <a href="{{ route('backoffice.hsp.student.edit.get', $studentProfile->id) }}" class="btn btn-warning"> Edit</a>
                <br>
                <br>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs" id="myTab">
                        <li class="active"><a href="#personal_info" data-toggle="tab" aria-expanded="true">Personal Info</a></li>
                        <li class=""><a href="#education_info" data-toggle="tab" aria-expanded="false">Education Info</a></li>
                        <li class=""><a href="#contact_info" data-toggle="tab" aria-expanded="false">Contact Info</a></li>
                        <li class=""><a href="#applicant" data-toggle="tab" aria-expanded="false">Applicant</a></li>

                        @if($studentProfile->getHspAppInfo['state'] >= 2)
                            <li class=""><a href="#admission-test" data-toggle="tab" aria-expanded="false">Admission Test</a></li>
                        @endif

                        @if($studentProfile->getHspAppInfo['state'] >= 3)
                            <li class=""><a href="#student-info" data-toggle="tab" aria-expanded="false">Student Info</a></li>
                        @endif

                        @if($studentProfile->getHspAppInfo['state'] >= 4)
                            <li class=""><a href="#pim" data-toggle="tab" aria-expanded="false">PIM</a></li>
                        @endif

                        @if($studentProfile->getHspAppInfo['state'] >= 5)
                            <li class=""><a href="#excite-camp" data-toggle="tab" aria-expanded="false">ExCITE Camp</a></li>
                        @endif
                    </ul>

                    <div class="tab-content">
                        <!-- Personal Info -->
                        <div class="tab-pane active" id="personal_info">
                            <div class="panel-body padding-none">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" class="form-control" value="{{ ucfirst($studentProfile->getUserPersonalInfo['title']) }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label>Firstname</label>
                                            <input type="text" class="form-control" value="{{ $studentProfile->getUserPersonalInfo['firstname'] }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label>Lastname</label>
                                            <input type="text" class="form-control" value="{{ $studentProfile->getUserPersonalInfo['lastname'] }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label>Nickname</label>
                                            <input type="text" class="form-control" value="{{ $studentProfile->getUserPersonalInfo['nickname'] }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label>National ID</label>
                                            <input type="text" class="form-control" value="{{ $studentProfile->getUserPersonalInfo['national_id'] }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label>Birth Date</label>
                                            <input type="text" class="form-control" value="{{ $studentProfile->getUserPersonalInfo['date_of_birth'] }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label>Nationality ID</label>
                                            <input type="text" class="form-control" value="{{ $studentProfile->getUserPersonalInfo['nationality'] }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" class="form-control" value="{{ $studentProfile->getUserPersonalInfo['phone'] }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" value="{{ $studentProfile->getUserPersonalInfo['email'] }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label>Line ID</label>
                                            <input type="text" class="form-control" value="{{ $studentProfile->getUserPersonalInfo['line_id'] }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label>Facebook</label>
                                            <input type="text" class="form-control" value="{{ $studentProfile->getUserPersonalInfo['facebook'] }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label>Medical Problems</label>
                                            <input type="text" class="form-control" value="{{ ($studentProfile->getUserPersonalInfo['personal_sickness'] != '' ? $studentProfile->getUserPersonalInfo['personal_sickness'] : 'No') }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label>J-1 / F-1 Visa</label>
                                            <input type="text" class="form-control" value="{{ ($studentProfile->getUserPersonalInfo['has_american_visa'] ? 'Yes' : 'No') }}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.tab-pane -->

                        <!-- Education Info -->
                        <div class="tab-pane" id="education_info">
                            <div class="panel-body padding-none">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>High School Level</label>
                                            <input type="text" class="form-control" value="{{ $studentProfile->getEducationInfo['high_school_level'] }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label>Study Program</label>
                                            <input type="text" class="form-control" value="{{ $studentProfile->getEducationInfo['study_program'] }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label>School Name</label>
                                            <input type="text" class="form-control" value="{{ $studentProfile->getEducationInfo['school_name'] }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Province</label>
                                            <input type="text" class="form-control" value="{{ $studentProfile->getEducationInfo['province'] }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label>GPA</label>
                                            <input type="text" class="form-control" value="{{ $studentProfile->getEducationInfo['gpa'] }}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.tab-pane -->

                        <!-- Contact Info -->
                        <div class="tab-pane" id="contact_info">
                            <div class="panel-body padding-none">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Relationship</label>
                                            <input type="text" class="form-control" value="{{ $studentProfile->getContactInfo['emergency_contact_relationship'] }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label>Emergency Contact Name</label>
                                            <input type="text" class="form-control" value="{{ $studentProfile->getContactInfo['emergency_contact_name'] }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label>Emergency Contact Nickname</label>
                                            <input type="text" class="form-control" value="{{ $studentProfile->getContactInfo['emergency_contact_surname'] }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="text" class="form-control" value="{{ $studentProfile->getContactInfo['emergency_phone'] }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label>E-mail</label>
                                            <input type="text" class="form-control" value="{{ $studentProfile->getContactInfo['emergency_email'] }}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.tab-pane -->

                        <!-- Applicant -->
                        <div class="tab-pane" id="applicant">
                            <div class="panel-body padding-none">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Expect Country 1</label>
                                            <select name="country_to_apply_1" class="form-control" disabled>
                                                <option value="">-- Please Select --</option>
                                                <option value="usa" {{ old('country_to_apply_1', $studentProfile->getHspAppInfo['country_to_apply_1'] == 'usa' ? 'selected' : '') }}>USA</option>
                                                <option value="french" {{ old('country_to_apply_1', $studentProfile->getHspAppInfo['country_to_apply_1'] == 'french' ? 'selected' : '') }}>ประเทศที่ใช้ภาษาฝรั่งเศส (ฝรั่งเศส,เบลเยี่ยม)</option>
                                                <option value="italian" {{ old('country_to_apply_1', $studentProfile->getHspAppInfo['country_to_apply_1'] == 'italian' ? 'selected' : '') }}>ประเทศที่ใช้ภาษาอิตาเลี่ยน</option>
                                                <option value="german" {{ old('country_to_apply_1', $studentProfile->getHspAppInfo['country_to_apply_1'] == 'german' ? 'selected' : '') }}>ประเทศที่ใช้ภาษาเยอรมัน</option>
                                                <option value="chinese" {{ old('country_to_apply_1', $studentProfile->getHspAppInfo['country_to_apply_1'] == 'chinese' ? 'selected' : '') }}>ประเทศที่ใช้ภาษาจีน</option>
                                                <option value="scan" {{ old('country_to_apply_1', $studentProfile->getHspAppInfo['country_to_apply_1'] == 'scan' ? 'selected' : '') }}>ประเทศแถบสแกนดิเนเวีย</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Expect Country 2</label>
                                            <select name="country_to_apply_2" class="form-control" disabled>
                                                <option value="">-- Please Select --</option>
                                                <option value="usa" {{ old('country_to_apply_2', $studentProfile->getHspAppInfo['country_to_apply_2'] == 'usa' ? 'selected' : '') }}>USA</option>
                                                <option value="french" {{ old('country_to_apply_2', $studentProfile->getHspAppInfo['country_to_apply_2'] == 'french' ? 'selected' : '') }}>ประเทศที่ใช้ภาษาฝรั่งเศส (ฝรั่งเศส,เบลเยี่ยม)</option>
                                                <option value="italian" {{ old('country_to_apply_2', $studentProfile->getHspAppInfo['country_to_apply_2'] == 'italian' ? 'selected' : '') }}>ประเทศที่ใช้ภาษาอิตาเลี่ยน</option>
                                                <option value="german" {{ old('country_to_apply_2', $studentProfile->getHspAppInfo['country_to_apply_2'] == 'german' ? 'selected' : '') }}>ประเทศที่ใช้ภาษาเยอรมัน</option>
                                                <option value="chinese" {{ old('country_to_apply_2', $studentProfile->getHspAppInfo['country_to_apply_2'] == 'chinese' ? 'selected' : '') }}>ประเทศที่ใช้ภาษาจีน</option>
                                                <option value="scan" {{ old('country_to_apply_2', $studentProfile->getHspAppInfo['country_to_apply_2'] == 'scan' ? 'selected' : '') }}>ประเทศแถบสแกนดิเนเวีย</option>
                                            </select>
                                        </div>

                                        <?php
                                        $keepSourceOfApplies            = trans('source_of_apply');
                                        $keepKeySourceOfApplies         = array_keys($keepSourceOfApplies);
                                        $userSourceOfApplies            = explode(',',str_replace(' ','',$studentProfile->getOtherInfo['source_of_apply']));
                                        $arrValueSourceOfApplies        = [];

                                        foreach ($userSourceOfApplies as $userSourceOfApply){
                                            if(in_array($userSourceOfApply,$keepKeySourceOfApplies)){
                                                $arrValueSourceOfApplies[]  =   $keepSourceOfApplies[$userSourceOfApply];
                                                continue;
                                            }

                                            $arrValueSourceOfApplies[]  =   $userSourceOfApply;
                                        }
                                        ?>

                                        <div class="form-group">
                                            <label>Source of Apply</label>
                                            <input type="text" class="form-control" value="{{ implode(',',$arrValueSourceOfApplies) }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label>Teacher Name</label>
                                            <input type="text" class="form-control" value="{{ $studentProfile->getOtherInfo['teacher_name'] }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label>Promotion Code</label>
                                            <input type="text" class="form-control" value="{{ $studentProfile->getOtherInfo['promotion_code'] }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label>Apply Date</label>
                                            <input type="text" class="form-control" value="{{ $studentProfile->getHspAppInfo['created_at'] }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Application Status</label>
                                            <input type="text" class="form-control" value="{{ $studentProfile->getHspAppInfo['status_application'] }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label>Payment Status</label>
                                            <input type="text" class="form-control" value="{{ $studentProfile->getHspAppInfo['status_payment'] }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label>Payment Status2</label>
                                            <input type="text" class="form-control" value="{{ $studentProfile->getHspAppInfo['status_payment2'] }}" disabled>
                                        </div>

                                        <?php $uploadHistory = json_decode($studentProfile->getHspAppInfo['json_file_path'])?>

                                        <div class="form-group">
                                            @if(isset($uploadHistory->transcript->status_file))
                                                @if(isset($uploadHistory->transcript->path) && (count($uploadHistory->transcript->path) > 0))
                                                    <label>Transcript
                                                        @foreach($uploadHistory->transcript->path as $path)
                                                            @if($loop->iteration == 1)
                                                                <a data-fancybox="group" href="{{ asset($path) }}">(Preview)</a>
                                                            @else
                                                                <a data-fancybox="group" href="{{ asset($path) }}"></a>
                                                            @endif
                                                        @endforeach
                                                    </label>
                                                @else
                                                    <label>Transcript</label>
                                                @endif

                                                <label><a href="{{ route('backoffice.hsp.student-upload-document.get', [$studentProfile->id, 'transcript']) }}"> (Upload)</a></label>

                                                <select class="form-control" disabled>
                                                    <option value="pending" {{ (old('transcript', $uploadHistory->transcript->status_file) == 'pending' ? 'selected' : '') }}>
                                                        Pending
                                                    </option>
                                                    <option value="uploaded" {{ (old('transcript', $uploadHistory->transcript->status_file) == 'uploaded' ? 'selected' : '') }}>
                                                        Uploaded
                                                    </option>
                                                    <option value="approved" {{ (old('transcript', $uploadHistory->transcript->status_file) == 'approved' ? 'selected' : '') }}>
                                                        Approved
                                                    </option>
                                                    <option value="reject" {{ (old('transcript', $uploadHistory->transcript->status_file) == 'reject' ? 'selected' : '') }}>
                                                        Reject
                                                    </option>
                                                </select>
                                            @else
                                                @if(isset($uploadHistory->transcript->path))
                                                    <label>Transcript <a href="{{ asset($uploadHistory->transcript->path) }}" target="_blank">(Preview)</a></label>
                                                @else
                                                    <label>Transcript</label>
                                                @endif

                                                <label><a href="{{ route('backoffice.hsp.student-upload-document.get', [$studentProfile->id, 'transcript']) }}"> (Upload)</a></label>

                                                <select class="form-control" disabled>
                                                    <option value="pending" selected>
                                                        Pending
                                                    </option>
                                                    <option value="uploaded" {{ (old('transcript') == 'uploaded' ? 'selected' : '') }}>
                                                        Uploaded
                                                    </option>
                                                    <option value="approved" {{ (old('transcript') == 'approved' ? 'selected' : '') }}>
                                                        Approved
                                                    </option>
                                                    <option value="reject" {{ (old('transcript') == 'reject' ? 'selected' : '') }}>
                                                        Reject
                                                    </option>
                                                </select>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            @if(isset($uploadHistory->national_copy->path))
                                                <label>สำเนาบัตรประชาชน <a href="{{ asset($uploadHistory->national_copy->path) }}" target="_blank">(Preview)</a></label>
                                            @else
                                                <label>สำเนาบัตรประชาชน</label>
                                            @endif

                                            <label><a href="{{ route('backoffice.hsp.student-upload-document.get', [$studentProfile->id, 'national-copy']) }}"> (Upload)</a></label>

                                            @if(isset($uploadHistory->national_copy->status_file))
                                                <select class="form-control" disabled>
                                                    <option value="pending" {{ (old('national_copy', $uploadHistory->national_copy->status_file) == 'pending' ? 'selected' : '') }}>
                                                        Pending
                                                    </option>
                                                    <option value="uploaded" {{ (old('national_copy', $uploadHistory->national_copy->status_file) == 'uploaded' ? 'selected' : '') }}>
                                                        Uploaded
                                                    </option>
                                                    <option value="approved" {{ (old('national_copy', $uploadHistory->national_copy->status_file) == 'approved' ? 'selected' : '') }}>
                                                        Approved
                                                    </option>
                                                    <option value="reject" {{ (old('national_copy', $uploadHistory->national_copy->status_file) == 'reject' ? 'selected' : '') }}>
                                                        Reject
                                                    </option>
                                                </select>
                                            @else
                                                <select class="form-control" disabled>
                                                    <option value="pending" {{ (old('national_copy') == 'pending' ? 'selected' : '') }}>
                                                        Pending
                                                    </option>
                                                    <option value="uploaded" {{ (old('national_copy') == 'uploaded' ? 'selected' : '') }}>
                                                        Uploaded
                                                    </option>
                                                    <option value="approved" {{ (old('national_copy') == 'approved' ? 'selected' : '') }}>
                                                        Approved
                                                    </option>
                                                    <option value="reject" {{ (old('national_copy') == 'reject' ? 'selected' : '') }}>
                                                        Reject
                                                    </option>
                                                </select>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.tab-pane -->

                        @if($studentProfile->getHspAppInfo['state'] >= 2)
                            <!-- Admission Test -->
                                <div class="tab-pane" id="admission-test">
                                    <div class="panel-body padding-none">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Admission Test Location</label>
                                                    <input type="text" class="form-control" value="{{ $studentProfile->getHspAppInfo->getApplicationTestLocationInfo['name'] }}" disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label>Admission Test Status</label>
                                                    <select class="form-control" disabled>
                                                        <option value="pending" {{ ($studentProfile->getHspAppInfo['admission_test_status'] == 'pending' ? 'selected' : '') }}>
                                                            Pending
                                                        </option>
                                                        <option value="pass" {{ ($studentProfile->getHspAppInfo['admission_test_status'] == 'pass' ? 'selected' : '') }}>
                                                            Pass
                                                        </option>
                                                        <option value="fail" {{ ($studentProfile->getHspAppInfo['admission_test_status'] == 'fail' ? 'selected' : '') }}>
                                                            Fail
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Admission Test Score</label>
                                                    <input type="text" class="form-control" value="{{ $studentProfile->getHspAppInfo['admission_test_score'] }}" disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label>Admission Test Remark</label>
                                                    <textarea class="form-control" name="admission_test_remark" rows="1" disabled>{{ old('admission_test_remark', $studentProfile->getHspAppInfo['admission_test_remark']) }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.tab-pane -->
                        @endif

                        @if($studentProfile->getHspAppInfo['state'] >= 3)
                            <!-- Student Info -->
                            <div class="tab-pane" id="student-info">
                                    <div class="panel-body padding-none">
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
                                                    <select class="form-control" name="title" disabled>
                                                        <option value="mr" {{ (old('title', $studentProfile->getUserPersonalInfo['title']) == 'mr' ? 'selected' : '') }}>Mr</option>
                                                        <option value="miss" {{ (old('title', $studentProfile->getUserPersonalInfo['title']) == 'miss' ? 'selected' : '') }}>Miss</option>
                                                    </select>
                                                    {!! '<div class="text-red">'.$errors->first('title').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>ชื่อ *</label>
                                                    <input type="text" class="form-control" name="firstname"
                                                           value="{{ old('firstname', $studentProfile->getUserPersonalInfo['firstname']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('firstname').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>นามสกุล *</label>
                                                    <input type="text" class="form-control" name="lastname"
                                                           value="{{ old('lastname', $studentProfile->getUserPersonalInfo['lastname']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('lastname').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>ชื่อเล่น *</label>
                                                    <input type="text" class="form-control" name="nickname"
                                                           value="{{ old('nickname', $studentProfile->getUserPersonalInfo['nickname']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('nickname').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>Firstname *</label>
                                                    <input type="text" class="form-control" name="firstname_en"
                                                           value="{{ old('firstname_en', $studentProfile->getUserPersonalInfo['firstname_en']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('firstname_en').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>Lastname *</label>
                                                    <input type="text" class="form-control" name="lastname_en"
                                                           value="{{ old('lastname_en', $studentProfile->getUserPersonalInfo['lastname_en']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('lastname_en').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>Nickname *</label>
                                                    <input type="text" class="form-control" name="nickname_en"
                                                           value="{{ old('nickname_en', $studentProfile->getUserPersonalInfo['nickname_en']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('nickname_en').'</div>' !!}
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>โทรศัพท์บ้าน</label>
                                                    <input type="text" class="form-control" name="phone_home"
                                                           value="{{ old('phone_home', $studentProfile->getUserPersonalInfo['phone_home']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('phone_home').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>เบอร์ติดต่อ (นักเรียน) *</label>
                                                    <input type="text" class="form-control" name="phone"
                                                           value="{{ old('phone', $studentProfile->getUserPersonalInfo['phone']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('phone').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>สัญชาติ *</label>
                                                    <input type="text" class="form-control" name="nationality"
                                                           value="{{ old('nationality', $studentProfile->getUserPersonalInfo['nationality']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('nationality').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>จังหวัดที่เกิด *</label>
                                                    <input type="text" class="form-control" name="province_born"
                                                           value="{{ old('province_born', $studentProfile->getUserPersonalInfo['province_born']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('province_born').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>ประเทศที่เกิด *</label>
                                                    <input type="text" class="form-control" name="country_born"
                                                           value="{{ old('country_born', $studentProfile->getUserPersonalInfo['country_born']) }}" disabled>
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
                                                           value="{{ old('address_parent', $studentProfile->getContactInfo['address_parent']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('address_parent').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>จังหวัด *</label>
                                                    <select class="form-control" name="address_province" disabled>
                                                        @foreach($provinceList as $province)
                                                            <option value="{{ $province['cityNameTH'] }}" {{ (old('address_province', $studentProfile->getContactInfo['address_province']) == $province['cityNameTH'] ? 'selected' : '') }}>{{ $province['cityNameTH'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>รหัสไปรษณีย์ *</label>
                                                    <input type="text" class="form-control" name="address_postcode"
                                                           value="{{ old('address_postcode', $studentProfile->getContactInfo['address_postcode']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('address_postcode').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>Facebook</label>
                                                    <input type="text" class="form-control" name="facebook"
                                                           value="{{ old('facebook', $studentProfile->getUserPersonalInfo['facebook']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('facebook').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>Line ID</label>
                                                    <input type="text" class="form-control" name="line_id"
                                                           value="{{ old('line_id', $studentProfile->getUserPersonalInfo['line_id']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('line_id').'</div>' !!}
                                                </div>

                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" name="address_order_checkbox" value="off">
                                                    <input type="checkbox" name="address_order_checkbox"
                                                           value="on" {{ (old('address_order_checkbox', $studentProfile->getContactInfo['address_order_checkbox']) == 'on' ? 'checked' : '') }} disabled>
                                                    <label>ที่อยู่ในการจัดส่งแตกต่างจากที่อยู่ปัจจุบัน</label>
                                                </div>

                                                <div class="form-group">
                                                    <label>ที่อยู่ปัจจุบัน *</label>
                                                    <input type="text" class="form-control" name="address_order"
                                                           value="{{ old('address_order', $studentProfile->getContactInfo['address_order']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('address_order').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>จังหวัด *</label>
                                                    <select class="form-control" name="address_order_province" disabled>
                                                        @foreach($provinceList as $province)
                                                            <option value="{{ $province['cityNameTH'] }}" {{ (old('address_order_province', $studentProfile->getContactInfo['address_order_province']) == $province['cityNameTH'] ? 'selected' : '') }}>{{ $province['cityNameTH'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>รหัสไปรษณีย์ *</label>
                                                    <input type="text" class="form-control" name="address_order_postcode"
                                                           value="{{ old('address_order_postcode', $studentProfile->getContactInfo['address_order_postcode']) }}" disabled>
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
                                                           value="{{ old('emergency_contact_relationship', $studentProfile->getContactInfo['emergency_contact_relationship']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('emergency_contact_relationship').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>ชื่อ-ผู้ที่ติดต่อได้ในกรณีฉุกเฉิน (ไทย) *</label>
                                                    <input type="text" class="form-control" name="emergency_contact_name"
                                                           value="{{ old('emergency_contact_name', $studentProfile->getContactInfo['emergency_contact_name']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('emergency_contact_name').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>นามสกุล *</label>
                                                    <input type="text" class="form-control" name="emergency_contact_surname"
                                                           value="{{ old('emergency_contact_surname', $studentProfile->getContactInfo['emergency_contact_surname']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('emergency_contact_surname').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>เบอร์ติดต่อ *</label>
                                                    <input type="text" class="form-control" name="emergency_phone"
                                                           value="{{ old('emergency_phone', $studentProfile->getContactInfo['emergency_phone']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('emergency_phone').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control" name="emergency_email"
                                                           value="{{ old('emergency_email', $studentProfile->getContactInfo['emergency_email']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('emergency_email').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>ชื่อ-บิดา (ไทย) *</label>
                                                    <input type="text" class="form-control" name="dad_firstname"
                                                           value="{{ old('dad_firstname', $studentProfile->getContactInfo['dad_firstname']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('dad_firstname').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>นามสกุล (ไทย) *</label>
                                                    <input type="text" class="form-control" name="dad_lastname"
                                                           value="{{ old('dad_lastname', $studentProfile->getContactInfo['dad_lastname']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('dad_lastname').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>อายุ</label>
                                                    <input type="text" class="form-control" name="dad_age"
                                                           value="{{ old('dad_age', $studentProfile->getContactInfo['dad_age']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('dad_age').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>เบอร์ติดต่อ *</label>
                                                    <input type="text" class="form-control" name="dad_phone"
                                                           value="{{ old('dad_phone', $studentProfile->getContactInfo['dad_phone']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('dad_phone').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control" name="dad_email"
                                                           value="{{ old('dad_email', $studentProfile->getContactInfo['dad_email']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('dad_email').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>อาชีพ</label>
                                                    <input type="text" class="form-control" name="dad_job"
                                                           value="{{ old('dad_job', $studentProfile->getContactInfo['dad_job']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('dad_job').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>ตำแหน่ง</label>
                                                    <input type="text" class="form-control" name="dad_position"
                                                           value="{{ old('dad_position', $studentProfile->getContactInfo['dad_position']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('dad_position').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>สถานที่ทำงาน</label>
                                                    <input type="text" class="form-control" name="dad_office"
                                                           value="{{ old('dad_office', $studentProfile->getContactInfo['dad_office']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('dad_office').'</div>' !!}
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>ชื่อ-มารดา (ไทย) *</label>
                                                    <input type="text" class="form-control" name="mom_firstname"
                                                           value="{{ old('mom_firstname', $studentProfile->getContactInfo['mom_firstname']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('mom_firstname').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>นามสกุล (ไทย) *</label>
                                                    <input type="text" class="form-control" name="mom_lastname"
                                                           value="{{ old('mom_lastname', $studentProfile->getContactInfo['mom_lastname']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('mom_lastname').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>อายุ</label>
                                                    <input type="text" class="form-control" name="mom_age"
                                                           value="{{ old('mom_age', $studentProfile->getContactInfo['mom_age']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('mom_age').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>เบอร์ติดต่อ *</label>
                                                    <input type="text" class="form-control" name="mom_phone"
                                                           value="{{ old('mom_phone', $studentProfile->getContactInfo['mom_phone']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('mom_phone').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control" name="mom_email"
                                                           value="{{ old('mom_email', $studentProfile->getContactInfo['mom_email']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('mom_email').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>อาชีพ</label>
                                                    <input type="text" class="form-control" name="mom_job"
                                                           value="{{ old('mom_job', $studentProfile->getContactInfo['mom_job']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('mom_job').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>ตำแหน่ง</label>
                                                    <input type="text" class="form-control" name="mom_position"
                                                           value="{{ old('mom_position', $studentProfile->getContactInfo['mom_position']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('mom_position').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>สถานที่ทำงาน</label>
                                                    <input type="text" class="form-control" name="mom_office"
                                                           value="{{ old('mom_office', $studentProfile->getContactInfo['mom_office']) }}" disabled>
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
                                                           value="{{ old('has_join', $studentProfile->getOtherInfo['has_join']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('has_join').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>มีญาติที่อาศัยอยู่ต่างประเทศไหม *</label>
                                                    <input type="text" class="form-control" name="has_parent"
                                                           value="{{ old('has_parent', $studentProfile->getOtherInfo['has_parent']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('has_parent').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>ประสบการณ์ไปต่างประเทศ *</label>
                                                    <input type="text" class="form-control" name="has_experience"
                                                           value="{{ old('has_experience', $studentProfile->getOtherInfo['has_experience']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('has_experience').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>เดินทางกับ (กรณีเคยไปต่างประเทศ)</label>
                                                    <input type="text" class="form-control" name="has_experience_with"
                                                           value="{{ old('has_experience_with', $studentProfile->getOtherInfo['has_experience_with']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('has_experience_with').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>ระยะเวลา (กรณีเคยไปต่างประเทศ)</label>
                                                    <input type="text" class="form-control" name="has_experience_time"
                                                           value="{{ old('has_experience_time', $studentProfile->getOtherInfo['has_experience_time']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('has_experience_time').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>รู้สึกอย่างไร หากได้อยู่กับ Host Family เป็นคนสีผิว (เช่นผิวขาว/ผิวเหลือง/ผิวดำ) *</label>
                                                    <select class="form-control" name="feel_to_black_human" disabled>
                                                        <option value="1" selected>น้อย</option>
                                                        <option value="2" {{ (old('feel_to_black_human', $studentProfile->getOtherInfo['feel_to_black_human']) == 2 ? 'selected' : '') }}>ปานกลาง</option>
                                                        <option value="3" {{ (old('feel_to_black_human', $studentProfile->getOtherInfo['feel_to_black_human']) == 3 ? 'selected' : '') }}>มาก</option>
                                                        <option value="4" {{ (old('feel_to_black_human', $studentProfile->getOtherInfo['feel_to_black_human']) == 4 ? 'selected' : '') }}>มากที่สุด</option>
                                                    </select>
                                                    {!! '<div class="text-red">'.$errors->first('feel_to_black_human').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>รู้สึกอย่างไรหากต้องอยู่ร่วมห้องกับคนอื่นในบ้าน *</label>
                                                    <select class="form-control" name="feel_to_other_friend" disabled>
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
                                                           value="{{ old('personal_medical', $studentProfile->getOtherInfo['personal_medical']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('personal_medical').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>โรคภูมิแพ้ *</label>
                                                    <input type="text" class="form-control" name="personal_medical_phoom"
                                                           value="{{ old('personal_medical_phoom', $studentProfile->getOtherInfo['personal_medical_phoom']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('personal_medical_phoom').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>แพ้ยา *</label>
                                                    <input type="text" class="form-control" name="personal_medical_drug"
                                                           value="{{ old('personal_medical_drug', $studentProfile->getOtherInfo['personal_medical_drug']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('personal_medical_drug').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>แพ้สัตว์ *</label>
                                                    <input type="text" class="form-control" name="personal_medical_animal"
                                                           value="{{ old('personal_medical_animal', $studentProfile->getOtherInfo['personal_medical_animal']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('personal_medical_animal').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>แพ้อาหาร *</label>
                                                    <input type="text" class="form-control" name="personal_medical_food"
                                                           value="{{ old('personal_medical_food', $studentProfile->getOtherInfo['personal_medical_food']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('personal_medical_food').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>อนาคตอยากเป็นอะไร *</label>
                                                    <input type="text" class="form-control" name="to_be_future"
                                                           value="{{ old('to_be_future', $studentProfile->getOtherInfo['to_be_future']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('to_be_future').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>(เหตุผลที่อยากเป็นในอนาคต)</label>
                                                    <input type="text" class="form-control" name="to_be_future_desc"
                                                           value="{{ old('to_be_future_desc', $studentProfile->getOtherInfo['to_be_future_desc']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('to_be_future_desc').'</div>' !!}
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>หากต้องกลับมาซ้ำชั้นเรียน *</label>
                                                    <input type="text" class="form-control" name="re_learn"
                                                           value="{{ old('re_learn', $studentProfile->getOtherInfo['re_learn']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('re_learn').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>คิดว่าตัวเองมีจุดเด่น/ข้อดีอะไรบ้าง *</label>
                                                    <input type="text" class="form-control" name="advantage"
                                                           value="{{ old('advantage', $studentProfile->getOtherInfo['advantage']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('advantage').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>คิดว่าตัวเองมีจุดด้อย/ข้อเสียอะไรบ้าง *</label>
                                                    <input type="text" class="form-control" name="disadvantage"
                                                           value="{{ old('disadvantage', $studentProfile->getOtherInfo['disadvantage']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('disadvantage').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>งานอดิเรก</label>
                                                    <input type="text" class="form-control" name="hobbies"
                                                           value="{{ old('hobbies', $studentProfile->getOtherInfo['hobbies']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('hobbies').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>ความสามารถพิเศษ/รางวัลที่ได้รับ</label>
                                                    <input type="text" class="form-control" name="talent"
                                                           value="{{ old('talent', $studentProfile->getOtherInfo['talent']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('talent').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>เล่นกีฬาอะไร</label>
                                                    <input type="text" class="form-control" name="sport"
                                                           value="{{ old('sport', $studentProfile->getOtherInfo['sport']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('sport').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>เป็นนักกีฬาของโรงเรียน ? *</label>
                                                    <input type="text" class="form-control" name="has_sport_man"
                                                           value="{{ old('has_sport_man', $studentProfile->getOtherInfo['has_sport_man']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('has_sport_man').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>เล่นดนตรีอะไรบ้าง</label>
                                                    <input type="text" class="form-control" name="music"
                                                           value="{{ old('music', $studentProfile->getOtherInfo['music']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('music').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>ใช้คอมพิวเตอร์เฉลี่ยกี่วัน/สัปดาห์</label>
                                                    <input type="text" class="form-control" name="use_computer"
                                                           value="{{ old('use_computer', $studentProfile->getOtherInfo['use_computer']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('use_computer').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>ใช้คอมพิวเตอร์ทำอะไรบ้าง</label>
                                                    <input type="text" class="form-control" name="use_computer_for"
                                                           value="{{ old('use_computer_for', $studentProfile->getOtherInfo['use_computer_for']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('use_computer_for').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>สื่อสังคมออนไลน์ (social Media) ที่ใช้บ่อย อันดับ 1</label>
                                                    <input type="text" class="form-control" name="social_media1"
                                                           value="{{ old('social_media1', $studentProfile->getOtherInfo['social_media1']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('social_media1').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>สื่อสังคมออนไลน์ (social Media) ที่ใช้บ่อย อันดับ 2</label>
                                                    <input type="text" class="form-control" name="social_media2"
                                                           value="{{ old('social_media2', $studentProfile->getOtherInfo['social_media2']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('social_media2').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>สื่อสังคมออนไลน์ (social Media) ที่ใช้บ่อย อันดับ 3</label>
                                                    <input type="text" class="form-control" name="social_media3"
                                                           value="{{ old('social_media3', $studentProfile->getOtherInfo['social_media3']) }}" disabled>
                                                    {!! '<div class="text-red">'.$errors->first('social_media3').'</div>' !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>หากถูกกำหนดการเข้าถึง Internet / Social Network จะมีผลต่อชีวิตประจำวันมาก-น้อยเพียงไร *</label>
                                                    <select class="form-control" name="feel_to_block_internet" disabled>
                                                        <option value="1" selected>น้อย</option>
                                                        <option value="2" {{ (old('feel_to_block_internet', $studentProfile->getOtherInfo['feel_to_block_internet']) == 2 ? 'selected' : '') }}>ปานกลาง</option>
                                                        <option value="3" {{ (old('feel_to_block_internet', $studentProfile->getOtherInfo['feel_to_block_internet']) == 3 ? 'selected' : '') }}>มาก</option>
                                                        <option value="4" {{ (old('feel_to_block_internet', $studentProfile->getOtherInfo['feel_to_block_internet']) == 4 ? 'selected' : '') }}>มากที่สุด</option>
                                                    </select>
                                                    {!! '<div class="text-red">'.$errors->first('feel_to_block_internet').'</div>' !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.tab-pane -->
                        @endif

                        @if($studentProfile->getHspAppInfo['state'] >= 4)
                            <!-- PIM -->
                                <div class="tab-pane" id="pim">
                                    <div class="panel-body padding-none">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Parent Information Meeting Location</label>
                                                    <input type="text" class="form-control" value="{{ $studentProfile->getHspAppInfo->getPIMLocationInfo['name'] }}" disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Parent Information Meeting Amount</label>
                                                    <input type="text" class="form-control" value="{{ $studentProfile->getHspAppInfo['parent_location_amount'] }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.tab-pane -->
                        @endif

                        @if($studentProfile->getHspAppInfo['state'] >= 5)
                            <!-- ExCITE Camp -->
                                <div class="tab-pane" id="excite-camp">
                                    <div class="panel-body padding-none">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>ExCITE Camp Location</label>
                                                    <input type="text" class="form-control" value="{{ $studentProfile->getHspAppInfo->getExCITECampLocationInfo['name'] }}" disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-6">

                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.tab-pane -->
                        @endif
                    </div><!-- /.tab-content -->
                </div><!-- /.nav-tabs-custom -->
            </div>
        </div>

        <div class="box-body" style="background-color: white;">
            <div class="form-group">
                <label>Remark</label>
                <textarea class="form-control" rows="5" disabled>{{ $studentProfile->getHspAppInfo['remark'] }}</textarea>
            </div>
        </div>
    </section>

    <!-- Fancybox JS -->
    <script src="{{ asset('backoffice/plugins/fancybox/jquery.fancybox.min.js') }}"></script>
@endsection