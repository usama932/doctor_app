<div class="main-wrapper">

    <!-- Header -->
    <header class="header">
        <nav class="navbar navbar-expand-lg header-nav">
            <div class="navbar-header">
                <a id="mobile_btn" href="javascript:void(0);">
				<span class="bar-icon">
					<span></span>
					<span></span>
					<span></span>
				</span>
                </a>
                <a href="{{ route('home') }}" class="navbar-brand logo">
                    <img src="{{ URL::asset('/assets/img/logo.jpg')}}" class="img-fluid ml-4" alt="Logo" style="height: 3rem;">
                </a>
            </div>

            <ul class="nav header-navbar-rht">
                    @auth
                        <li class="nav-item dropdown has-arrow logged-item">
                            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
					<span class="user-img">
                        <img class="rounded-circle" src="{{ asset_img("doctors",auth()->user()->profile_image ) }}" width="31">
					</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="user-header">
                                    <div class="avatar avatar-sm">
                                        <img src="{{ asset_img('doctors', Auth()->user()->profile_image) }}" class="avatar-img rounded-circle">
                                    </div>
                                    <div class="user-text">
                                        <h6>{{ auth()->user()->name }}</h6>
                                        <p class="text-muted mb-0">Doctor</p>
                                    </div>
                                </div>
                                <a class="dropdown-item" href="{{url('home')}}">Dashboard</a>
                                <a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a>
                                <a onclick="document.getElementById('formlogout').submit();"
                                    class="dropdown-item"
                                    href="#">
                                    Logout
                                </a>
                                <form id="formlogout" method="POST" action="{{ route('logout') }}">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link header-login" href="{{ route('login') }}">login / Signup </a>
                        </li>
                    @endauth
            </ul>
        </nav>
    </header>
    <!-- /Header -->


</div>
