@extends('backoffice.layouts.default')

@section('breadcrumb')
    <section class="content-header">
        <h1>HSP Promotion Management</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('backoffice.dashboard.get') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">HSP Promotion List</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row text-right">
            <div class="col-xs-12">
                <a href="{{ route('backoffice.hsp.promotion.create.get') }}" class="btn btn-success"> Create</a>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">HSP Promotion List</h3>
                        <div class="box-tools">
                            <form method="get">
                                <div class="input-group" style="width: 150px;">
                                    <input type="text" name="search" class="form-control input-sm pull-right"
                                           placeholder="Search" value="{{ request('search') }}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Code</th>
                                <th>Discount Percent</th>
                                <th>Amount</th>
                                <th>Used</th>
                                <th>Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th width="15%" class="text-center">Action</th>
                            </tr>
                            @forelse($promotionList as $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $value->code }}</td>
                                    <td>{{ $value->percent }}</td>
                                    <td>{{ $value->amount }}</td>
                                    <td>{{ $value->used }}</td>
                                    <td>{{ $value->type }}</td>
                                    <td>{{ date('d/m/Y', strtotime($value->start_date)) }}</td>
                                    <td>{{ date('d/m/Y', strtotime($value->end_date)) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('backoffice.hsp.promotion.edit.get', $value->id) }}" class="btn btn-warning"> Edit</a>
                                        <a href="{{ route('backoffice.hsp.promotion.delete.get', $value->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger"> Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center text-bold" colspan="9">
                                        No Data.
                                    </td>
                                </tr>
                            @endforelse
                        </table>
                    </div><!-- /.box-body -->

                    {{-- Pagination --}}
                    <div class="box-footer text-right" style="padding: 0px; padding-right: 10px!important;">
                        {{ $promotionList->appends(['search' => request('search')])->links() }}
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@endsection