@extends('backoffice.layouts.default')

@section('breadcrumb')
    <section class="content-header">
        <h1>Admission Test Import Result</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('backoffice.dashboard.get') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Import Result Admission Test</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">View Before Import</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                </div><!-- /.box -->
            </div>
        </div>
    </section>
@endsection