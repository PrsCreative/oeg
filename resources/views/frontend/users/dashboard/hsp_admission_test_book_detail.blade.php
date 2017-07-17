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
                ขั้นตอนสำหรับนักเรียนที่สอบผ่าน<br>
                • กรอกข้อมูลในหน้า Student Info ให้ครบทุกช่อง เพื่อใช้สำหรับติดต่อสื่อสารระหว่างเข้าร่วมโครงการฯ<br>
                • สำรองที่นั่งเพื่อรับฟังข้อมูลโครงการฯ ในหน้า Parent Information Meeting (การบรรยายนี้ไม่มีค่าใช้จ่ายใด ๆ เพิ่มเติม)<br>
                • ต้องการข้อมูลเพิ่มเติม กรุณาติดต่อโออีจี สำนักงานใหญ่ กรุงเทพฯแผนก High School Exchange ที่ 02-2633666 กด 4 / โออีจี สำนักงานเชียงใหม่ 09 9242 2002ในเวลาทำการ<br>
            </p>

            <div class="padding background-grey margin-bottom">
                <div class="row padding-left-7">
                    <span class="font-size-title">
                        ศูนย์สอบ : {{ $hspAdmissionTestLocation->name }}
                    </span>
                </div>
            </div>

            <div class="padding background-grey margin-bottom">
                <div class="row padding-left-7">
                    <span class="font-size-title">
                        วันสอบ : {{ \App\Helper\Field::getThaiDate($hspAdmissionTestLocation->date)  }}
                    </span>
                </div>
            </div>

            <div class="padding background-grey margin-bottom">
                <div class="row padding-left-7">
                    <span class="font-size-title">
                        ผลสอบ : {{ \App\Helper\Field::value(session('hspApp')->admission_test_status,'N/A')  }}
                    </span>
                    <br>
                    <span class="font-size-title">
                        คะแนน : {{ \App\Helper\Field::value(session('hspApp')->admission_test_score,'-')  }}
                    </span>
                </div>
            </div>

            @if(\App\Helper\Field::value(session('hspApp')->admission_test_remark) != '')
                <div class="padding background-grey margin-bottom">
                    <div class="row padding-left-7">
                        <span class="font-size-title">
                            รายละเอียดเพิ่มเติม : {{ \App\Helper\Field::value(session('hspApp')->admission_test_remark)  }}
                        </span>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection