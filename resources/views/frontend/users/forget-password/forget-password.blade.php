@extends('frontend.template')

@section('main')

    <div class="row">
        <div class="col-md-12 font-size-title font-bold text-center">
            Forget Password
        </div>
    </div>

    <form action="{{ route('frontend.user.forget-password.post') }}" method="post">
        {{ csrf_field() }}

        <div class="row margin-top">
            <div class="col-md-4 col-md-offset-4">
                <div class="form-group">
                    <input type="text" id="citizen_id" name="citizen_id" class="form-control"
                           placeholder="Citizen ID" value="{{ old('citizen_id') }}" required />
                    {!! '<span class="text-red">'.$errors->first('citizen_id').'</span>' !!}
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <button id="btn_signin" class="btn btn-primary btn-block">Send Email</button>
            </div>
            <div class="clearfix"></div>
        </div>

    </form>

@endsection
