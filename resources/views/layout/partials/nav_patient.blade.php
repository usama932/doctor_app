@php use Illuminate\Support\Facades\Request; @endphp
    <!-- Profile Sidebar -->
<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
    <div class="profile-sidebar">
        <div class="widget-profile pro-widget-content">
            <div class="profile-info-widget">
                <a href="#" class="booking-doc-img">
                    <img src="{{ asset_img('patients', auth()->user()->profile_image) }}" alt="User Image">
                </a>
                <div class="profile-det-info">
                    <h3>{{ auth()->user()->name }}</h3>
                    <div class="patient-details">
                        <h5><i class="fas fa-birthday-cake"></i> {{ \Carbon\Carbon::parse(auth()->user()->date_of_birth)->format("M d, Y") }}
                            ({{ auth()->user()->age }})</h5>
                        <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> {{ auth()->user()->address }}
                            , {{ auth()->user()->state }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-widget">
            <nav class="dashboard-menu">
                <ul>
                    <li class="{{ Request::routeIs('patient_dashboard') ? 'active' : '' }}">
                        <a href="{{ route('patient_dashboard') }}">
                            <i class="fas fa-columns"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="{{ Request::routeIs('appointments') ? 'active' : '' }}">
                        <a href="{{ route('appointments') }}">
                            <i class="fas fa-bookmark"></i>
                            <span>Appointments</span>
                        </a>
                    </li>
                    <li class="{{ Request::routeIs('invoices') ? 'active' : '' }}">
                        <a href="{{ route('invoices') }}">
                            <i class="fas fa-file"></i>
                            <span>Invoices</span>
                        </a>
                    </li>
{{--                    <li>--}}
{{--                        <a href="{{url('dependent')}}">--}}
{{--                            <i class="fas fa-users"></i>--}}
{{--                            <span>Dependent</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="{{url('chat')}}">--}}
{{--                            <i class="fas fa-comments"></i>--}}
{{--                            <span>Message</span>--}}
{{--                            <small class="unread-msg">23</small>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="{{url('patient-accounts')}}">--}}
{{--                            <i class="fas fa-file-invoice-dollar"></i>--}}
{{--                            <span>Accounts</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="{{url('orders-list')}}">--}}
{{--                            <i class="fas fa-list-alt"></i>--}}
{{--                            <span>Orders</span>--}}
{{--                            <small class="unread-msg">7</small>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="{{url('medical-records')}}">--}}
{{--                            <i class="fas fa-clipboard"></i>--}}
{{--                            <span>Add Medical Records</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="{{url('medical-details')}}">--}}
{{--                            <i class="fas fa-file-medical-alt"></i>--}}
{{--                            <span>Medical Details</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
                    <li class="{{ Request::routeIs('patient.profile.*') ? 'active' : '' }}">
                        <a href="{{ route('patient.profile') }}">
                            <i class="fas fa-user-cog"></i>
                            <span>Profile Settings</span>
                        </a>
                    </li>
                    <li class="{{ Request::routeIs('patient.password.edit') ? 'active' : '' }}">
                        <a href="{{ route('patient.password.edit') }}">
                            <i class="fas fa-lock"></i>
                            <span>Change Password</span>
                        </a>
                    </li>
                    <li>
                        <a
                            onclick="document.getElementById('formlogout').submit();"
                            href="#">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                        <form id="formlogout" method="POST" action="{{ route('logout') }}">@csrf</form>
                    </li>
                </ul>
            </nav>
        </div>

    </div>
</div>
<!-- / Profile Sidebar -->
