@extends('frontend.users.dashboard_template')

<!-- Header CSS  -->
<link rel="stylesheet" href="{{ asset('css/hsp-admission-test.css') }}">
<!-- End Header CSS -->

@section('content')

    <div class="hsp-admission-test-content">
        {{--Application Status--}}
        <div class="hsp-admission-test-block">
            <h4>HSP Admission Test Page</h4>
            <p class="font-grey font-size-detail wordwrap-width-full margin-top">
                ยินดีต้อนรับสมาชิกใหม่เข้าสู่ครอบครัวโออีจี!<br>
                • ExCITE Camp หรือ ค่ายประเมินทักษะเพื่อพัฒนาตนเอง เป็นอีกหนึ่งขั้นตอนของการเข้าร่วมโครงการนักเรียนแลกเปลี่ยน โออีจี<br>
                • ExCITE Camp จะช่วยดึงศักยภาพและทักษะต่างๆ ที่นักเรียนมี เพื่อช่วยในการเตรียมตัวในการเป็นนักเรียนแลกเปลี่ยน หรือช่วยให้นักเรียนทราบว่าควรจะต้องพัฒนาทักษะไหนเป็นพิเศษก่อนการเข้าร่วมโครงการ<br>
                • โออีจี จะแจ้งวัน เวลา และสถานที่ให้ทราบอีกครั้งทางอีเมล์<br>
                • ต้องการข้อมูลเพิ่มเติม กรุณาติดต่อโออีจี สำนักงานใหญ่ กรุงเทพฯแผนก High School Exchange ที่ 02-2633666 กด 4 / โออีจี สำนักงานเชียงใหม่ 09 9242 2002 ในเวลาทำการ<br>
            </p>

            <div class="padding background-grey margin-bottom">
                <div class="row padding-left-7">
                    <span class="font-size-detail">
                        สถานที่ : {{ $exciteCamp->name }}
                    </span>
                </div>
            </div>

            <div class="padding background-grey margin-bottom">
                <div class="row padding-left-7">
                    <span class="font-size-detail">
                        วันที่ : {{ \App\Helper\Field::getThaiDate($exciteCamp->date)  }}
                    </span>
                </div>
            </div>

            <div class="padding background-grey margin-bottom">
                <div class="row padding-left-7">
                    <span class="font-size-detail">
                        ผลค่าย : {{ !empty(session('hspApp')->excite_camp_result) ? session('hspApp')->excite_camp_result : 'N/A' }}
                    </span>
                </div>
            </div>

            <p class="font-grey font-size-detail wordwrap-width-full margin-top">
                **OEG จะส่งยืนยันรายละเอียดการสอบให้นักเรียนทางอีเมล ภายใน 3-5 วัน ก่อน วันสอบ กรณีต้องการเปลี่ยนแปลงรายละเอียด ติดต่อ 02-263-3666 กด 4
            </p>

        </div>
    </div>
@endsection