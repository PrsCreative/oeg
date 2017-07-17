<form action="{{ route('backoffice.hsp.student.edit-applicant.post', $studentProfile->id) }}" method="post">
    {{ csrf_field() }}

    <input type="hidden" name="tab" value="applicant">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Expect Country 1</label>
                <select name="country_to_apply_1" class="form-control">
                    <option value="">-- Please Select --</option>
                    <option value="usa" {{ ( old('country_to_apply_1', $studentProfile->getHspAppInfo['country_to_apply_1']) == 'usa' ? 'selected' : '' ) }}>USA</option>
                    <option value="french" {{ ( old('country_to_apply_1', $studentProfile->getHspAppInfo['country_to_apply_1']) == 'french' ? 'selected' : '' ) }}>ประเทศที่ใช้ภาษาฝรั่งเศส (ฝรั่งเศส,เบลเยี่ยม)</option>
                    <option value="italian" {{ ( old('country_to_apply_1', $studentProfile->getHspAppInfo['country_to_apply_1']) == 'italian' ? 'selected' : '' ) }}>ประเทศที่ใช้ภาษาอิตาเลี่ยน</option>
                    <option value="german" {{ ( old('country_to_apply_1', $studentProfile->getHspAppInfo['country_to_apply_1']) == 'german' ? 'selected' : '' ) }}>ประเทศที่ใช้ภาษาเยอรมัน</option>
                    <option value="chinese" {{ ( old('country_to_apply_1', $studentProfile->getHspAppInfo['country_to_apply_1']) == 'chinese' ? 'selected' : '' ) }}>ประเทศที่ใช้ภาษาจีน</option>
                    <option value="scan" {{ ( old('country_to_apply_1', $studentProfile->getHspAppInfo['country_to_apply_1']) == 'scan' ? 'selected' : '' ) }}>ประเทศแถบสแกนดิเนเวีย</option>
                </select>
                {!! '<div class="text-red">'.$errors->first('country_to_apply_1').'</div>' !!}
            </div>

            <div class="form-group">
                <label>Expect Country 2</label>
                <select name="country_to_apply_2" class="form-control">
                    <option value="">-- Please Select --</option>
                    <option value="usa" {{ ( old('country_to_apply_2', $studentProfile->getHspAppInfo['country_to_apply_2']) == 'usa' ? 'selected' : '' ) }}>USA</option>
                    <option value="french" {{ ( old('country_to_apply_2', $studentProfile->getHspAppInfo['country_to_apply_2']) == 'french' ? 'selected' : '' ) }}>ประเทศที่ใช้ภาษาฝรั่งเศส (ฝรั่งเศส,เบลเยี่ยม)</option>
                    <option value="italian" {{ ( old('country_to_apply_2', $studentProfile->getHspAppInfo['country_to_apply_2']) == 'italian' ? 'selected' : '' ) }}>ประเทศที่ใช้ภาษาอิตาเลี่ยน</option>
                    <option value="german" {{ ( old('country_to_apply_2', $studentProfile->getHspAppInfo['country_to_apply_2']) == 'german' ? 'selected' : '' ) }}>ประเทศที่ใช้ภาษาเยอรมัน</option>
                    <option value="chinese" {{ ( old('country_to_apply_2', $studentProfile->getHspAppInfo['country_to_apply_2']) == 'chinese' ? 'selected' : '' ) }}>ประเทศที่ใช้ภาษาจีน</option>
                    <option value="scan" {{ ( old('country_to_apply_2', $studentProfile->getHspAppInfo['country_to_apply_2']) == 'scan' ? 'selected' : '' ) }}>ประเทศแถบสแกนดิเนเวีย</option>
                </select>
                {!! '<div class="text-red">'.$errors->first('country_to_apply_2').'</div>' !!}
            </div>

            <div class="form-group">
                <label>Teacher Name</label>
                <input type="text" class="form-control" name="teacher_name"
                       value="{{ old('teacher_name', $studentProfile->getOtherInfo['teacher_name']) }}">
                {!! '<div class="text-red">'.$errors->first('teacher_name').'</div>' !!}
            </div>

            <div class="form-group">
                <label>Promotion Code</label>
                <input type="text" class="form-control" name=""
                       value="{{ $studentProfile->getOtherInfo['promotion_code'] }}" disabled>
            </div>

            <div class="form-group">
                <label>Application Status</label>
                <select name="status_application" class="form-control">
                    <option value="pending" {{ (old('status_application', $studentProfile->getHspAppInfo['status_application']) == 'pending' ? 'selected' : '') }}>
                        Pending
                    </option>
                    <option value="approved" {{ (old('status_application', $studentProfile->getHspAppInfo['status_application']) == 'approved' ? 'selected' : '') }}>
                        Approved
                    </option>
                    <option value="reject" {{ (old('status_application', $studentProfile->getHspAppInfo['status_application']) == 'reject' ? 'selected' : '') }}>
                        Reject
                    </option>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Payment Status</label>
                <select name="status_payment" class="form-control">
                    <option value="pending" {{ (old('status_payment', $studentProfile->getHspAppInfo['status_payment']) == 'pending' ? 'selected' : '') }}>
                        Pending
                    </option>
                    <option value="approved" {{ (old('status_payment', $studentProfile->getHspAppInfo['status_payment']) == 'approved' ? 'selected' : '') }}>
                        Approved
                    </option>
                    <option value="reject" {{ (old('status_payment', $studentProfile->getHspAppInfo['status_payment']) == 'reject' ? 'selected' : '') }}>
                        Reject
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label>Payment2 Status</label>
                <select name="status_payment2" class="form-control">
                    <option value="pending" {{ (old('status_payment', $studentProfile->getHspAppInfo['status_payment2']) == 'pending' ? 'selected' : '') }}>
                        Pending
                    </option>
                    <option value="approved" {{ (old('status_payment', $studentProfile->getHspAppInfo['status_payment2']) == 'approved' ? 'selected' : '') }}>
                        Approved
                    </option>
                    <option value="reject" {{ (old('status_payment', $studentProfile->getHspAppInfo['status_payment2']) == 'reject' ? 'selected' : '') }}>
                        Reject
                    </option>
                </select>
            </div>

            <?php $uploadHistory = json_decode($studentProfile->getHspAppInfo['json_file_path'])?>

            <div class="form-group">
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

                @if(isset($uploadHistory->transcript->status_file))
                    <select name="transcript" class="form-control">
                        <option value="pending" disabled {{ (old('transcript', $uploadHistory->transcript->status_file) == 'pending' ? 'selected' : '') }}>
                            Pending
                        </option>
                        <option value="uploaded" disabled {{ (old('transcript', $uploadHistory->transcript->status_file) == 'uploaded' ? 'selected' : '') }}>
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
                    <select name="transcript" class="form-control">
                        <option value="pending" disabled selected>
                            Pending
                        </option>
                        <option value="uploaded" disabled {{ (old('transcript') == 'uploaded' ? 'selected' : '') }}>
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

                @if(isset($uploadHistory->national_copy->status_file))
                    <select name="national_copy" class="form-control">
                        <option value="pending" disabled {{ (old('national_copy', $uploadHistory->national_copy->status_file) == 'pending' ? 'selected' : '') }}>
                            Pending
                        </option>
                        <option value="uploaded" disabled {{ (old('national_copy', $uploadHistory->national_copy->status_file) == 'uploaded' ? 'selected' : '') }}>
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
                    <select name="national_copy" class="form-control">
                        <option value="pending" selected disabled {{ (old('national_copy') == 'pending' ? 'selected' : '') }}>
                            Pending
                        </option>
                        <option value="uploaded" disabled {{ (old('national_copy') == 'uploaded' ? 'selected' : '') }}>
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

    <div class="box-body" style="background-color: white;">
        <label>Remark</label>
        <textarea class="form-control" name="remark" rows="5">{{ old('remark', $studentProfile->getHspAppInfo['remark']) }}</textarea>
    </div>

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Save Applicant</button>
    </div>
</form>