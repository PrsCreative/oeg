<form action="{{ route('backoffice.hsp.student.edit-personal.post', $studentProfile->id) }}" method="post">
    {{ csrf_field() }}

    <input type="hidden" name="tab" value="personal_info">

    <div class="row">
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
                <label>Firstname *</label>
                <input type="text" class="form-control" name="firstname"
                       value="{{ old('firstname', $studentProfile->getUserPersonalInfo['firstname']) }}">
                {!! '<div class="text-red">'.$errors->first('firstname').'</div>' !!}
            </div>

            <div class="form-group">
                <label>Lastname *</label>
                <input type="text" class="form-control" name="lastname"
                       value="{{ old('lastname', $studentProfile->getUserPersonalInfo['lastname']) }}">
                {!! '<div class="text-red">'.$errors->first('lastname').'</div>' !!}
            </div>

            <div class="form-group">
                <label>Nickname *</label>
                <input type="text" class="form-control" name="nickname"
                       value="{{ old('nickname', $studentProfile->getUserPersonalInfo['nickname']) }}">
                {!! '<div class="text-red">'.$errors->first('nickname').'</div>' !!}
            </div>

            <div class="form-group">
                <label>National ID *</label>
                <input type="text" class="form-control" name="national_id"
                       value="{{ old('national_id', $studentProfile->getUserPersonalInfo['national_id']) }}">
                {!! '<div class="text-red">'.$errors->first('national_id').'</div>' !!}
            </div>

            <div class="form-group">
                <label>Birth Date *</label>
                <input type="text" class="form-control" name="date_of_birth"
                       value="{{ old('date_of_birth', $studentProfile->getUserPersonalInfo['date_of_birth']) }}">
                {!! '<div class="text-red">'.$errors->first('date_of_birth').'</div>' !!}
            </div>

            <div class="form-group">
                <label>Nationality *</label>
                <input type="text" class="form-control" name="nationality"
                       value="{{ old('nationality', $studentProfile->getUserPersonalInfo['nationality']) }}">
                {!! '<div class="text-red">'.$errors->first('nationality').'</div>' !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Phone *</label>
                <input type="text" class="form-control" name="phone"
                       value="{{ old('phone', $studentProfile->getUserPersonalInfo['phone']) }}">
                {!! '<div class="text-red">'.$errors->first('phone').'</div>' !!}
            </div>

            <div class="form-group">
                <label>Email *</label>
                <input type="text" class="form-control" name="email"
                       value="{{ old('email', $studentProfile->getUserPersonalInfo['email']) }}">
                {!! '<div class="text-red">'.$errors->first('email').'</div>' !!}
            </div>

            <div class="form-group">
                <label>Line ID</label>
                <input type="text" class="form-control" name="line_id"
                       value="{{ old('line_id', $studentProfile->getUserPersonalInfo['line_id']) }}">
                {!! '<div class="text-red">'.$errors->first('line_id').'</div>' !!}
            </div>

            <div class="form-group">
                <label>Faebook</label>
                <input type="text" class="form-control" name="facebook"
                       value="{{ old('facebook', $studentProfile->getUserPersonalInfo['facebook']) }}">
                {!! '<div class="text-red">'.$errors->first('facebook').'</div>' !!}
            </div>

            <div class="form-group">
                <label>Medical Problems</label>
                <input type="text" class="form-control" name="personal_sickness" value="{{ (old('personal_sickness', $studentProfile->getUserPersonalInfo['personal_sickness'])) }}">
            </div>

            <div class="form-group">
                <label>J-1 / F-1 Visa</label>
                <select name="has_american_visa" class="form-control">
                    <option value="1" {{ (old('has_american_visa', $studentProfile->getUserPersonalInfo['has_american_visa']) == 1 ? 'selected' : '') }}>Yes</option>
                    <option value="0" {{ (old('has_american_visa', $studentProfile->getUserPersonalInfo['has_american_visa']) == 0 ? 'selected' : '') }}>No</option>
                </select>
            </div>
        </div>
    </div>

    <div class="box-body" style="background-color: white;">
        <label>Remark</label>
        <textarea class="form-control" name="remark" rows="5">{{ old('remark', $studentProfile->getHspAppInfo['remark']) }}</textarea>
    </div>

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Save Personal Info</button>
    </div>
</form>