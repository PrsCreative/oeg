@extends('backoffice.layouts.default')

<!-- Fancy Box CSS -->
<link rel="stylesheet" href="{{ asset('backoffice/plugins/fancybox/jquery.fancybox.min.css') }}">

@section('breadcrumb')
    <section class="content-header">
        <h1>HSP Student Management</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('backoffice.dashboard.get') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('backoffice.hsp.student.get') }}"> HSP Student List</a></li>
            <li class="active">Upload</li>
        </ol>
    </section>


@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Upload</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ route('backoffice.hsp.student-upload-document.post', [$id, $documentType]) }}" method="post" role="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <input type="file" name="file_upload[]" accept="image/jpg, image/jpeg, image/png, application/pdf" {{ ($documentType == 'transcript' ? 'multiple' : '') }}>
                                {!! '<div class="text-red">'.$errors->first('file_upload').'</div>' !!}
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@endsection