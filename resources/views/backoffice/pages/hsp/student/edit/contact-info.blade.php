<form action="{{ route('backoffice.hsp.student.edit-contact.post', $studentProfile->id) }}" method="post">
    {{ csrf_field() }}

    <input type="hidden" name="tab" value="contact_info">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Relationship *</label>
                <input type="text" class="form-control" name="emergency_contact_relationship"
                       value="{{ old('emergency_contact_relationship', $studentProfile->getContactInfo['emergency_contact_relationship']) }}">
                {!! '<div class="text-red">'.$errors->first('emergency_contact_relationship').'</div>' !!}
            </div>

            <div class="form-group">
                <label>Emergency Contact Name *</label>
                <input type="text" class="form-control" name="emergency_contact_name"
                       value="{{ old('emergency_contact_name', $studentProfile->getContactInfo['emergency_contact_name']) }}">
                {!! '<div class="text-red">'.$errors->first('emergency_contact_name').'</div>' !!}
            </div>

            <div class="form-group">
                <label>Emergency Contact Nickname *</label>
                <input type="text" class="form-control" name="emergency_contact_surname"
                       value="{{ old('emergency_contact_surname', $studentProfile->getContactInfo['emergency_contact_surname']) }}">
                {!! '<div class="text-red">'.$errors->first('emergency_contact_surname').'</div>' !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Phone Number *</label>
                <input type="text" class="form-control" name="emergency_phone"
                       value="{{ old('emergency_phone', $studentProfile->getContactInfo['emergency_phone']) }}">
                {!! '<div class="text-red">'.$errors->first('emergency_phone').'</div>' !!}
            </div>

            <div class="form-group">
                <label>E-mail</label>
                <input type="text" class="form-control" name="emergency_email"
                       value="{{ old('emergency_email', $studentProfile->getContactInfo['emergency_email']) }}">
                {!! '<div class="text-red">'.$errors->first('emergency_email').'</div>' !!}
            </div>
        </div>
    </div>

    <div class="box-body" style="background-color: white;">
        <label>Remark</label>
        <textarea class="form-control" name="remark" rows="5">{{ old('remark', $studentProfile->getHspAppInfo['remark']) }}</textarea>
    </div>

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Save Contact Info</button>
    </div>
</form>