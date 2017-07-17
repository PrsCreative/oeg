@extends('frontend.template')

@section('main')
    <link rel="stylesheet" href="{{ asset('css/thankyou.css') }}">

    <div class="thankyou-wrapper">

        <div class="row">
            <div class="col-md-12 text-center">
                <div>
                    <span class="glyphicon glyphicon-ok-sign font-green" aria-hidden="true"></span>
                </div>
                <div class="font-size-title font-bold font-green">
                    Sign Up Success
                </div>
                <div class="margin-top">
                    Thank you for sign up with Oversea Education Group (OEG).
                </div>
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