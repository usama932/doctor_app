<?php $page = "index-13"; ?>
@extends('layout.mainlayout_index1')
@section('title', 'Profile')
@section('content')
    <!-- Header -->
    @include('components.patient_header')
    <!-- /Header -->

    <div class="row align-items-center mt-4">

    </div>
    </div>
    </section>
    <!-- /Home Banner -->
    <section class="profile">
        <div class="content">
            <div class="container-fluid">

                <div class="row">

                    @include('layout.partials.nav_patient')

                    <div class="col-md-7 col-lg-8 col-xl-9">
                        @if(session()->has('flash'))
                            <x-alert>{{ session('flash')['message'] }}</x-alert>
                        @endif
                        <div class="container">

                            <!-- Doctor Widget -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="doctor-widget">
                                        <div class="doc-info-left">
                                            <div class="doctor-img">
                                                <img src="{{ asset_img('patients', $patient->profile_image) }}" class="img-fluid" >
                                            </div>
                                            <div class="doc-info-cont">
                                                <h2>{{ $patient->name }}</h2>
                                                <h4><span>@</span>{{ $patient->username }}</h4>
                                            </div>
                                        </div>
                                        <div class="doc-info-right">
                                            <div class="clini-infos">
                                                <a href="{{ route('patient.profile.edit') }}" class="edit-pro"><i
                                                        class="feather-edit"></i> Edit</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Doctor Widget -->

                            <!-- Doctor Details Tab -->
                            <div class="card">
                                <div class="card-body pt-0">

                                    <!-- Tab Content -->
                                    <div class="tab-content pt-0">

                                        <!-- Overview Content -->
                                        <div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12 border-bottom my-3">
                                                            <h6 class="pro-title">Personal Information</h6>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <h5>Date of Birth</h5>
                                                            @if($patient->date_of_birth)
                                                                <p>{{ \Carbon\Carbon::parse($patient->date_of_birth)->format("M d, Y") }}</p>
                                                            @else
                                                                <p>N/A</p>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <h5>Gender</h5>
                                                            @if($patient->gender ?? '')
                                                                @if($patient->gender == 'M')
                                                                    <p>Male</p>
                                                                @elseif($patient->gender == 'F')
                                                                    <p>Female</p>
                                                                @elseif($patient->gender == 'O')
                                                                    <p>Others</p>
                                                                @endif
                                                            @else
                                                                <p>N/A</p>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <h5>Age</h5>
                                                            @if($patient->age ?? '')
                                                                <p>{{ $patient->age }} years</p>
                                                            @else
                                                                <p>N/A</p>
                                                            @endif
                                                        </div>

                                                        <div class="col-md-12 border-bottom my-3">
                                                            <h6 class="pro-title">Address & Location</h6>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <h5>Address</h5>
                                                            @if($patient->address ?? '')
                                                                <p>{{ $patient->address }}</p>
                                                            @else
                                                                <p>N/A</p>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-4">
                                                            <h5>Country</h5>
                                                            @if($patient->country ?? '')
                                                                <p>{{ $patient->country }}</p>
                                                            @else
                                                                <p>N/A</p>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-4">
                                                            <h5>State</h5>
                                                            @if($patient->state ?? '')
                                                                <p>{{ $patient->state }}</p>
                                                            @else
                                                                <p>N/A</p>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-4">
                                                            <h5>Zip code</h5>
                                                            @if($patient->zip_code ?? '')
                                                                <p>{{ $patient->zip_code }}</p>
                                                            @else
                                                                <p>N/A</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!-- /Services List -->
                                                    <div class="profile-list">
                                                        <div class="row">
                                                            <div class="col-md-12 border-bottom my-3">
                                                                <div
                                                                    class="pro-title d-flex justify-content-between">
                                                                    <h6>Account Information</h6>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <h5>Email Address</h5>
                                                                <p>{{ $patient->email }}</p>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <h5>Phone Number</h5>
                                                                @if($patient->mobile ?? '')
                                                                    <p>{{ $patient->mobile }}</p>
                                                                @else
                                                                    <p>N/A</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Overview Content -->
                                    </div>
                                </div>
                            </div>
                            <!-- /Doctor Details Tab -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Page Content -->

@endsection


