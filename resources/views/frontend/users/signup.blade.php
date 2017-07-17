@extends('frontend.template')

@section('main')

    <div class="row">
        <div class="col-md-12 font-size-title font-bold text-center">
            SIGN UP
        </div>
    </div>

    <form action="{{ route('frontend.user.signup.post') }}" method="post">
        {{ csrf_field() }}

        {!! '
        <div class="row margin-top text-red">
            <div class="col-md-4 col-md-offset-4">
                <div class="form-group text-center">
                    '.$errors->first('globalError').'
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        ' !!}

        <div class="row margin-top">
            <div class="col-md-4 col-md-offset-4">
                <div class="form-group no-margin-bottom">
                    <input type="text" id="national_id" name="national_id" class="form-control" placeholder="National ID" />
                    {!! '<span class="text-red">'.$errors->first('national_id').'</span>' !!}
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="row margin-bottom">
            <div class="col-md-4 col-md-offset-4 font-size-detail font-red">
                For non Thai citizen use Passport ID
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

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="form-group">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm Password" />
                    {!! '<span class="text-red">'.$errors->first('password_confirmation').'</span>' !!}
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <button id="btn_signup" class="btn btn-success btn-block">NEXT</button>
            </div>
            <div class="clearfix"></div>
        </div>
    </form>

@endsection