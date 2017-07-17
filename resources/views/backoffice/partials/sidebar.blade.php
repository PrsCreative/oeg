<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="{{ asset('/backoffice/dist/img/user-default.png') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p>{{ Auth::user()->email }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        {{-- Dashboard --}}
        <li class="{{ (request()->is('backoffice/dashboard*') ? 'active' : '') }}"><a href="{{ route('backoffice.dashboard.get') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

        {{-- User Account --}}
        <li class="{{ (request()->is('backoffice/user*') ? 'active' : '') }}"><a href="{{ route('backoffice.user.list.get') }}"><i class="fa fa-users"></i> <span>User Account</span></a></li>

        {{-- High School Exchange --}}
        <li class="treeview {{ (
            request()->is('backoffice/hsp/admission-test*') ||
            request()->is('backoffice/hsp/student*') ||
            request()->is('backoffice/hsp/parent-information*') ||
            request()->is('backoffice/hsp/excite-camp*') ||
            request()->is('backoffice/hsp/promotion*') ||
            request()->is('backoffice/hsp/country-document*') ||
            request()->is('backoffice/hsp/year*') ? 'active' : ''
        ) }}">
            <a href="#">
                <i class="fa fa-plane"></i> <span>HSP</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>

            <!-- Year -->
            {{--<ul class="treeview-menu">--}}
                {{--<li class="{{ (request()->is('backoffice/hsp/year*') ? 'active' : '') }}">--}}
                    {{--<a href="{{ route('backoffice.hsp.year.get') }}"><i class="fa fa-circle-o"></i> Year</a>--}}
                {{--</li>--}}
            {{--</ul>--}}

            <!-- Student -->
            <ul class="treeview-menu">
                <li class="{{ (request()->is('backoffice/hsp/student*') ? 'active' : '') }}">
                    <a href="{{ route('backoffice.hsp.student.get') }}"><i class="fa fa-circle-o"></i> Student</a>
                </li>
            </ul>

            <!-- Admission Test -->
            <ul class="treeview-menu">
                <li class="{{ (request()->is('backoffice/hsp/admission-test*') ? 'active' : '') }}">
                    <a href="#"><i class="fa fa-circle-o"></i> Admission Test <i class="fa fa-angle-left pull-right"></i></a>

                    <!-- Sub menu Admission Test -->
                    <ul class="treeview-menu" style="display: {{ (
                        request()->is('backoffice/hsp/admission-test/*') ? 'block' : 'none'
                    ) }};">
                        <li class="{{ (request()->is('backoffice/hsp/admission-test/location*') ? 'active' : '')  }}">
                            <a href="{{ route('backoffice.hsp.admission-test.get') }}"><i class="fa fa-circle-o"></i> Location</a>
                        </li>

                        <li class="{{ (request()->is('backoffice/hsp/admission-test/test-result*') ? 'active' : '')  }}">
                            <a href="{{ route('backoffice.hsp.admission-test.result.import.get') }}"><i class="fa fa-circle-o"></i> Import Test Result
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Parent Information -->
            <ul class="treeview-menu">
                <li class="{{ (request()->is('backoffice/hsp/parent-information*') ? 'active' : '') }}">
                    <a href="#"><i class="fa fa-circle-o"></i> Parent Information Meeting <i class="fa fa-angle-left pull-right"></i></a>

                    <!-- Sub menu PIM -->
                    <ul class="treeview-menu" style="display: {{ (
                        request()->is('backoffice/hsp/parent-information/*') ? 'block' : 'none'
                    ) }};">
                        <li class="{{ (request()->is('backoffice/hsp/parent-information/location*') ? 'active' : '')  }}">
                            <a href="{{ route('backoffice.hsp.pim.location.list.get') }}"><i class="fa fa-circle-o"></i> Location</a>
                        </li>

                        {{--<li class="{{ (request()->is('backoffice/hsp/pim/test-result*') ? 'active' : '')  }}">--}}
                            {{--<a href="{{ route('backoffice.hsp.pim.result.import.get') }}"><i class="fa fa-circle-o"></i> Import Test Result--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    </ul>
                </li>
            </ul>

            <!-- ExCITE Camp-->
            <ul class="treeview-menu">
                <li class="{{ (request()->is('backoffice/hsp/excite-camp*') ? 'active' : '') }}">
                    <a href="#"><i class="fa fa-circle-o"></i> ExCITE Camp <i class="fa fa-angle-left pull-right"></i></a>

                    <!-- Sub menu ExCITE Camp -->
                    <ul class="treeview-menu" style="display: {{ (
                        request()->is('backoffice/hsp/excite-camp/*') ? 'block' : 'none'
                    ) }};">
                        <li class="{{ (request()->is('backoffice/hsp/excite-camp/location*') ? 'active' : '')  }}">
                            <a href="{{ route('backoffice.hsp.excite-camp.location.list.get') }}"><i class="fa fa-circle-o"></i> Location</a>
                        </li>

                        {{--<li class="{{ (request()->is('backoffice/hsp/excite-camp/test-result*') ? 'active' : '')  }}">--}}
                            {{--<a href="{{ route('backoffice.hsp.excite-camp.result.import.get') }}"><i class="fa fa-circle-o"></i> Import Test Result--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    </ul>
                </li>
            </ul>

            <!-- Promotion -->
            <ul class="treeview-menu">
                <li class="{{ (request()->is('backoffice/hsp/promotion*') ? 'active' : '') }}">
                    <a href="{{ route('backoffice.hsp.promotion.get') }}"><i class="fa fa-circle-o"></i> Promotion</a>
                </li>
            </ul>

            <!-- Country Document -->
            <ul class="treeview-menu">
                <li class="{{ (request()->is('backoffice/hsp/country-document*') ? 'active' : '') }}">
                    <a href="#"><i class="fa fa-circle-o"></i> Setting <i class="fa fa-angle-left pull-right"></i></a>

                    <!-- Sub menu ExCITE Camp -->
                    <ul class="treeview-menu" style="display: {{ (
                        request()->is('backoffice/hsp/country-document/*') ? 'block' : 'none'
                    ) }};">
                        <li class="{{ (request()->is('backoffice/hsp/country-document/location*') ? 'active' : '')  }}">
                            <a href="{{ route('backoffice.hsp.country-document.location.list.get') }}"><i class="fa fa-circle-o"></i> Country Document Upload</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</section>