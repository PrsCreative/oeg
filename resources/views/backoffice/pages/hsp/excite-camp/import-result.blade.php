@extends('backoffice.layouts.default')

@section('breadcrumb')
    <section class="content-header">
        <h1>ExCITE Camp Import Result</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('backoffice.dashboard.get') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Import Result >ExCITE Camp</li>
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
                        <h3 class="box-title">Import Excel</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ route('backoffice.hsp.excite-camp.result.import.post') }}" method="post" enctype="multipart/form-data" role="form">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <!-- Global Message -->
                            <div class="form-group">
                                @if(session()->has('globalSuccessMessage'))
                                    <div class="">
                                        {{ session()->get('globalSuccessMessage') }}
                                    </div>
                                @endif

                                {!! '<div class="text-red">'.$errors->first('globalErrorMessage').'</div>' !!}
                            </div>
                            <div class="form-group">
                                <input type="file" name="import">
                                <p class="help-block"><a href="{{ asset('example_excel/example_excite_camp_result.xlsx') }}">Ex. download example format here </a></p>
                                {!! '<div class="text-red">'.$errors->first('import').'</div>' !!}
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