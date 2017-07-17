<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>OEG</title>
    <meta name="description" content=""/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.gif') }}">

    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Kanit:400,500|Lato:300,400,700" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('bootstrap/css/awesome-bootstrap-checkbox.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap-datepicker3.standalone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    {{--<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>--}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap-select.min.js') }}"></script>
    {{--<script src="{{ asset('bootstrap/js/bootstrap-datepicker.min.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap-datepicker.js') }}"></script>
    <!-- thai extension -->
    <script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap-datepicker-thai.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bootstrap/js/locales/bootstrap-datepicker.th.js') }}"></script>

    <script src="{{ asset('js/global.js') }}"></script>

</head>

<body>
    <div class="container">
        <div class="page-header">
            <div class="header-content">
                <div class="header-content-logo">
                    <a href="/">
                        <img class="logo" src="{{ asset('images/logo.gif') }}">
                    </a>
                    
                    @if(Auth::check())
                        <a id="logout" href="{{route('frontend.user.logout.get')}}" class="menu-logout">Log out</a>
                    @endif
                </div>

            </div>
        </div>

        <div class="container-content">
            @yield('main')
        </div>

    </div>

    <div class="footer">
        <div class="container footer-content font-size-detail">
            {{--<div class="row">--}}
                {{--<div class="col-md-2">--}}
                    {{--<div class="text-bold">Home</div>--}}
                    {{--<div>About Us</div>--}}
                    {{--<div>Contact Us</div>--}}
                    {{--<div>Term & Conditions</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-2">--}}
                    {{--<div class="text-bold">High School</div>--}}
                    {{--<div>High School exchange</div>--}}
                    {{--<div>High School Aboard</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-2">--}}
                    {{--<div class="text-bold">Work Exchange</div>--}}
                    {{--<div>Summer Work & Travel USA</div>--}}
                    {{--<div>Work & Study Canada Internship USA</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-2">--}}
                    {{--<div class="text-bold">Study Aboard</div>--}}
                    {{--<div>Language Course</div>--}}
                    {{--<div>Summer Group</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-2 text-bold">--}}
                    {{--<div class="text-bold">Teach in Thailand</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-2 text-bold">--}}
                    {{--<div class="text-bold">Service</div>--}}
                    {{--<div>VISA</div>--}}
                    {{--<div>TOEIC</div>--}}
                    {{--<div>Insurance</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<br />--}}
            <div class="row">
                <div class="col-md-6 text-bold col-footer-name">
                    Overseas Ed Group (OEG)
                </div>
                <div class="col-md-6">
                    <div>สำนักงานใหญ่ : 130-132 อาคารสินธร ทาวเวอร์ 2 ชั้น 9 ถนนวิทยุ แขวงลุมพินี เขตปทุมวัน กรุงเทพฯ 10330 โทร. 0-2263-3666 Line : OegHighSchool</div>
                    <div>สำนักงานเชียงใหม่ : 101 หมู่ 14 ซ.6 ถ. สุเทพ ต. สุเทพ อ. เมือง จ. เชียงใหม่ 50200 โทร. 0-5381-1355</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>