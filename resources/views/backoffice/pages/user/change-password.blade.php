@extends('backoffice.layouts.default')

@section('breadcrumb')
    <section class="content-header">
        <h1>User Account Management</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('backoffice.dashboard.get') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('backoffice.user.list.get') }}"> User Account List</a></li>
            <li class="active">Change-Password</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <form action="{{ route('backoffice.user.change-password.post', $userAccountId) }}" method="post">
            <div class="row">
                {{ csrf_field() }}
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Change Password</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">
                                <label>New Password *</label>
                                <input type="password" class="form-control" name="password"
                                       value="">
                                {!! '<div class="text-red">'.$errors->first('password').'</div>' !!}
                            </div>

                            <div class="form-group">
                                <label>Re-New Password *</label>
                                <input type="password" class="form-control" name="password_confirmation"
                                       value="">
                                {!! '<div class="text-red">'.$errors->first('password_confirmation').'</div>' !!}
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->

                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </section>
@endsection