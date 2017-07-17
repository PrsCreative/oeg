@extends('backoffice.layouts.default')

<!-- Fancy Box CSS -->
<link rel="stylesheet" href="{{ asset('backoffice/plugins/fancybox/jquery.fancybox.min.css') }}">

@section('breadcrumb')
    <section class="content-header">
        <h1>HSP Student Management</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('backoffice.dashboard.get') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('backoffice.hsp.student.get') }}"> HSP Student List</a></li>
            <li class="active">Edit Profile</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="{{ ( $defaultTab == 'true' || old('tab') == 'personal_info' ? 'active' : '' ) }}"><a href="#personal_info" data-toggle="tab" aria-expanded="true">Personal Info</a></li>
                            <li class="{{ ( old('tab') == 'education_info' ? 'active' : '' ) }}"><a href="#education_info" data-toggle="tab" aria-expanded="false">Education Info</a></li>
                            <li class="{{ ( old('tab') == 'contact_info' ? 'active' : '' ) }}"><a href="#contact_info" data-toggle="tab" aria-expanded="false">Contact Info</a></li>
                            <li class="{{ ( old('tab') == 'applicant' ? 'active' : '' ) }}"><a href="#applicant" data-toggle="tab" aria-expanded="false">Applicant</a></li>

                            @if($studentProfile->getHspAppInfo['state'] >= 2)
                                <li class="{{ ( old('tab') == 'admission_test' ? 'active' : '' ) }}"><a href="#admission_test" data-toggle="tab" aria-expanded="false">Admission Test</a></li>
                            @endif

                            @if($studentProfile->getHspAppInfo['state'] >= 3)
                                <li class="{{ ( old('tab') == 'student_info' ? 'active' : '' ) }}"><a href="#student_info" data-toggle="tab" aria-expanded="false">Student Info</a></li>
                            @endif

                            @if($studentProfile->getHspAppInfo['state'] >= 4)
                                <li class="{{ ( old('tab') == 'pim' ? 'active' : '' ) }}"><a href="#pim" data-toggle="tab" aria-expanded="false">PIM</a></li>
                            @endif

                            @if($studentProfile->getHspAppInfo['state'] >= 5)
                                <li class="{{ ( old('tab') == 'excite_camp' ? 'active' : '' ) }}"><a href="#excite_camp" data-toggle="tab" aria-expanded="false">ExCITE Camp</a></li>
                            @endif
                        </ul>

                        <div class="tab-content">

                            <!-- Personal Info -->
                            <div class="tab-pane {{ ( $defaultTab == 'true' || old('tab') == 'personal_info' ? 'active' : '' ) }}" id="personal_info">
                                <div class="panel-body padding-none">
                                    @include('backoffice.pages.hsp.student.edit.personal-info')
                                </div>
                            </div><!-- /.tab-pane -->

                            <!-- Education Info -->
                            <div class="tab-pane {{ ( old('tab') == 'education_info' ? 'active' : '' ) }}" id="education_info">
                                <div class="panel-body padding-none">
                                    @include('backoffice.pages.hsp.student.edit.education-info')
                                </div>
                            </div><!-- /.tab-pane -->

                            <!-- Contact Info -->
                            <div class="tab-pane {{ ( old('tab') == 'contact_info' ? 'active' : '' ) }}" id="contact_info">
                                <div class="panel-body padding-none">
                                    @include('backoffice.pages.hsp.student.edit.contact-info')
                                </div>
                            </div><!-- /.tab-pane -->

                            <!-- Applicant -->
                            <div class="tab-pane {{ ( old('tab') == 'applicant' ? 'active' : '' ) }}" id="applicant">
                                <div class="panel-body padding-none">
                                    @include('backoffice.pages.hsp.student.edit.applicant')
                                </div>
                            </div><!-- /.tab-pane -->

                            @if($studentProfile->getHspAppInfo['state'] >= 2)
                                <!-- Admission Test -->
                                    <div class="tab-pane {{ ( old('tab') == 'admission_test' ? 'active' : '' ) }}" id="admission_test">
                                        <div class="panel-body padding-none">
                                        @include('backoffice.pages.hsp.student.edit.admission-test')
                                        </div>
                                    </div><!-- /.tab-pane -->
                            @endif

                            @if($studentProfile->getHspAppInfo['state'] >= 3)
                                <!-- Student Info -->
                                    <div class="tab-pane {{ ( old('tab') == 'student_info' ? 'active' : '' ) }}" id="student_info">
                                        <div class="panel-body padding-none">
                                            @include('backoffice.pages.hsp.student.edit.student-info')
                                        </div>
                                    </div><!-- /.tab-pane -->
                            @endif

                            @if($studentProfile->getHspAppInfo['state'] >= 4)
                                <!-- PIM -->
                                    <div class="tab-pane {{ ( old('tab') == 'pim' ? 'active' : '' ) }}" id="pim">
                                        <div class="panel-body padding-none">
                                            @include('backoffice.pages.hsp.student.edit.pim')
                                        </div>
                                    </div><!-- /.tab-pane -->
                            @endif

                            @if($studentProfile->getHspAppInfo['state'] >= 5)
                                <!-- ExCITE Camp -->
                                    <div class="tab-pane {{ ( old('tab') == 'excite_camp' ? 'active' : '' ) }}" id="excite_camp">
                                        <div class="panel-body padding-none">
                                            @include('backoffice.pages.hsp.student.edit.excite-camp')
                                        </div>
                                    </div><!-- /.tab-pane -->
                            @endif
                        </div><!-- /.tab-content -->
                    </div><!-- /.nav-tabs-custom -->
                </div>
            </div>
    </section>

    <!-- Fancybox JS -->
    <script src="{{ asset('backoffice/plugins/fancybox/jquery.fancybox.min.js') }}"></script>
@endsection