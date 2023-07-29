
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
    <section class="doctor-section-four">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header-four text-center aos aos-init aos-animate" data-aos="fade-up">
                        <h2 class="title-four"> {{ __('message.Book Our') }} <span class="color-primary">{{ __('message.Best Doctor') }}</span></h2>
                        <p class="sub-title color-grey">{{ __('message.client_Text') }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 aos aos-init aos-animate" data-aos="fade-up">
                    <div class="slider">
                        @forelse($doctors as $doctor)
                            <div>
                                <div class="best-doctors-grid" style="width: 100%; display: inline-block;">
                                    <div class="best-doctors-img">
                                        <a href="{{ route('doctor_profile', $doctor->id) }}"
                                        tabindex="{{ $loop->index }}">
                                        <img src="{{ asset_img('doctors', $doctor->profile_image) }}"
                                            alt="" class="img-fluid object-fit"
                                            style="height: 291px;">
                                        </a>
                                    </div>
                                    <div class="best-doctors-info">
                                        <h3>
                                            <a href="{{ route('doctor_profile', $doctor->id) }}"
                                            tabindex="{{ $loop->index }}">Dr. {{ $doctor->name }}</a>
                                        </h3>
                                        @if($doctor->speciality ?? '')
                                        <p class="doctor-posting">{{ $doctor->speciality->name }}</p>
                                        @else
                                        <p class="doctor-posting">No Speciality Found</p>
                                        @endif
                                        @if($doctor->pricing == 'Free')
                                        <h5 class="doctors-amount">{{ $doctor->pricing }}</h5>
                                        @else
                                        <h5 class="doctors-amount">${{ $doctor->pricing }}</h5>
                                        @endif
                                        <div class="rating">
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star"></i>
                                            <span class="d-inline-block average-rating">4.9 ( 82 )</span>
                                        </div>
                                        <div class="booking-btn">
                                            <a href="{{ route('create_appointment', $doctor->id) }}" class="btn"
                                            tabindex="{{ $loop->index }}">
                                <span>
                                    Book Appointment <i class="fas fa-arrow-right ms-2"></i>
                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            {{-- <div class="slick-slide slick-active" data-slick-index="1" aria-hidden="false"
                                 role="tabpanel" id="slick-slide01" style="width: 324px;">
                                <div>
                                    <div class="best-doctors-grid"
                                         style="width: 100%; display: inline-block;">
                                        <div class="best-doctors-img">
                                            <a href="http://127.0.0.1:8000/doctor-profile" tabindex="0">
                                                <img
                                                    src="http://127.0.0.1:8000/assets/img/doctors/book-doctor-10.jpg"
                                                    alt="" class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="best-doctors-info">
                                            <h3><a href="http://127.0.0.1:8000/doctor-profile" tabindex="0">Dr.
                                                    Darren Elder</a></h3>
                                            <p class="doctor-posting">MBBS, MD - General Medicine, DNB</p>
                                            <h5 class="doctors-amount">$30 - $70</h5>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span
                                                    class="d-inline-block average-rating">4.9 ( 82 )</span>
                                            </div>
                                            <div class="booking-btn">
                                                <a href="http://127.0.0.1:8000/booking" class="btn"
                                                   tabindex="0">
                                    <span>
                                        Book Appointment <i class="fas fa-arrow-right ms-2"></i>
                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
