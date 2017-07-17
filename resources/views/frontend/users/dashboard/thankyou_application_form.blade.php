@extends('frontend.template')

@section('main')
    <link rel="stylesheet" href="{{ asset('css/thankyou.css') }}">

    <div class="thankyou-wrapper">

        <div class="row">
            <div class="col-md-12 text-center">
                @if($success)
                    <div>
                        <span class="glyphicon glyphicon-ok-sign font-green" aria-hidden="true"></span>
                    </div>
                    <div class="font-size-title font-bold font-green">
                        Apply Success
                    </div>
                    <div class="margin-top">
                        Thank you for apply application with Oversea Education Group (OEG).
                    </div>
                @else
                    <div>
                        <span class="glyphicon glyphicon-hourglass font-orange" aria-hidden="true"></span>
                    </div>
                    <div class="font-size-title font-bold font-orange">
                        Apply Unsuccessfully
                    </div>
                    <div class="margin-top">
                        คุณสมบัติไม่ตรงตามเงื่อนไข
                        เจ้าหน้าจะติดต่อกลับไป หากสงสัยข้อมูลสอบถาม สำนักงานใหญ่ 0-2263-3666 กด 1 หรือ สำนักงานเชียงใหม่ 0-5381-1355
                    </div>
                @endif
                <div>
                    Continue to your dashboard press OK button
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