@extends('frontend.users.dashboard_template')

<!-- Header CSS  -->
<link rel="stylesheet" href="{{ asset('css/hsp-admission-test.css') }}">
<!-- End Header CSS -->

@section('content')

    <div class="hsp-admission-test-content">
        {{--Application Status--}}
        <div class="hsp-admission-test-block">
            <h4>Parent Information Meeting Page</h4>
            <p class="font-grey font-size-detail wordwrap-width-full margin-top">
                ขอแสดงความยินดี นักเรียนสอบผ่าน!<br>
                • Parent Information Meeting เป็นการประชุมสำหรับผู้ปกครอง ที่จัดขึ้นเพื่อให้รายละเอียดต่าง ๆ ของโครงการฯ เพื่อใช้ประกอบการตัดสิน<br>
                • โออีจี จะแจ้งเตือนวัน เวลา และสถานที่ประชุมให้ทราบอีกครั้ง ทางอีเมล 3 วันก่อนการประชุม<br>
                • ต้องการข้อมูลเพิ่มเติม กรุณาติดต่อโออีจี สำนักงานใหญ่ กรุงเทพฯแผนก High School Exchange ที่ 02-2633666 กด 4 / โออีจี นำนักงานเชียงใหม่ 09 9242 2002 ในเวลาทำการ<br>
            </p>

            <div class="padding background-grey margin-bottom">
                <div class="row padding-left-7">
                    <span class="font-size-detail">
                        สถานที่ : {{ $hspAppParentLocate->name }}
                    </span>
                </div>
            </div>

            <div class="padding background-grey margin-bottom">
                <div class="row padding-left-7">
                    <span class="font-size-detail">
                        วันสอบ : {{ \App\Helper\Field::getThaiDate($hspAppParentLocate->date)  }}
                    </span>
                </div>
            </div>

            <div class="padding background-grey margin-bottom">
                <div class="row padding-left-7">
                    <span class="font-size-detail">
                        จำนวนที่นั่ง : {{ session('hspApp')->parent_location_amount }}
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection