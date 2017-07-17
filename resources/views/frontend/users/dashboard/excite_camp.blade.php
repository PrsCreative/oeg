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
            <h4>ExCITE Camp Page</h4>
            <p class="font-grey font-size-detail wordwrap-width-full margin-top">
                ยินดีต้อนรับสมาชิกใหม่เข้าสู่ครอบครัวโออีจี!<br>
                • ExCITE Camp หรือ ค่ายประเมินทักษะเพื่อพัฒนาตนเอง เป็นอีกหนึ่งขั้นตอนของการเข้าร่วมโครงการนักเรียนแลกเปลี่ยน โออีจี<br>
                • ExCITE Camp จะช่วยดึงศักยภาพและทักษะต่างๆ ที่นักเรียนมี เพื่อช่วยในการเตรียมตัวในการเป็นนักเรียนแลกเปลี่ยน หรือช่วยให้นักเรียนทราบว่าควรจะต้องพัฒนาทักษะไหนเป็นพิเศษก่อนการเข้าร่วมโครงการ<br>
                • โออีจี จะแจ้งวัน เวลา และสถานที่ให้ทราบอีกครั้งทางอีเมล์<br>
                • ต้องการข้อมูลเพิ่มเติม กรุณาติดต่อโออีจี สำนักงานใหญ่ กรุงเทพฯแผนก High School Exchange ที่ 02-2633666 กด 4 / โออีจี สำนักงานเชียงใหม่ 09 9242 2002 ในเวลาทำการ<br>
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
                            <option data-url="{{route('frontend.dashboard.excite-camp.get')}}"
                                    data-tokens="ทั้งหมด"
                                    {{ empty($provinceSelected) ? 'selected' : '' }}
                            >
                                ทั้งหมด
                            </option>
                            @foreach($exciteCampProvinces as $hspProvince)
                                <option data-url="{{route('frontend.dashboard.excite-camp.get',[ 'province' => $hspProvince->province ])}}"
                                        data-tokens="{{$hspProvince->province}}"
                                        {{ $provinceSelected == $hspProvince->province ? 'selected' : '' }}
                                >
                                    {{$hspProvince->province}}
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
                    @foreach($exciteCamps as $exciteCamp)

                        <div class="row border-top padding-top padding-bottom margin-left margin-right">
                            <div class="col-md-5">
                                <span class="font-size-detail">{{ $exciteCamp->name }}</span>
                            </div>
                            <div class="col-md-3 padding-left-7 padding-right-7">
                                <span class="font-size-detail">{{ \App\Helper\Field::getThaiDate($exciteCamp->date)  }}</span>
                            </div>
                            <div class="col-md-1 text-center margin-left">
                                <span class="font-size-detail font-blue">{{ $exciteCamp->amount - $exciteCamp->used }}</span>
                            </div>
                            <div class="col-md-2">
                                <form method="post" action="{{ route('frontend.dashboard.excite-camp-book.post') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="user_id"         value="{{ auth()->user()->getAuthIdentifier() }}">
                                    <input type="hidden" name="excite_camp_id"   value="{{ $exciteCamp->id }}">

                                    <button type="button" class="btn-book width-140 margin-left">Book</button>
                                </form>
                            </div>
                        </div>

                    @endforeach

                    {{ $exciteCamps->links('vendor.pagination.bootstrap-4') }}

                </div>
            </div>
            <p class="font-grey font-size-detail wordwrap-width-full margin-top">**OEG จะส่งยืนยันรายละเอียดการสอบให้นักเรียนทางอีเมล ภายใน 3-5 วัน ก่อน วันสอบ กรณีต้องการเปลี่ยนแปลงรายละเอียด ติดต่อ 02-263-3666 กด 4
            </p>
        </div>
    </div>

    @include('frontend.users.dashboard.modal.confirm_book',['msg_confirm' => ['th' => 'เมื่อกดจองที่นั่งสอบแล้วจะไม่สามารถเปลี่ยนได้' , 'en' => 'Are You Sure ?'] ])

@endsection