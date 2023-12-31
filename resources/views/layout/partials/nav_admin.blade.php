<!-- Sidebar -->
@php
if(!empty(Session::get('locale')))
    {
        app()->setLocale(Session::get('locale'));
    }

    else{
         app()->setLocale('en');
    }
@endphp<!-- Main Wrapper -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>
                <li class="{{ Request::routeIs('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}"><i class="feather-grid"></i> <span>{{ __('message.Dashboard') }}</span></a>
                </li>
                <li class="{{ Request::routeIs('speciality.*') ? 'active' : '' }}">
                    <a href="{{ route('speciality.index') }}"><i class="feather-package"></i> <span> {{ __('message.Specialities') }}</span></a>
                </li>
                <li class="{{ Request::routeIs('hospital.*') ? 'active' : '' }}">
                    <a href="{{ route('hospital.index') }}"><i class="feather-home"></i> <span>{{ __('message.Hospitals') }}</span></a>
                </li>
                <li class="{{ Request::routeIs('doctor.*') ? 'active' : '' }}">
                    <a href="{{ route('doctor.index') }}"><i class="feather-user-plus"></i> <span>{{ __('message.doctors') }}</span></a>
                </li>
                <li class="{{ Request::routeIs('patient.*') ? 'active' : '' }}">
                    <a href="{{ route('patient.index') }}"><i class="feather-users"></i> <span> {{ __('message.Patients') }}</span></a>
                </li>
                <li class="{{ Request::routeIs('appointments') ? 'active' : '' }}">
                    <a href="{{ route('appointments') }}"><i class="feather-calendar"></i> <span>{{ __('message.Appointments') }}</span></a>
                </li>
                <li class="{{ Request::routeIs('blogs') ? 'active' : '' }}">
                    <a href="{{ route('blogs') }}"><i class="feather-grid"></i> <span>{{ __('message.Blogs') }}</span></a>
                </li>
                <li class="{{ Request::routeIs('invoices') ? 'active' : '' }}">
                    <a href="{{ route('invoices') }}"><i class="feather-users"></i> <span>{{ __('message.Invoices') }}</span></a>
                </li>
                <li class="{{ Request::routeIs('settings') ? 'active' : '' }}">
                    <a href="{{ route('settings') }}"><i class="feather-users"></i> <span>{{ __('message.Settings') }}</span></a>
                </li>
                <li class="{{ Request::routeIs('reviews') ? 'active' : '' }}">
                    <a href="{{ route('reviews') }}"><i class="feather-star"></i> <span>{{ __('message.Reviews') }}</span></a>
                </li>
                {{--                            <li class="{{ Request::is('admin/appointment-list','admin/past-appointments','admin/upcoming-appointments') ? 'active' : '' }}">--}}
                {{--                                <a href="{{url('admin/upcoming-appointments')}}"><i class="feather-calendar"></i> <span>Appointments</span></a>--}}
                {{--                            </li>--}}
                {{--							<li  class="{{ Request::is('admin/transaction') ? 'active' : '' }}">--}}
                {{--								<a href="{{url('admin/transaction')}}"><i class="feather-credit-card"></i> <span>Transactions</span></a>--}}
                {{--							</li>--}}
                <li class="submenu {{ Request::is('admin/appointment-report','admin/income-report','admin/invoice-report','admin/user-reports') ? 'active' : '' }}">
                    <a href="#"><i class="feather-file-text"></i> <span> {{ __('message.Reports') }}</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ Request::routeIs('appointment_reports') ? 'active' : '' }}"
                               href="{{ route('appointment_reports') }}">{{ __('message.Appointments') }} {{ __('message.Report') }}</a></li>
                        <li><a class="{{ Request::routeIs('income_reports') ? 'active' : '' }}"
                               href="{{ route('income_reports') }}">{{ __('message.Income') }} {{ __('message.Report') }}</a></li>
                        <li><a class="{{ Request::routeIs('invoice_reports') ? 'active' : '' }}"
                               href="{{ route('invoice_reports') }}">{{ __('message.invoice') }} {{ __('message.Report') }}</a></li>
                        <li><a class="{{ Request::routeIs('user_reports') ? 'active' : '' }}"
                               href="{{ route('user_reports') }}">{{ __('message.Users') }} {{ __('message.Report') }}</a></li>
                    </ul>
                </li>
                <li class="menu-title">
                    <span>{{ __('message.Pharmacy') }}</span>
                </li>
                <li class="submenu {{ Request::is('admin/pharmacy-list','admin/pharmacy-category') ? 'active' : '' }}">
                    <a href="#"><i class="feather-file-plus"></i> <span> {{ __('message.Pharmacies') }}</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a class="{{ Request::is('admin/pharmacy-list') ? 'active' : '' }}"
                               href="{{ url('admin/pharmacy-list') }}">{{ __('message.all') }} {{ __('message.Pharmacies') }}</a></li>
                        <li><a class="{{ Request::is('admin/pharmacy-category') ? 'active' : '' }}"
                               href="{{ url('admin/pharmacy-category') }}">{{ __('message.Categories') }} </a></li>
                    </ul>
                </li>
                <li class="submenu {{ Request::is('admin/product-list','admin/product-category') ? 'active' : '' }}">
                    <a href="#"><i class="feather-shopping-cart"></i> <span> {{ __('message.Product') }} {{ __('message.List') }}</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a class="{{ Request::is('admin/product-list') ? 'active' : '' }}"
                               href="{{ url('admin/product-list') }}">{{ __('message.all') }} {{ __('message.Products') }}</a></li>
                        <li><a class="{{ Request::is('admin/product-category') ? 'active' : '' }}"
                               href="{{ url('admin/product-category') }}">{{ __('message.Categories') }}</a></li>
                    </ul>
                </li>
                <li class="menu-title">
                    <span>{{ __('message.Blog') }}</span>
                </li>
                <li class="submenu {{ Request::is('admin/blog','admin/active-blog','admin/add-blog','admin/edit-blog','admin/blog-details','admin/pending-blog') ? 'active' : '' }}">
                    <a href="#"><i class="feather-grid"></i> <span> {{ __('message.Blogs') }}  </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li>
                            <a class="{{ Request::is('admin/blog','admin/active-blog','admin/pending-blog') ? 'active' : '' }}"
                               href="{{ url('admin/active-blog') }}"> {{ __('message.Blog') }} </a></li>
                        <li><a class="{{ Request::is('admin/blog-details') ? 'active' : '' }}"
                               href="{{ url('admin/blog-details') }}"> {{ __('message.Blog') }} {{ __('message.Details') }} </a></li>
                        <li><a class="{{ Request::is('admin/add-blog') ? 'active' : '' }}"
                               href="{{ url('admin/add-blog') }}"> {{ __('message.Add') }} {{ __('message.Blog') }}  </a></li>
                        <li><a class="{{ Request::is('admin/edit-blog') ? 'active' : '' }}"
                               href="{{ url('admin/edit-blog') }}"> {{ __('message.Edit') }} {{ __('message.Blog') }}  </a></li>
                    </ul>
                </li>
                <li class="menu-title">
                    <span>{{ __('message.settings') }}</span>
                </li>
                <li class="{{ Request::routeIs('invoice-settings.*') ? 'active' : '' }}">
                    <a href="{{ route('invoice-settings') }}"><i class="feather-user"></i> <span>{{ __('message.Invoice') }} {{ __('message.settings') }}</span></a>
                </li>

                <li class="menu-title">
                    <span>{{ __('message.Admin') }} {{ __('message.settings') }}</span>
                </li>
                <li class="{{ Request::routeIs('admin.profile.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.profile') }}"><i class="feather-user"></i> <span>{{ __('message.Profile') }}</span></a>
                </li>
                <li class="{{ Request::routeIs('admin.password.edit') ? 'active' : '' }}">
                    <a href="{{ route('admin.password.edit') }}"><i class="feather-lock"></i> <span>{{ __('message.Change_Password') }}</span></a>
                </li>

            </ul>
            </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
