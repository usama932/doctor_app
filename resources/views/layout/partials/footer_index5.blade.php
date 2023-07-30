
@php
if(!empty(Session::get('locale')))
    {
        $lang = Session::get('locale');
        app()->setLocale(Session::get('locale'));
    }

    else{
        $lang = '';
         app()->setLocale('en');
    }
@endphp
<!-- Footer Four -->
<footer class="footer footer-four" @if($lang == 'ar') lang="ar" dir="rtl" direction="rtl" style="direction:rtl;" @endif>
    <div class="news-section-four">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="news-info">
                        <h2>{{ __('message.Subscribe to our Newsletter') }}</h2>
                        <p>{{ __('message.letter_text') }}</p>
                    </div>
                    <div class="footer-news-four">
                        <form>
                            <div class="form-group mb-0 mx-auto">
                                <input type="text" class="form-control mx-auto" placeholder="{{ __('message.Enter Your Email Address') }}">
                                <button type="submit" class="btn btn-one">{{ __('message.subscribe') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Top -->
    <div class="footer-top aos" data-aos="fade-up">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <!-- Footer Widget -->
                    <div class="footer-widget footer-contact">
                        <h2 class="footer-title">{{ __('message.contact_us') }}</h2>
                        <div class="footer-contact-info">
                            <div class="footer-address"><span><i class="feather-map-pin"></i></span>
                                <p>3556 Beech Street, San Francisco,
                                    <br>California, CA <br>94108</p>
                            </div>
                            @if($setting->phone ?? '')
                                <p><i class="feather-phone"></i>{{ $setting->phone }}</p>
                            @else
                                <p><i class="feather-phone"></i></p>
                            @endif
                            @if($setting->email ?? '')
                                <p class="mb-0"><i class="feather-mail"></i>{{ $setting->email }}</p>
                            @else
                                <p class="mb-0"><i class="feather-mail"></i></p>
                            @endif
                        </div>
                    </div>
                    <!-- /Footer Widget -->
                </div>
                @auth
                    @if(\Illuminate\Support\Facades\Auth::user()->is_patient())
                        <div class="col-lg-4 col-md-6">
                            <!-- Footer Widget -->
                            <div class="footer-widget footer-menu">
                                <h2 class="footer-title">{{ __('message.For') }}  {{ __('message.Patients') }}</h2>
                                <ul>
                                    <li><a href="{{ route('search_doctor') }}">{{ __('message.Search') }} {{ __('message.for') }} {{ __('message.Doctors') }} </a>
                                    </li>
                                    @auth
                                        <li><a href="{{ route('profile.index') }}">{{ __('message.my ') }}  {{ __('message.Profile ') }}</a>
                                        </li>
                                    @else
                                        <li><a href="{{ route('login') }}">{{ __('message.sign_in') }}</a>
                                        </li>
                                        <li><a href="{{ route('register') }}">{{ __('message.sign_up') }}</a>
                                        </li>
                                    @endauth
                                    <li><a href="{{ route('patient_dashboard') }}">{{ __('message.Patients') }} {{ __('message.Dashboard') }} </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /Footer Widget -->
                        </div>
                    @elseif(\Illuminate\Support\Facades\Auth::user()->is_doctor())
                        <div class="col-lg-4 col-md-6">
                            <!-- Footer Widget -->
                            <div class="footer-widget footer-menu">
                                <h2 class="footer-title">{{ __('message.for') }} {{ __('message.Doctors') }}</h2>
                                <ul>
                                    <li><a href="{{url('appointments')}}"> {{ __('message.Appointments') }}</a>
                                    </li>
                                    <li><a href="{{url('chat')}}">Chat</a>
                                    </li>
                                    <li><a href="{{url('doctor-dashboard')}}">  {{ __('message.Doctors') }} {{ __('message.Dashboard') }}</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /Footer Widget -->
                        </div>
                    @endif
                @else
                    <div class="col-lg-4 col-md-6">
                        <!-- Footer Widget -->
                        <div class="footer-widget footer-menu">
                            <h2 class="footer-title">   {{ __('message.for') }}  {{ __('message.Patients') }}</h2>
                            <ul>
                                <li><a href="{{ route('search_doctor') }}">  {{ __('message.Search') }} {{ __('message.for') }}   {{ __('message.doctors') }}</a>
                                </li>
                                <li><a href="{{ route('login') }}">  {{ __('message.sign_in') }} </a>
                                </li>
                                <li><a href="{{ route('register') }}">  {{ __('message.sign_up') }} </a>
                                </li>
                                <li><a href="{{ route('patient_dashboard') }}">   {{ __('message.Patients') }}  {{ __('message.Dashboard') }}</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /Footer Widget -->
                    </div>
                @endauth

                <div class="col-lg-4 col-md-6">
                    <!-- Footer Widget -->
                    <div class="footer-widget footer-menu">
                        <h2 class="footer-title"> {{ __('message.Social Network') }}</h2>
                        <ul>
                            <li><a href="#" target="_blank"><i class="fab fa-facebook me-2"></i>{{ __('message.Facebook') }} </a>
                            </li>
                            <li><a href="#" target="_blank"><i class="fab fa-twitter me-2"></i>{{ __('message.Twitter') }} </a>
                            </li>
                            <li><a href="#" target="_blank"><i class="fab fa-linkedin me-2"></i>{{ __('message.Linkedin') }} </a>
                            </li>
                            <li><a href="#" target="_blank"><i class="fab fa-instagram me-2"></i>{{ __('message.Instagram') }} </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /Footer Widget -->
                </div>
            </div>
        </div>
    </div>
    <!-- /Footer Top -->

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <!-- Copyright -->
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="copyright-text">
                            <p class="mb-0">&copy; {{date("Y")}} {{ $setting->website_name??'' }}. {{ __('message.All rights reserved') }}.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <!-- Copyright Menu -->
                        <div class="copyright-menu">
                            <ul class="policy-menu">
                                <li><a href="#">{{ __('message.Terms and Conditions') }}</a>
                                </li>
                                <li><a href="#"> {{ __('message.Policy') }}</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /Copyright Menu -->
                    </div>
                </div>
            </div>
            <!-- /Copyright -->
        </div>
    </div>
    <!-- /Footer Bottom -->
</footer>
<!-- /Footer One-->

</div>
<!-- /Main Wrapper -->
