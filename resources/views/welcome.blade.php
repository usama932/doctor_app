@php
if(!empty(Session::get('locale')))
    {
        app()->setLocale(Session::get('locale'));
    }

    else{
         app()->setLocale('en');
    }
@endphp
<?php $page = "index-13"; ?>
@extends('layout.mainlayout_index1')
@section('title', 'Welcome')
@section('content')
    <!-- Header -->
    @include('components.patient_header')
    <!-- /Header -->
    <div class="row align-items-center">
        <div class="col-lg-5 col-md-12"></div>
        <div class="col-lg-7 col-md-12">
            <div class="home-four-doctor">
                <div class="home-four-header">
                    <h2>{{ __('message.Search_Doctor_Make_an') }} <span>{{ __('message.Appointments') }}</span></h2>
                </div>
                <div class="banner-four-form">
                    <form method="GET" action="{{ route('search_doctor') }}" class="banner-four-search">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="search"  class="form-control" value="{{ request('search') }}"
                                           placeholder="{{ __('message.Search_Location') }}">
                                    <i class="far fa-compass"></i>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="gender" class="select form-control">
                                        <option value="M">{{ __('message.Gender') }}</option>
                                        <option value="M"> {{ __('message.Male') }}</option>
                                        <option value="F"> {{ __('message.Female') }}</option>
                                        <option value="O"> {{ __('message.Other') }}</option>
                                    </select>
                                    <i class="far fa-smile"></i>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="speciality_id" class="select form-control">
                                        <option value="1"> {{ __('message.Departments') }}</option>
                                        @forelse($specialities as $speciality)
                                        <option value="{{ $speciality->id }}">{{ $speciality->name }}</option>
                                        @empty
                                        <option>No Department Found</option>
                                        @endforelse
                                    </select>
                                    <i class="fas fa-user-check"></i>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="form-group text-end mb-0">
                                    <button type="submit" class="btn theme-btn btn-four w-100"> {{ __('message.Search') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </section>
    <!-- /Home Banner -->

    <!-- Looking Section Four -->
    @include('components.patient_search_section')
    <!-- /Looking Section Four -->

    <!-- Clinic Section Four -->
    @include('components.patient_clinic_section')
    <!-- /Clinic Section Four -->

    <!-- Doctor Section Four -->
    @include('components.patient_doctor_section')
    <!-- /Doctor Section Four -->

    <!-- Features Clinic Four -->
    @include('components.patient_clinic_features_section')
    <!-- /Features Clinic Four -->

    <!-- Blog Section Four -->
    <x-patient_blogs_section/>
    <!-- /Blog Section Four -->
@endsection
@push("scripts")
    <script>
        $(document).ready(function(){
            $('.slider').slick({
                dots: true,
                arrows: true,
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 4
            });
        })
    </script>

@endpush

