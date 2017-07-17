@extends('frontend.template')

@section('main')
    <link rel="stylesheet" href="{{ asset('css/thankyou.css') }}">

    <div class="thankyou-wrapper">

        <div class="row">
            <div class="col-md-12 text-center">
                @if($status == 'success')
                    <div>
                        <span class="glyphicon glyphicon-ok-sign font-green" aria-hidden="true"></span>
                    </div>
                    <div class="font-size-title font-bold font-green">
                        Success
                    </div>
                    <div class="margin-top">
                        We have to sent link for Reset Your Password to Your email already.
                        Please Check Our Email in Trash or Junk Mail.
                    </div>
                @elseif($status == 'email_invalid')
                    <div>
                        <span class="glyphicon glyphicon-hourglass font-orange" aria-hidden="true"></span>
                    </div>
                    <div class="font-size-title font-bold font-orange">
                        Unsuccessfully
                    </div>
                    <div class="margin-top">
                        Your Email is Invalid.
                        เจ้าหน้าจะติดต่อกลับไป หากสงสัยข้อมูลสอบถาม สำนักงานใหญ่ 0-2263-3666 กด 1 หรือ สำนักงานเชียงใหม่ 0-5381-1355
                    </div>
                @elseif($status == 'token_not_expire')
                    <div>
                        <span class="glyphicon glyphicon-hourglass font-orange" aria-hidden="true"></span>
                    </div>
                    <div class="font-size-title font-bold font-orange">
                        Unsuccessfully
                    </div>
                    <div class="margin-top">
                        We have to sent link for Reset Your Password to Your email already.
                        Please Check Our Email in Trash or Junk Mail.
                    </div>
                @elseif($status == 'reset_password_success')
                    <div>
                        <span class="glyphicon glyphicon-hourglass font-green" aria-hidden="true"></span>
                    </div>
                    <div class="font-size-title font-bold font-green">
                        Reset Password Successfully
                    </div>
                @endif

                <div>
                    Continue to login page press OK button
                </div>
            </div>
        </div>

        <div class="row margin-top">
            <div class="col-md-4 col-md-offset-4">
                <a id="link_dashboard" href="{{ route('frontend.dashboard') }}"><button class="btn btn-primary btn-block">OK</button></a>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>

@endsection