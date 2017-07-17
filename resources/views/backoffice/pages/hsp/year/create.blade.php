@extends('backoffice.layouts.default')

@section('breadcrumb')
    <section class="content-header">
        <h1>HSP Year Management</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('backoffice.dashboard.get') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('backoffice.hsp.year.get') }}"> HSP Year List</a></li>
            <li class="active">Create Year</li>
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
                        <h3 class="box-title">Create Year</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ route('backoffice.hsp.year.create.post') }}" method="post" role="form">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label>Year</label>
                                <input type="text" class="form-control" id="year" name="year" value="{{ old('year') }}" readonly>
                                {!! '<div class="text-red">'.$errors->first('year').'</div>' !!}
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="close">Close</option>
                                    <option value="open">Open</option>
                                </select>
                                {!! '<div class="text-red">'.$errors->first('status').'</div>' !!}
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

    <script>
        $('#year').datepicker({
            format : 'yyyy',
            viewMode : "years",
            minViewMode : "years",
            autoclose : true
        });
    </script>
@endsection