<form action="{{ route('backoffice.hsp.student.edit-education.post', $studentProfile->id) }}" method="post">
    {{ csrf_field() }}

    <input type="hidden" name="tab" value="education_info">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>High School Level *</label>
                <select class="form-control" name="high_school_level">
                    @for($i = 1; $i <=6; $i++)
                        <option value="m-{{ $i }}" {{ (old('high_school_level', $studentProfile->getEducationInfo['high_school_level']) == 'm-'.$i ? 'selected' : '') }}>
                            M {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="form-group">
                <label>Study Program</label>
                <input type="text" class="form-control" name="study_program"
                       value="{{ old('study_program', $studentProfile->getEducationInfo['study_program']) }}">
                {!! '<div class="text-red">'.$errors->first('study_program').'</div>' !!}
            </div>

            <div class="form-group">
                <label>School Name *</label>
                <input type="text" class="form-control" name="school_name"
                       value="{{ old('school_name', $studentProfile->getEducationInfo['school_name']) }}">
                {!! '<div class="text-red">'.$errors->first('school_name').'</div>' !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Province *</label>
                <select class="form-control" name="province">
                    @foreach($provinceList as $province)
                        <option value="{{ $province['cityNameEN'] }}" {{ (old('province', $studentProfile->getEducationInfo['province']) == $province['cityNameEN'] ? 'selected' : '') }}>{{ $province['cityNameEN'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>GPA *</label>
                <input type="text" class="form-control" name="gpa"
                       value="{{ old('gpa', $studentProfile->getEducationInfo['gpa']) }}">
                {!! '<div class="text-red">'.$errors->first('gpa').'</div>' !!}
            </div>
        </div>
    </div>

    <div class="box-body" style="background-color: white;">
        <label>Remark</label>
        <textarea class="form-control" name="remark" rows="5">{{ old('remark', $studentProfile->getHspAppInfo['remark']) }}</textarea>
    </div>

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Save Education Info</button>
    </div>
</form>