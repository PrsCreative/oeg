<form action="{{ route('backoffice.hsp.student.edit-excite-camp.post', $studentProfile->id) }}" method="post">
    {{ csrf_field() }}

    <input type="hidden" name="tab" value="excite_camp">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>ExCITE Camp Location</label>

                <select name="excite_camp_id" class="form-control">
                    <option value="">-</option>

                    @foreach($exciteLocationList as $value)
                        <option value="{{ $value->id }}" {{ (old('excite_camp_id', $studentProfile->getHspAppInfo['excite_camp_id']) == $value->id ? 'selected' : '') }}>
                            {{ $value->name }}
                        </option>
                    @endforeach
                </select>
                {!! '<div class="text-red">'.$errors->first('excite_camp_id').'</div>' !!}
            </div>
        </div>

        <div class="col-md-6">

        </div>
    </div>

    <div class="box-body" style="background-color: white;">
        <label>Remark</label>
        <textarea class="form-control" name="remark" rows="5">{{ old('remark', $studentProfile->getHspAppInfo['remark']) }}</textarea>
    </div>

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Save ExCITE Camp</button>
    </div>
</form>