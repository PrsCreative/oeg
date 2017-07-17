@extends('frontend.users.dashboard_template')

@section('content')

    <!-- Header CSS  -->
    <link rel="stylesheet" href="{{ asset('css/hsp-admission-test.css') }}">
    <!-- End Header CSS -->

    <!-- JS  -->
    <script src="{{ asset('js/hsp_admission_test.js') }}"></script>
    <!-- End JS  -->

    <div class="hsp-admission-test-content">
        {{--Application Status--}}
        <div class="hsp-admission-test-block">
            <h4>Parent Information Meeting Page</h4>
            <p class="font-grey font-size-detail wordwrap-width-full margin-top">

            </p>
            <p class="font-grey font-size-detail wordwrap-width-full margin-top">
                Description Parent Information Meeting
            </p>

            {{--header table--}}
            <div class="border padding">
                <div class="row">
                    <div class="col-md-3 col-xs-3">
                        <span class="font-size-detail">ตาราง</span>
                    </div>
                    <div class="col-md-9 col-xs-9 text-right">
                        <span class="font-size-detail">Location : กรุงเทพ</span>
                    </div>
                </div>
            </div>

            <form id="confirm_parent_location" action="{{route('frontend.dashboard.parent-information-meeting-book.post')}}" method="post">

                {{ csrf_field() }}

                <input type="hidden" name="user_id"             value="{{ auth()->user()->getAuthIdentifier() }}">
                <input type="hidden" name="parent_locate_id"    value="{{ $hspAppParentLocate->id }}">

                <div class="border-no-top">
                    <div class="padding-no-bottom">

                        <div class="row padding-top-7 padding-bottom-7 margin-left-7 margin-right-7">

                            <div class="hsp-admission-test-content">
                                {{--Application Status--}}
                                <div class="hsp-admission-test-block">

                                    <div class="padding background-grey margin-bottom">
                                        <div class="row padding-left-7">
                                            <span class="font-size-detail">
                                                สถานที่ : {{ $hspAppParentLocate->name }}
                                            </span>
                                            <br>
                                            <span class="font-size-detail font-soft-grey">
                                                วันสอบ : {{ \App\Helper\Field::getThaiDate($hspAppParentLocate->date)  }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-9 col-xs-9">
                                            <span class="font-size-detail">
                                                จำนวนที่นั่ง :
                                            </span>
                                        </div>
                                        <div class="col-md-3 col-xs-3">
                                            <input type="number" name="amount" class="form-control" min="1" value="{{ request()->old('amount',1) }}">
                                            {!! '<div class="text-red font-size-detail">'.$errors->first('amount').'</div>' !!}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row border-top padding-top padding-bottom margin-left margin-right">
                            <div class="col-md-2 col-xs-2 text-left">
                                <a href="{{ route('frontend.dashboard.parent-information-meeting.get') }}" class="font-size-detail font-black">< Back</a>
                            </div>
                            <div class="col-md-offset-7 col-md-2">
                                <button type="button" class="btn-book margin-left">Confirm</button>
                            </div>
                        </div>

                    </div>
                </div>

            </form>

        </div>
    </div>

    @include('frontend.users.dashboard.modal.confirm_book',['msg_confirm' => ['th' => 'เมื่อกดจอง parent meeting แล้วจะไม่สามารถเปลี่ยนแปลงได้' , 'en' => 'Are You Sure ?'] ])

@endsection