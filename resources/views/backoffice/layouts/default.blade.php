<!DOCTYPE html>
<html>
<header>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>OEG BackOffice</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('backoffice/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backoffice/dist/css/AdminLTE.min.css') }}">
    <!-- Theme style Custom CSS -->
    <link rel="stylesheet" href="{{ asset('backoffice/dist/css/style.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('backoffice/dist/css/skins/_all-skins.min.css') }}">

    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('backoffice/plugins/iCheck/flat/blue.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('backoffice/plugins/morris/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('backoffice/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('backoffice/plugins/datepicker/datepicker3.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('backoffice/plugins/daterangepicker/daterangepicker-bs3.css') }}">
    <!-- Bootstrap Datetime Picker -->
    <link rel="stylesheet" href="{{ asset('backoffice/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
    <!-- Time Picker -->
    <link rel="stylesheet" href="{{ asset('backoffice/plugins/timepicker/bootstrap-timepicker.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('backoffice/plugins/datatables/dataTables.bootstrap.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('backoffice/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/basic.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery 2.1.4 -->
    <script src="{{ asset('backoffice/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <!-- Bootstrap Date Picker JS -->
    <script src="{{ asset('backoffice/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
</header>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        @section('logo')
            @include('backoffice.partials.logo')
        @show

        <!-- Header Navbar: style can be found in header.less -->
        @section('header-navbar')
            @include('backoffice.partials.header-navbar')
        @show

    </header>

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        @section('sidebar')
            @include('backoffice.partials.sidebar')
        @show
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @section('breadcrumb')
            @show
        </section>

        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <footer class="main-footer">
        @section('footer')
            @include('backoffice.partials.footer')
        @show
    </footer>
</div><!-- ./wrapper -->

<!-- Bootstrap 3.3.5 -->
<script src="{{ asset('backoffice/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('backoffice/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('backoffice/plugins/fastclick/fastclick.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backoffice/dist/js/app.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('backoffice/dist/js/demo.js') }}"></script>
</body>
</html>