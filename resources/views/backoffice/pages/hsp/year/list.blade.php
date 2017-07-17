@extends('backoffice.layouts.default')

@section('breadcrumb')
    <section class="content-header">
        <h1>HSP Year Management</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('backoffice.dashboard.get') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">HSP Year List</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row text-right">
            <div class="col-xs-12">
                <a href="{{ route('backoffice.hsp.year.create.get') }}" class="btn btn-success"> Create</a>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">HSP Year List</h3>
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
                                <th>Year</th>
                                <th>Status</th>
                                <th width="15%" class="text-center">Action</th>
                            </tr>
                            @forelse($yearList as $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $value->year }}</td>
                                    <td>{{ $value->status }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('backoffice.hsp.year.edit.get', $value->id) }}" class="btn btn-warning"> Edit</a>
                                        @if($value->status != 'open')
                                            <a href="{{ route('backoffice.hsp.year.delete.get', $value->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger"> Delete</a>
                                        @else
                                            <span class="btn btn-danger" disabled> Delete</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center text-bold" colspan="4">
                                        No Data.
                                    </td>
                                </tr>
                            @endforelse
                        </table>
                    </div><!-- /.box-body -->

                    {{-- Pagination --}}
                    <div class="box-footer text-right" style="padding: 0px; padding-right: 10px!important;">
                        {{ $yearList->appends(['search' => request('search')])->links() }}
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@endsection