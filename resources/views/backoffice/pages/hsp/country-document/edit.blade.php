@extends('backoffice.layouts.default')

@section('breadcrumb')
    <section class="content-header">
        <h1>Country Document Upload Management</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('backoffice.dashboard.get') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Country Document Upload List</li>
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
                        <h3 class="box-title">Edit Country Document Upload</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ route('backoffice.hsp.country-document.location.edit.post', $countryDocument->id) }}" method="post" role="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label>Country </label>
                                <input type="text" class="form-control" name="country" value="{{ old('country', $countryDocument->country) }}" readonly>
                                {!! '<div class="text-red">'.$errors->first('country').'</div>' !!}
                            </div>

                            <div class="form-group">
                                <label for="document_path">Document Path *</label>
                                <br>
                                @if(!empty($countryDocument->document_path))
                                    <a href="{{url($countryDocument->document_path)}}" target="_blank">
                                        {{ $countryDocument->document_path }}
                                    </a>
                                @else
                                @endif
                                <br>
                                <input type="file" name="document_path" accept="application/pdf">
                                <br>
                                <small>- ขนาดไฟล์เอกสารไม่ควรเกิน 1 MB (เฉพาะไฟล์ *.pdf เท่านั้น)</small>
                                {!! '<div class="text-red">'.$errors->first('document_path').'</div>' !!}
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