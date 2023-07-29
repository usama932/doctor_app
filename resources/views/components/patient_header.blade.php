@php
    use Illuminate\Support\Facades\Request;
    $setting = \App\Models\Settings::query()->first();
@endphp
@php
if(!empty(Session::get('locale')))
    {
        app()->setLocale(Session::get('locale'));
    }

    else{
         app()->setLocale('en');
    }
@endphp
<div class="main-wrapper">
    <!-- Home Banner -->
    <section class="home-four-banner" style="overflow: visible">
        <!--Top Header -->
        <div class="home-four-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="left-top aos" data-aos="fade-up">
                            <ul>
                                @if($setting->phone ?? '')
                                <li><i class="feather-phone me-1"></i> {{ $setting->phone }}</li>
                                @else
                                <li><i class="feather-phone me-1"></i></li>
                                @endif
                                @if($setting->email ?? '')
                                <li><i class="feather-mail me-1"></i>{{ $setting->email }}</li>
                                @else
                                <li><i class="feather-mail me-1"></i></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="right-top aos" data-aos="fade-up">
                            <ul>
                                <li><a href="{{ $setting->facebook ?? '' }}" target="_blank"><i class="fab fa-facebook hi-icon"></i></a></li>
                                <li><a href="{{ $setting->linkedin ?? '' }}" target="_blank"><i class="fab fa-linkedin hi-icon"></i></a></li>
{{--                                <li><a href="{{ $setting->instagram }}" target="_blank"><i class="fab fa-instagram hi-icon"></i></a></li>--}}
                                <li><a href="{{ $setting->twitter ?? ''}}" target="_blank"><i class="fab fa-twitter hi-icon"></i></a></li>
                                <li><a href="{{ $setting->youtube ?? ''}}" target="_blank"><i class="fab fa-youtube hi-icon"></i></a></li>
                                <li>

                                    <select class="form-control changeLang">
                                        <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                                        <option value="ar" {{ session()->get('locale') == 'ar' ? 'selected' : '' }}>Arabic</option>

                                    </select>
                                </li>
                            </ul>

                        </div>



                    </div>
                </div>
            </div>
        </div>
        <!--/Top Header -->
        <div class="container">
            <header class="header">
                <div class="nav-bg home-four-nav">
                    <nav class="navbar navbar-expand-lg header-nav nav-transparent">
                        <div class="navbar-header">
                            <a id="mobile_btn" href="javascript:void(0);">
									<span class="bar-icon blue-bar">
										<span></span>
										<span></span>
										<span></span>
									</span>
                            </a>
                            @auth
                                <a href="{{ route('home') }}" class="navbar-brand logo">
                                    <img src="{{ asset('/assets/img/logo.jpg')}}" class="img-fluid"
                                         alt="Logo" style="height: 3rem">
                                </a>
                            @else
                                <a href="/" class="navbar-brand logo">
                                    <img src="{{ asset('/assets/img/logo.jpg')}}" class="img-fluid"
                                         alt="Logo" style="height: 3rem">
                                </a>
                            @endauth
                        </div>
                        <div class="main-menu-wrapper">
                            <div class="menu-header">
                                @auth
                                    <a href="{{ route('home') }}" class="menu-logo">
                                        <img src="{{ asset('/assets/img/logo.jpg')}}" class="img-fluid"
                                             alt="Logo" style="height: 3rem">
                                    </a>
                                @else
                                    <a href="{{ url('/') }}" class="menu-logo">
                                        <img src="{{ asset('/assets/img/logo.jpg')}}" class="img-fluid"
                                             alt="Logo" style="height: 3rem">
                                    </a>
                                @endauth
                                <a id="menu_close" class="menu-close" href="javascript:void(0);"> <i
                                        class="fas fa-times"></i>
                                </a>
                            </div>
                            <ul class="main-nav black-font grey-font mx-4">
                                @auth
                                    <li class="{{ Request::routeIs('home') ? 'active' : '' }}">
                                        <a href="{{ route('home') }}">{{ __('message.Home') }}</a>
                                    </li>
                                @else
                                    <li class="{{ Request::routeIs('/') ? 'active' : '' }}">
                                        <a href="/">{{ __('message.Home') }}</a>
                                    </li>
                                @endauth
                                <li class="{{ Request::routeIs('blog-list') ? 'active' : '' }}">
                                    <a href="{{ route('blog-list') }}">{{ __('message.Blogs') }}</a>
                                </li>
                                <li class="{{ Request::routeIs('about-us') ? 'active' : '' }}">
                                    <a href="{{ route('about-us') }}">{{ __('message.about_us') }} </a>
                                </li>
                                <li class="{{ Request::routeIs('contact-us') ? 'active' : '' }}">
                                    <a href="{{ route('contact-us') }}">{{ __('message.contact_us') }} </a>
                                </li>
                                @auth
                                @php
                                    $dashboardUrl = "home";
                                    if(auth()->user()->user_type == "U"){
                                        $dashboardUrl = "patient-dashboard";
                                    }
                                @endphp
                                    <li class="{{ Request::routeIs($dashboardUrl) ? 'active' : '' }}">
                                        <a href="{{ url($dashboardUrl) }}">{{ __('message.Dashboard') }}</a>
                                    </li>
                                @endauth
                            </ul>
                            <ul class="nav header-navbar-rht right-menu">
                            @auth
                                <li class="nav-item dropdown has-arrow logged-item">
                                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
					                    <span class="user-img">
                                            @php
                                                $path = "patients";
                                                if(auth()->user()->user_type == "D"){
                                                    $path = "doctors";
                                                }elseif(auth()->user()->user_type == "H"){
                                                    $path = "hospitals";
                                                }elseif(auth()->user()->user_type == "A"){
                                                    $path = "admin";
                                                }
                                            @endphp
                                            <img class="rounded-circle"
                                                 src="{{ asset_img($path, auth()->user()->profile_image) }}"
                                                 width="31"
                                                 alt="{{auth()->user()->name}}">
					                    </span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" style="z-index: 9999;">
                                        <div class="user-header">
                                            <div class="avatar avatar-sm">
                                                <img src="{{ asset_img($path, auth()->user()->profile_image) }}"
                                                    alt="{{auth()->user()->name}}"
                                                    class="avatar-img rounded-circle">
                                            </div>
                                            <div class="user-text">
                                                <h6>{{ auth()->user()->name }}</h6>
                                                <p class="text-muted mb-0">{{ auth()->user()->username }}</p>
                                            </div>
                                        </div>
                                        <a class="dropdown-item" href="{{url($dashboardUrl)}}">{{ __('message.Dashboard') }}</a>
                                        @php
                                            $profileUrl = "profile.index";
                                            if(auth()->user()->user_type == "D"){
                                                // $profileUrl = "";
                                            }elseif(auth()->user()->user_type == "H"){
                                                // $profileUrl = "";
                                            }elseif(auth()->user()->user_type == "A"){
                                                $profileUrl = "admin.profile.edit";
                                            }
                                        @endphp
                                        <a class="dropdown-item" href="{{ route($profileUrl) }}"> {{ __('message.Profile') }}</a>
                                        <a
                                            onclick="document.getElementById('formlogout').submit();"
                                            class="dropdown-item"
                                            href="#"
                                        >
                                            Logout
                                        </a>
                                        <form id="formlogout" method="POST" action="{{ route('logout') }}">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link theme-btn btn-four" href="{{url('login')}}">  {{ __('message.sign_in') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link theme-btn btn-four-light" href="{{url('register')}}">  {{ __('message.sign_up') }}</a>
                                </li>
                            @endauth
                            </ul>

                        </div>
                    </nav>
                </div>
            </header>
