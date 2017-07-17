@extends('frontend.template')

@section('main')

    <div class="row">
        <div class="col-md-12 font-size-title font-bold text-center">
            Reset Your Password
        </div>
    </div>

    <form action="{{ route('frontend.user.reset-password.post') }}" method="post">
        {{ csrf_field() }}

        <div class="row margin-top">
            <div class="col-md-4 col-md-offset-4">

                <input type="hidden" name="email"  value="{{$email}}">

                <div class="form-group">
                    <input type="password" id="password" name="password" class="form-control"
                           placeholder="New Password" required />
                </div>

                <div class="form-group">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                           placeholder="Confirm New Password" required />
                </div>

                {!! '<span class="text-red">'.$errors->first('password').'</span>' !!}

            </div>
            <div class="clearfix"></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <button id="btn_signin" class="btn btn-primary btn-block">Reset Password</button>
            </div>
            <div class="clearfix"></div>
        </div>

    </form>

@endsection
