@extends('frontend.users.dashboard_template')

@section('content')
    <script src="{{ asset('js/payment.js') }}"></script>

     <div class="row">
        <div class="col-md-12">
            <div class="font-size-title">Payment</div>
            <div id="payment-area">
                <div class="col-md-12">
                    <div class="border-bottom font-size-detail padding-top padding-bottom">
                        <div class="col-md-4 nopadding">Application Fee</div>
                        <div class="col-md-8 nopadding">
                            <div class="col-md-6 nopadding">
                                <span class="">
                                    Status :
                                    @if($user->getHspAppInfo['status_payment'] == 'pending')
                                        รอการชําระเงิน
                                    @else
                                        ชำระเงินแล้ว
                                    @endif
                                </span>
                            </div>
                            <div class="col-md-3 nopadding text-r nav-item download-payin"><a href="javascript:void(0);" class="text-bold" >Pay-in slip <i class="fa fa-print fa-2x" aria-hidden="true"></i></a></div>
                        </div>
                        <br><br>
                        <div class="col-md-4 nopadding">Program Fee1</div>
                        <div class="col-md-8 nopadding">
                            <div class="col-md-6 nopadding">
                                <span class="">
                                    Status :
                                    @if($user->getHspAppInfo['status_payment2'] == 'pending')
                                        รอการชําระเงิน
                                    @else
                                        ชำระเงินแล้ว
                                    @endif
                                </span>
                            </div>
                            <div class="col-md-3 nopadding text-r nav-item"><a href="{{ asset('/pdf/program_fee1.pdf') }}" target="_blank" class="text-bold" >Pay-in slip <i class="fa fa-print fa-2x" aria-hidden="true"></i></a></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    {{--<div class="border-bottom font-size-detail padding-top padding-bottom">--}}
                        {{--<div class="col-md-6 nopadding">DS 2019</div>--}}
                        {{--<div class="col-md-6 nopadding">--}}
                            {{--<div class="col-md-8 nopadding"><span class="">Status : รอการชําระเงิน</span></div>--}}
                            {{--<div class="col-md-4 nopadding text-r nav-item"><a href="#" class="text-bold" >Pay-in slip <i class="fa fa-print fa-2x" aria-hidden="true"></i></a></div>--}}
                        {{--</div>--}}
                        {{--<div class="clear"></div>--}}
                    {{--</div>--}}
                    {{--<div class="border-bottom font-size-detail padding-top padding-bottom">--}}
                        {{--<div class="col-md-6 nopadding">Visa</div>--}}
                        {{--<div class="col-md-6 nopadding">--}}
                            {{--<div class="col-md-8 nopadding"><span class="font-blue">Status : ชําระแล้ว</span></div>--}}
                            {{--<div class="col-md-4 nopadding text-r nav-item"><a href="#" class="text-bold" >Pay-in slip <i class="fa fa-print fa-2x" aria-hidden="true"></i></a></div>--}}
                        {{--</div>--}}
                        {{--<div class="clear"></div>--}}
                    {{--</div>--}}
                    {{--<div class="border-bottom font-size-detail padding-top padding-bottom">--}}
                        {{--<div class="col-md-6 nopadding">Plane Ticket ( Group Ticket )</div>--}}
                        {{--<div class="col-md-6 nopadding">--}}
                            {{--<div class="col-md-8 nopadding"><span class="">Status : รอการชําระเงิน</span></div>--}}
                            {{--<div class="col-md-4 nopadding text-r nav-item"><a href="#" class="text-bold" >Pay-in slip <i class="fa fa-print fa-2x" aria-hidden="true"></i></a></div>--}}
                        {{--</div>--}}
                        {{--<div class="clear"></div>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection