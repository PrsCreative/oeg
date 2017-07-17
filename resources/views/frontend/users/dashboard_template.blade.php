@extends('frontend.template')

<!-- Header CSS  -->
<link rel="stylesheet" href="{{ asset('css/user-dashboard.css') }}">
<!-- End Header CSS -->

@section('main')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="dashboard-header">
                    <div class="col-md-1"><img src="{{ asset('images/user_upload_img.png') }}" class="user-img"></div>
                    <div class="col-md-11">
                        <div class="col-md-12 font-size-header">
                            {{ auth()->user()['username'] }}
                            <i class="fa fa-pencil-square-o display-none" aria-hidden="true"></i>
                        </div>

                        <div class="font-size-detail">
                            <div class="col-md-8 font-grey">
                                <span class="margin-right">Student ID : {{ auth()->user()['username'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="col-md-12 font-size-title padding-top padding-bottom text-bold">
                @if(session('hasHspApp'))
                    High School Exchange
                @endif
            </div>

            {{--side bar--}}
            <div class="col-md-4">
                <div class="col-md-12">
                    <ul class="nav flex-column font-size-detail">
                        @if(session('hasHspApp'))
                            @foreach($nav_bars as $nav_bar)
                                @if(session('hspApp')->state >= $nav_bar['show_in_state'])
                                    @include('frontend.users.dashboard.template.nav_bar',[
                                        'label'                 =>  $nav_bar['label'],
                                        'route_url'             =>  Route::has($nav_bar['route_name']) ? route($nav_bar['route_name']) : '/',
                                        'route_name_to_active'  =>  explode(',',$nav_bar['route_name_to_active']),
                                    ])
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            {{--content--}}
            <div class="col-md-8">
                @yield('content')
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
@endsection