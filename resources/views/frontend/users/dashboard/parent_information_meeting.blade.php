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
                ขอแสดงความยินดี นักเรียนสอบผ่าน!<br>
                • Parent Information Meeting เป็นการประชุมสำหรับผู้ปกครอง ที่จัดขึ้นเพื่อให้รายละเอียดต่าง ๆ ของโครงการฯ เพื่อใช้ประกอบการตัดสิน<br>
                • โออีจี จะแจ้งเตือนวัน เวลา และสถานที่ประชุมให้ทราบอีกครั้ง ทางอีเมล 3 วันก่อนการประชุม<br>
                • ต้องการข้อมูลเพิ่มเติม กรุณาติดต่อโออีจี สำนักงานใหญ่ กรุงเทพฯแผนก High School Exchange ที่ 02-2633666 กด 4 / โออีจี นำนักงานเชียงใหม่ 09 9242 2002 ในเวลาทำการ<br>
            </p>

            {{--header table--}}
            <div class="border padding">
                <div class="row">
                    <div class="col-md-3 col-xs-3">
                        <span class="font-size-detail">ตาราง</span>
                    </div>
                    <div class="col-md-9 col-xs-9 text-right">
                        <label for="location" class="font-size-detail">Location : </label>
                        <select class="selectpicker" data-live-search="true" id="location">
                            <option data-url="{{route('frontend.dashboard.parent-information-meeting.get')}}"
                                    data-tokens="ทั้งหมด"
                                    {{ empty($provinceSelected) ? 'selected' : '' }}
                            >
                                ทั้งหมด
                            </option>
                            @foreach($hspAppParentProvinces as $hspAppParentProvince)
                                <option data-url="{{route('frontend.dashboard.parent-information-meeting.get',[ 'province' => $hspAppParentProvince->province ])}}"
                                        data-tokens="{{$hspAppParentProvince->province}}"
                                        {{ $provinceSelected == $hspAppParentProvince->province ? 'selected' : '' }}
                                >
                                    {{$hspAppParentProvince->province}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="border-no-top">
                <div class="padding-no-bottom">

                    {{--column table--}}
                    <div class="row margin-bottom">
                        <div class="col-md-offset-5 col-md-3">
                            <span class="font-size-detail">วันสอบ</span>
                        </div>
                        <div class="col-md-3">
                            <span class="font-size-detail">จำนวนว่าง</span>
                        </div>
                    </div>


                    {{--list data--}}
                    @foreach($hspAppParents as $hspAppParent)

                        <div class="row border-top padding-top padding-bottom margin-left margin-right">
                            <div class="col-md-5">
                                <span class="font-size-detail">{{ $hspAppParent->name }}</span>
                            </div>
                            <div class="col-md-3 padding-left-7 padding-right-7">
                                <span class="font-size-detail">{{ \App\Helper\Field::getThaiDate($hspAppParent->date)  }}</span>
                            </div>
                            <div class="col-md-1 text-center margin-left">
                                <span class="font-size-detail font-blue">{{ $hspAppParent->amount - $hspAppParent->used }}</span>
                            </div>
                            <div class="col-md-2">
                                <form method="get" action="{{ route('frontend.dashboard.parent-information-meeting-detail.get') }}">
                                    <input type="hidden" name="parent_locate_id"    value="{{ $hspAppParent->id }}">
                                    <button type="submit" class="btn-book width-140 margin-left">Book</button>
                                </form>
                            </div>
                        </div>

                    @endforeach

                    {{ $hspAppParents->links('vendor.pagination.bootstrap-4') }}

                </div>
            </div>

        </div>
    </div>

@endsection