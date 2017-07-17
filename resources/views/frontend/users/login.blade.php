@extends('frontend.template')

@section('main')

    <script src="{{ asset('js/forget-password.js') }}"></script>

    <div class="row">
        <div class="col-md-12 font-size-title font-bold text-center">
            SIGN IN
        </div>
    </div>

    <form action="{{ route('frontend.user.login.post') }}" method="post">
        {{ csrf_field() }}

        {!! '
        <div class="row margin-top text-red">
            <div class="col-md-6 col-md-offset-3">
                <div class="form-group text-center">
                    '.$errors->first('globalError').'
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        ' !!}

        <div class="row margin-top">
            <div class="col-md-4 col-md-offset-4">
                <div class="form-group">
                    <input type="text" id="national_id" name="national_id" class="form-control" placeholder="National ID" />
                    {!! '<span class="text-red">'.$errors->first('national_id').'</span>' !!}
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="form-group">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" />
                    {!! '<span class="text-red">'.$errors->first('password').'</span>' !!}
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        {{--<div class="row">--}}
            {{--<div class="col-md-4 col-md-offset-4">--}}
                {{--<a>Forgot your password</a>--}}
            {{--</div>--}}
            {{--<div class="clearfix"></div>--}}
        {{--</div>--}}

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="checkbox">
                    <input type="hidden" name="remember" value="0">
                    <input type="checkbox" id="is_remember" name="remember" value="1">
                    <label for="is_remember">
                        Remember me
                    </label>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <button id="btn_signin" class="btn btn-primary btn-block">SIGN IN</button>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <a onclick="popup_forget_password()" class="cursor-pointer">Forget Password</a>
            </div>
            <div class="clearfix"></div>
        </div>

    </form>

    <hr />

    {{--<div class="row">--}}
        {{--<div class="col-md-4 col-md-offset-4 text-right">--}}
            {{--Don't have an account?--}}
            {{--<a id="btn_signup" class="btn btn-success" href="{{route('frontend.user.signup.get')}}">SIGN UP</a>--}}
        {{--</div>--}}
    {{--</div>--}}

    @include('frontend.users.forget-password.forget-password-modal')

@endsection
