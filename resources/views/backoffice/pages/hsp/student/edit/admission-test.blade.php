<form action="{{ route('backoffice.hsp.student.edit-admission-test.post', $studentProfile->id) }}" method="post">
    {{ csrf_field() }}

    <input type="hidden" name="tab" value="admission_test">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Admission Test Location</label>

                <select name="admission_test_location_id" class="form-control">
                    <option value="">-</option>

                    @foreach($admissionTestLocationList as $value)
                        <option value="{{ $value->id }}" {{ (old('admission_test_location_id', $studentProfile->getHspAppInfo['admission_test_location_id']) == $value->id ? 'selected' : '') }}>
                            {{ $value->name }}
                        </option>
                    @endforeach
                </select>
                {!! '<div class="text-red">'.$errors->first('admission_test_location_id').'</div>' !!}
            </div>

            <div class="form-group">
                <label>Admission Test Status</label>

                <select name="admission_test_status" class="form-control">
                    <option value="pending" {{ old('admission_test_status', $studentProfile->getHspAppInfo['admission_test_status'] == 'pending' ? 'selected' : '') }}>
                        Pending
                    </option>
                    <option value="pass" {{ old('admission_test_status', $studentProfile->getHspAppInfo['admission_test_status'] == 'pass' ? 'selected' : '') }}>
                        Pass
                    </option>
                    <option value="fail" {{ old('admission_test_status', $studentProfile->getHspAppInfo['admission_test_status'] == 'fail' ? 'selected' : '') }}>
                        Fail
                    </option>
                </select>
                {!! '<div class="text-red">'.$errors->first('admission_test_status').'</div>' !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Admission Test Score</label>
                <input type="text" class="form-control" name="admission_test_score"
                       value="{{ old('admission_test_score', $studentProfile->getHspAppInfo['admission_test_score']) }}">
                {!! '<div class="text-red">'.$errors->first('admission_test_score').'</div>' !!}
            </div>

            <div class="form-group">
                <label>Admission Test Remark</label>
                <textarea class="form-control" name="admission_test_remark" rows="1">{{ old('admission_test_remark', $studentProfile->getHspAppInfo['admission_test_remark']) }}</textarea>
            </div>
        </div>
    </div>

    <div class="box-body" style="background-color: white;">
        <label>Remark</label>
        <textarea class="form-control" name="remark" rows="5">{{ old('remark', $studentProfile->getHspAppInfo['remark']) }}</textarea>
    </div>

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Save Admission Test</button>
    </div>
</form>