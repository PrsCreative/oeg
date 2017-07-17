@extends('frontend.users.dashboard_template')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(!empty($hspApp) && $hspApp->application_status != 'approved')
                <div class="font-size-title font-bold font-orange">
                    Apply Unsuccessfully
                </div>
                <div class="margin-top">
                    คุณสมบัติไม่ตรงตามเงื่อนไข
                    เจ้าหน้าจะติดต่อกลับไป หากสงสัยข้อมูลสอบถาม สำนักงานใหญ่ 0-2263-3666 กด 1 หรือ สำนักงานเชียงใหม่ 0-5381-1355
                </div>
            @else
                <div class="font-size-title text-bold">High School Exchange Application</div>
                <div class="col-md-12">
                    <div class="padding-top padding-bottom"></div>
                    <div><a id="link_apply_application" href="{{ route('frontend.dashboard.apply_application') }}" class="btn btn-info" role="button">High School Exchange Application</a></div>
                </div>
            @endif
        </div>
    </div>
@endsection