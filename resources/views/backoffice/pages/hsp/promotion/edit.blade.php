@extends('backoffice.layouts.default')

@section('breadcrumb')
    <section class="content-header">
        <h1>HSP Promotion Management</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('backoffice.dashboard.get') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('backoffice.hsp.promotion.get') }}"> HSP Promotion List</a></li>
            <li class="active">Edit Promotion</li>
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
                        <h3 class="box-title">Edit Promotion</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ route('backoffice.hsp.promotion.edit.post', $promotionDetail['id']) }}" method="post" role="form">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label>Code</label>
                                <input type="text" class="form-control" name="code" value="{{ old('code', $promotionDetail['code']) }}">
                                {!! '<div class="text-red">'.$errors->first('code').'</div>' !!}
                            </div>

                            <div class="form-group">
                                <label>Discount Percent</label>
                                <input type="text" class="form-control" name="percent" value="{{ old('percent', $promotionDetail['percent']) }}">
                                {!! '<div class="text-red">'.$errors->first('percent').'</div>' !!}
                            </div>

                            <div class="form-group">
                                <label>Amount</label>
                                <input type="text" class="form-control" name="amount" value="{{ old('amount', $promotionDetail['amount']) }}">
                                {!! '<div class="text-red">'.$errors->first('amount').'</div>' !!}
                            </div>

                            <div class="form-group">
                                <label>Type</label>
                                <select name="type" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    <option value="apply_program" selected="selected">Apply Program</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Start Date</label>
                                <input type="text" class="form-control" name="start_date" id="start_date" value="{{ old('start_date', $promotionDetail['start_date']) }}">
                                {!! '<div class="text-red">'.$errors->first('start_date').'</div>' !!}
                            </div>

                            <div class="form-group">
                                <label>End Date</label>
                                <input type="text" class="form-control" name="end_date" id="end_date" value="{{ old('end_date', $promotionDetail['end_date']) }}">
                                {!! '<div class="text-red">'.$errors->first('end_date').'</div>' !!}
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
        $('#start_date, #end_date').datepicker({
            format : 'dd/mm/yyyy'
        });
    </script>
@endsection