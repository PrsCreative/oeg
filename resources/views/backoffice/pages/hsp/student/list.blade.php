@extends('backoffice.layouts.default')

@section('breadcrumb')
    <section class="content-header">
        <h1>HSP Student Management</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('backoffice.dashboard.get') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">HSP Student List</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row text-right">
            <div class="col-xs-12">
                <a href="{{ route('backoffice.hsp.student-export-excel.get', ['search' => request('search')]) }}" class="btn btn-primary"> Export</a>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">HSP Student List</h3>
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
                                <th>Name</th>
                                <th>National ID</th>
                                <th>Birth Date</th>
                                <th>GPA</th>
                                <th>E-Mail</th>
                                <th>Phone</th>
                                <th>Apply Program</th>
                                <th>Payment Status</th>
                                <th>Admission Test Status</th></td>
                                <th>Apply Date</th>
                                <th width="15%" class="text-center">Action</th>
                            </tr>
                            @forelse($studentList as $student)
                                <tr>
                                    <td>{{ (($page-1)*$limit) + $loop->iteration }}</td>
                                    <td>{{ $student->getUserPersonalInfo['firstname'].' '.$student->getUserPersonalInfo['lastname'] }}</td>
                                    <td>{{ $student->getUserPersonalInfo['national_id'] }}</td>
                                    <td>{{ date('d/m/Y', strtotime($student->getUserPersonalInfo['date_of_birth'])) }}</td>
                                    <td>{{ $student->getUserEducationInfo['gpa'] }}</td>
                                    <td>{{ $student->getUserPersonalInfo['email'] }}</td>
                                    <td>{{ $student->getUserPersonalInfo['phone'] }}</td>
                                    <td>{{ $student['status_application'] }}</td>
                                    <td>{{ $student['status_payment'] }}</td>
                                    <td>{{ ucfirst($student['admission_test_status']) }}</td>
                                    <td>{{ date('d-m-Y H:i:s', strtotime($student->created_at)) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('backoffice.hsp.student-profile.get', $student['user_id']) }}" class="btn btn-info"> Detail</a>
                                        <a href="{{ route('backoffice.hsp.student.edit.get', $student['user_id']) }}" class="btn btn-warning"> Edit</a>
                                        <a href="{{ route('backoffice.hsp.student.delete.get', $student['user_id']) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger"> Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center text-bold" colspan="10">
                                        No Data.
                                    </td>
                                </tr>
                            @endforelse
                        </table>
                    </div><!-- /.box-body -->

                    {{-- Pagination --}}
                    <div class="box-footer text-right" style="padding: 0px; padding-right: 10px!important;">
                        {{ $studentList->appends(['search' => request('search')])->links() }}
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@endsection