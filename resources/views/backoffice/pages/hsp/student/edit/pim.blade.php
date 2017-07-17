<form action="{{ route('backoffice.hsp.student.edit-pim.post', $studentProfile->id) }}" method="post">
    {{ csrf_field() }}

    <input type="hidden" name="tab" value="pim">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Parent Information Meeting Location</label>

                <select name="parent_location_id" class="form-control">
                    <option value="">-</option>

                    @foreach($pimLocationList as $value)
                        <option value="{{ $value->id }}" {{ (old('parent_location_id', $studentProfile->getHspAppInfo['parent_location_id']) == $value->id ? 'selected' : '') }}>
                            {{ $value->name }}
                        </option>
                    @endforeach
                </select>
                {!! '<div class="text-red">'.$errors->first('parent_location_id').'</div>' !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Parent Information Meeting Amount</label>
                <input type="text" class="form-control" name="parent_location_amount" value="{{ old('parent_location_amount', $studentProfile->getHspAppInfo['parent_location_amount']) }}">
                {!! '<div class="text-red">'.$errors->first('parent_location_amount').'</div>' !!}
            </div>
        </div>
    </div>

<div class="box-body" style="background-color: white;">
    <label>Remark</label>
    <textarea class="form-control" name="remark" rows="5">{{ old('remark', $studentProfile->getHspAppInfo['remark']) }}</textarea>
</div>

<div class="box-footer">
    <button type="submit" class="btn btn-primary">Save Parent Information Meeting</button>
</div>
</form>