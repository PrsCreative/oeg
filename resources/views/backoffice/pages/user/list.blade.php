@extends('backoffice.layouts.default')

@section('breadcrumb')
    <section class="content-header">
        <h1>User Account Management</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('backoffice.dashboard.get') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">User Account List</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">User Account List</h3>
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
                                <th>Username</th>
                                <th>E-Mail</th>
                                <th>Role</th>
                                <th width="15%" class="text-center">Action</th>
                            </tr>
                            @forelse($userList as $value)
                                <tr>
                                    <td>{{ (($page-1)*$limit) + $loop->iteration }}</td>
                                    <td>{{ $value->username }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->role }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('backoffice.user.change-password.get', $value->id) }}" class="btn btn-warning"> Change Password</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center text-bold" colspan="5">
                                        No Data.
                                    </td>
                                </tr>
                            @endforelse
                        </table>
                    </div><!-- /.box-body -->

                    {{-- Pagination --}}
                    <div class="box-footer text-right" style="padding: 0px; padding-right: 10px!important;">
                        {{ $userList->appends(['search' => request('search')])->links() }}
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@endsection