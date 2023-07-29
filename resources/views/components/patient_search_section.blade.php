<div>
    <section class="looking-section-four">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header-four text-center aos" data-aos="fade-up">
                        <h2> {{ __('message.What_are_you') }}<span class="color-primary">  {{ __('message.looking') }}</span>  {{ __('message.for') }}?</h2>
                    </div>
                </div>
            </div>
            <div class="row looking-row justify-content-center aos" data-aos="fade-up">
                <div class="col-lg-4 col-md-6 looking-col d-flex">
                    <div class="looking-grid-four w-100">
                        <div class="looking-box-four">
                            <div class="looking-inner-box">
                                <div class="looking-info-four">
                                    <a href="{{ route('search_doctor_index') }}">
                                        <i class="fas fa-user-md me-2"></i>  {{ __('message.looking') }}
                                    </a>
                                    <p>{{ __('message.Visit_a_Doctor_text.')}}</p>
                                </div>
                                <div class="looking-four-btn">
                                    <a href="{{ route('search_doctor_index') }}">
                                         {{ __('message.Book_Now')}} <i class="fas fa-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex looking-col">
                    <div class="looking-grid-four w-100">
                        <div class="looking-box-four">
                            <div class="looking-inner-box">
                                <div class="looking-info-four">
                                    <a href="{{ route('search_pharmacy') }}">
                                        <i class="fas fa-tablets me-2"></i> {{ __('message.Find a Pharmacy') }}
                                    </a>
                                    <p>{{ __('message.Find_a_Pharmacy_text') }}.</p>
                                </div>
                                <div class="looking-four-btn">
                                    <a href="{{ route('search_pharmacy') }}">
                                        {{ __('message.Find_now') }}  <i class="fas fa-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex looking-col">
                    <div class="looking-grid-four w-100">
                        <div class="looking-box-four">
                            <div class="looking-inner-box">
                                <div class="looking-info-four">
                                    <a href="#">
                                        <i class="fas fa-vial me-2"></i> {{ __('message.Find a Lab') }}
                                    </a>
                                    <p>{{ __('message.find_lab_text') }}</p>
                                </div>
                                <div class="looking-four-btn">
                                    <a href="#">
                                        {{ __('message.Book_Now')}}<i class="fas fa-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
