<?php $page = "index-13"; ?>
@extends('layout.mainlayout_index1')
@section('title', 'Edit Profile')
@section('content')
    <!-- Header -->
    @include('components.patient_header')
    <!-- /Header -->

    <div class="row align-items-center mt-4">

    </div>
    </div>
    </section>
    <!-- /Home Banner -->
    <section class="edit-profile">
        <div class="content">
            <div class="container-fluid">

                <div class="row">

                    @include('layout.partials.nav_patient')

                    <div class="col-md-7 col-lg-8 col-xl-9">
                        @if(session()->has('flash'))
                            <x-alert>{{ session('flash')['message'] }}</x-alert>
                        @endif
                        <div class="container">
                            <!-- Profile Information -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm">
                                        <form method="POST" action="{{ route('patient.profile.update') }}"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <!-- Basic -->
                                            <div class="col-md-12">
                                                <div class="pro-title d-flex justify-content-between">
                                                    <h6>Personal information</h6>
                                                </div>
                                            </div>
                                            <div class="form-row row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="name">Full Name</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                           placeholder="name" value="{{ old('name', $patient->name) }}" required>
                                                    @error('name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="email">Email</label>
                                                    <input type="text" class="form-control" id="email" name="email"
                                                           placeholder="email" value="{{ old('email',$patient->email) }}"
                                                           required>
                                                    @error('email')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="username">Username</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text" id="username">@</span>
                                                        <input type="text" class="form-control"
                                                               id="username"
                                                               name="username" placeholder="Username"
                                                               value="{{ old('username',$patient->username) }}" required
                                                               {{$patient->username ? "readonly": ""}}>
                                                        @error('username')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <label for="mobile">Phone number</label>
                                                    <input type="tel" class="form-control" id="mobile" name="mobile"
                                                           placeholder="+12345678" value="{{ old('mobile', $patient->mobile) }}">
                                                    @error('mobile')
                                                        <div class="text-danger">{{ $message }}</div>
                                                     @enderror
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="profile_image">Profile Image</label>
                                                    <input id="profile_image" name="profile_image"
                                                           class="form-control" type="file" />
                                                    @error('profile_image')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Personal Info -->
                                            <div class="form-row row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="date_of_birth">Date of birth</label>
                                                    <input type="date" class="form-control" id="date_of_birth"
                                                           name="date_of_birth" placeholder="date_of_birth"
                                                           value="{{ old('date_of_birth', $patient->date_of_birth) }}" required>
                                                    @error('date_of_birth')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="gender">Gender</label>
                                                    <div class="col-md-10">
                                                        <select id="gender" name="gender"
                                                                class="form-select select" required>
                                                            <option value="">Select Gender</option>
                                                            <option
                                                                value="M" {{ old('gender',$patient->gender) == "M" ? 'selected' : '' }}>
                                                                Male
                                                            </option>
                                                            <option
                                                                value="F" {{ old('gender',$patient->gender) == "F" ? 'selected' : '' }}>
                                                                Female
                                                            </option>
                                                            <option
                                                                value="O" {{ old('gender',$patient->gender) == "O" ? 'selected' : '' }}>
                                                                Others
                                                            </option>
                                                        </select>
                                                        @error('gender')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="blood_group">Blood Group</label>
                                                    <div class="col-md-10">
                                                        <select id="blood_group" name="blood_group"
                                                                class="form-select select">
                                                            <option value=""> Select Blood Group</option>
                                                            <option
                                                                value="A+" {{ old('blood_group',$patient->blood_group) == "A+" ? 'selected' : '' }}>
                                                                A+
                                                            </option>
                                                            <option
                                                                value="A-" {{ old('blood_group',$patient->blood_group) == "A-" ? 'selected' : '' }}>
                                                                A-
                                                            </option>
                                                            <option
                                                                value="B+" {{ old('blood_group',$patient->blood_group) == "B+" ? 'selected' : '' }}>
                                                                B+
                                                            </option>
                                                            <option
                                                                value="B-" {{ old('blood_group',$patient->blood_group) == "B-" ? 'selected' : '' }}>
                                                                B-
                                                            </option>
                                                            <option
                                                                value="O+" {{ old('blood_group',$patient->blood_group) == "O+" ? 'selected' : '' }}>
                                                                O+
                                                            </option>
                                                            <option
                                                                value="O-" {{ old('blood_group',$patient->blood_group) == "O-" ? 'selected' : '' }}>
                                                                O-
                                                            </option>
                                                            <option
                                                                value="AB+" {{ old('blood_group',$patient->blood_group) == "AB+" ? 'selected' : '' }}>
                                                                AB+
                                                            </option>
                                                            <option
                                                                value="AB-" {{ old('blood_group',$patient->blood_group) == "AB-" ? 'selected' : '' }}>
                                                                AB-
                                                            </option>
                                                        </select>
                                                        @error('blood_group')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Address -->
                                            <div class="form-row row">
                                                <div class="col-md-12 mb-3">
                                                    <label for="address">Address</label>
                                                    <input type="text" class="form-control" id="address"
                                                           name="address"
                                                           placeholder="Address" value="{{ old('address', $patient->address) }}" >
                                                    @error('address')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="country">Country</label>
                                                    <input type="text" class="form-control" id="country"
                                                           placeholder="Country" name="country"
                                                           value="{{ old('country', $patient->country) }}" >
                                                    @error('country')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="state">State</label>
                                                    <input type="text" class="form-control" id="state" name="state"
                                                           placeholder="State" value="{{ old('state',$patient->state) }}" >
                                                    @error('state')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="zip_code">Zip Code</label>
                                                    <input type="text" class="form-control" id="zip_code"
                                                           name="zip_code"
                                                           placeholder="Zip Code" value="{{ old('zip_code',$patient->zip_code) }}" >
                                                    @error('zip_code')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" type="submit">Update Profile</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /Profile Information -->
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- /Page Content -->

@endsection
