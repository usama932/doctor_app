@php
if(!empty(Session::get('locale')))
    {
        app()->setLocale(Session::get('locale'));
    }

    else{
         app()->setLocale('en');
    }
@endphp<!-- Main Wrapper -->
	<div class="main-wrapper">

		<!-- Header -->
		<div class="header">

			<!-- Logo -->
			<div class="header-left">
				<a href="{{ route('home') }}" class="logo">
					<img src="{{ URL::asset('/assets/img/logo.jpg')}}"  alt="Logo" style="height: 3rem; margin-left: 1rem;">
				</a>
				<a href="{{ route('home') }}" class="logo logo-small">
					<img src="{{ URL::asset('/assets/img/logo.jpg')}}"  alt="Logo" width="30" height="30" style="height: 3rem; margin-left: 1rem;">
				</a>

				<a href="javascript:void(0);" id="toggle_btn">
					<i class="feather-chevrons-left"></i>
				</a>
			</div>
			<!-- /Logo -->

			<!-- Search -->
			<div class="top-nav-search">
				<div class="main">
						<form class="search" method="post" action="index_admin" >
							<div class="s-icon"><i class="fas fa-search"></i></div>
							<input type="text" class="form-control" placeholder="{{ __('message.Start_typing_your_Search') }}..." />
							<ul class="results">
								<li>
									<h6><i class="feather-calendar me-1"></i> {{ __('message.Appointments') }}</h6>
									<p>{{ __('message.No_matched_Appointment_found') }}. <a href="{{url('upcoming-appointments')}}"><span>{{ __('message.view_all') }}</span></a></p>
								</li>
								<li>
									<h6><i class="feather-calendar me-1"></i>  {{ __('message.Specialities') }}</h6>
									<p>{{ __('message.No_matched_Appointment_found') }}. <a href="{{url('specialities')}}"><span>{{ __('message.view_all') }}</span></a></p>
								</li>
								<li>
									<h6><i class="feather-user me-1"></i> {{ __('message.doctors') }}</h6>
									<p>{{ __('message.No_matched_Appointment_found') }}. <a href="{{url('doctor-list')}}"><span>{{ __('message.view_all') }}</span></a></p>
								</li>
								<li>
									<h6><i class="feather-users me-1"></i> {{ __('message.Patients') }}</h6>
									<p>{{ __('message.No_matched_Appointment_found') }}. <a href="{{url('patient-list')}}"><span>{{ __('message.view_all') }}</span></a></p>
								</li>
							</ul>
						</form>
					</div>
			</div>
			<!-- /Search -->
			<!-- Mobile Menu Toggle -->
			<a class="mobile_btn" id="mobile_btn">
				<i class="fas fa-bars"></i>
			</a>
			<!-- /Mobile Menu Toggle -->

			<!-- Header Right Menu -->
			<ul class="nav nav-tabs user-menu">
				<!-- Flag -->
				<li class="nav-item">
					<a href="#" id="dark-mode-toggle" class="dark-mode-toggle">
						<i class="feather-sun light-mode"></i><i class="feather-moon dark-mode"></i>
					</a>
				</li>
                <li class="nav-item">
                <div class="row">

                    <div class="col-md-12">
                        <select class="form-control changeLang">
                            <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                            <option value="ar" {{ session()->get('locale') == 'ar' ? 'selected' : '' }}>Arabic</option>

                        </select>
                    </div>
                </div>
                </li>
				<!-- /Flag -->
				<!-- Notifications -->
				<li class="nav-item dropdown noti-nav">
					<a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
						<i class="feather-bell"></i> <span class="badge"></span>
					</a>
					<div class="dropdown-menu notifications">
						<div class="topnav-dropdown-header">
							<span class="notification-title">{{ __('message.Notifications') }}</span>
							<a href="javascript:void(0)" class="clear-noti"><i class="feather-more-vertical"></i></a>
						</div>
						<div class="noti-content">
							<ul class="notification-list">
									{{-- <li class="notification-message">
										<a href="#">
											<div class="media d-flex">
												<span class="avatar">
													<img class="avatar-img" alt="" src="{{ URL::asset('/assets_admin/img/profiles/avatar-02.jpg')}}">
												</span>
												<div class="media-body">
													<h6>Travis Tremble <span class="notification-time">18.30 PM</span></h6>
													<p class="noti-details">Sent a amount of $210 for his Appointment  <span class="noti-title">Dr.Ruby perin </span></p>
												</div>
											</div>
										</a>
									</li> --}}

								</ul>
						</div>
					</div>
				</li>
				<!-- /Notifications -->

				<!-- User Menu -->
					<li class="nav-item dropdown main-drop">
						<a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
							<span class="user-img">
                                @if(auth()->user()->profile_image ?? '')
                                    <img src="{{ asset('storage/images/admin/' . auth()->user()->profile_image) }}" alt="">
                                @else
								<img src="{{ URL::asset('/assets_admin/img/profiles/avatar-01.jpg')}}" alt="">
                                @endif
								<span class="status online"></span>
							</span>
						</a>
						<div class="dropdown-menu">
							<div class="user-header">
								<div class="avatar avatar-sm">
                                    @if(auth()->user()->profile_image ?? '')
                                        <img src="{{ asset('storage/images/admin/' . auth()->user()->profile_image) }}" alt="">
                                    @else
									<img src="{{ URL::asset('/assets_admin/img/profiles/avatar-01.jpg')}}" alt="User Image" class="avatar-img rounded-circle">
                                    @endif
								</div>
								<div class="user-text">
                                    @auth
									<h6>{{ auth()->user()->name }}</h6>
									<p class="text-muted mb-0">{{auth()->user()->email}}</p>
                                    @endauth
								</div>
							</div>
							<a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="feather-user me-1"></i> {{ __('message.My_Profile') }}</a>
							<a class="dropdown-item" href="{{ route('admin.profile.edit') }}"><i class="feather-edit me-1"></i> {{ __('message.Edit_Profile') }} </a>
							<a class="dropdown-item" href="{{route('admin.password.edit')}}"><i class="feather-lock me-1"></i>{{ __('message.Change_Password') }} </a>
							<hr class="my-0 ms-2 me-2">
							<a
                                onclick="document.getElementById('formlogout').submit();"
                                class="dropdown-item"
                                href="#"
                            >
                                <i class="feather-log-out me-1"></i>
                                {{ __('message.Logout') }}
                            </a>
                            <form id="formlogout" method="POST" action="{{ route('logout') }}">
                                @csrf
                            </form>
						</div>
					</li>
					<!-- /User Menu -->

			</ul>
			<!-- /Header Menu -->

		</div>
		<!-- /Header -->
