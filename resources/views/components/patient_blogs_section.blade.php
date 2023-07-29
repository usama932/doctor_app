@php
if(!empty(Session::get('locale')))
    {
        app()->setLocale(Session::get('locale'));
    }

    else{
         app()->setLocale('en');
    }
@endphp
<div>
    <section class="blog-section-four">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header-four text-center aos" data-aos="fade-up">
                        <h2 class="title-four"> {{ __('message.Our Latest') }}<span class="color-primary">{{ __('message.Blogs') }}</span></h2>
                        <p class="sub-title color-grey">{{ __('message.blog_text') }}.</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex aos" data-aos="fade-up">
                    <div class="grid-blog-four w-100">
                        <div class="grid-blog-image">
                            <a href="{{url('blog-details')}}">
                                <img class="img-fluid" src="{{ URL::asset('/assets/img/blog/blog-01.jpg')}}"
                                     alt="News Image">
                            </a>
                            <div class="blog-title-four">
                                <a href="{{url('blog-details')}}" class="btn">Health</a>
                            </div>
                            <div class="blog-date-four">
                                <a href="#">
                                    <i class="feather-calendar me-2"></i>
                                    <span>4 Jan 2022</span>
                                </a>
                            </div>
                        </div>
                        <div class="blog-info-four">
                            <a href="{{url('blog-details')}}">How to handle patient body in MRI</a>
                        </div>
                        <div class="blog-doctors-four">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="#">
                                        <img src="{{ URL::asset('/assets/img/doctors/doctor-thumb-01.jpg')}}" alt=""
                                             class="me-2"><span>Dr. Ruby Perrin</span>
                                    </a>
                                </div>
                                <div>
                                    <p>Urology</p>
                                </div>
                            </div>
                        </div>
                        <div class="blog-four-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                        <div class="blog-four-arrow">
                            <a href="{{url('blog-details')}}">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex aos" data-aos="fade-up">
                    <div class="grid-blog-four w-100">
                        <div class="grid-blog-image">
                            <a href="{{url('blog-details')}}">
                                <img class="img-fluid" src="{{ URL::asset('/assets/img/blog/blog-02.jpg')}}"
                                     alt="News Image">
                            </a>
                            <div class="blog-title-four">
                                <a href="{{url('blog-details')}}" class="btn">General</a>
                            </div>
                            <div class="blog-date-four">
                                <a href="#">
                                    <i class="feather-calendar me-2"></i>
                                    <span>13 Feb 2022</span>
                                </a>
                            </div>
                        </div>
                        <div class="blog-info-four">
                            <a href="{{url('blog-details')}}">Doccure – Making your clinic painless visit?</a>
                        </div>
                        <div class="blog-doctors-four">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="#">
                                        <img src="{{ URL::asset('/assets/img/doctors/doctor-thumb-02.jpg')}}" alt=""
                                             class="me-2"><span>Dr. Darren Elder</span>
                                    </a>
                                </div>
                                <div>
                                    <p>Surgery</p>
                                </div>
                            </div>
                        </div>
                        <div class="blog-four-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                        <div class="blog-four-arrow">
                            <a href="{{url('blog-details')}}">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex aos" data-aos="fade-up">
                    <div class="grid-blog-four w-100">
                        <div class="grid-blog-image">
                            <a href="{{url('blog-details')}}">
                                <img class="img-fluid" src="{{ URL::asset('/assets/img/blog/blog-04.jpg')}}"
                                     alt="News Image">
                            </a>
                            <div class="blog-title-four">
                                <a href="{{url('blog-details')}}" class="btn">Neurology</a>
                            </div>
                            <div class="blog-date-four">
                                <a href="#">
                                    <i class="feather-calendar me-2"></i>
                                    <span>26 Mar 2022</span>
                                </a>
                            </div>
                        </div>
                        <div class="blog-info-four">
                            <a href="{{url('blog-details')}}">Benefits of consulting with an Online Doctor</a>
                        </div>
                        <div class="blog-doctors-four">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="#">
                                        <img src="{{ URL::asset('/assets/img/doctors/doctor-thumb-03.jpg')}}" alt=""
                                             class="me-2"> <span>Dr. Angel</span>
                                    </a>
                                </div>
                                <div>
                                    <p>Cardiology</p>
                                </div>
                            </div>
                        </div>
                        <div class="blog-four-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                        <div class="blog-four-arrow">
                            <a href="{{url('blog-details')}}">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="{{ route('blog-list') }}" class="btn btn-one"> {{ __('message.View More') }}</a>
            </div>
        </div>
    </section>
</div>
