@extends('layout.mainlayout_admin')
@section('title', 'Add New Patient')
@section('content')
    <div class="page-wrapper">

        <!-- Specialities -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Add New Patient</h5>
                    </div>
                    <div class="card-body">
                        @if(session()->has('flash'))
                            <x-alert>{{ session('flash')['message'] }}</x-alert>
                        @endif
                        <form method="POST" action="{{ route('patient.store') }}" enctype="multipart/form-data">
                            @csrf
                            <!-- Name -->
                            <div class="form-group row">
                                <label for="name" class="col-form-label col-md-2">Patient Name</label>
                                <div class="col-md-10">
                                    <input id="name" name="name" type="text" class="form-control" value="{{ old('name') }}"
                                           placeholder="Enter patient name" required>
                                    @error('name')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Email -->
                            <div class="form-group row">
                                <label for="email" class="col-form-label col-md-2">Patient Email</label>
                                <div class="col-md-10">
                                    <input id="email" name="email" type="email" class="form-control" value="{{ old('email') }}"
                                           placeholder="Enter patient email" required>
                                    @error('email')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- Moblie  --}}
                            <div class="form-group row">
                                <label for="mobile" class="col-form-label col-md-2">Patient Mobile</label>
                                <div class="col-md-10">
                                    <input id="mobile" name="mobile" type="tel" class="form-control" value="{{ old('mobile') }}"
                                           placeholder="Enter patient mobile number" required>
                                    @error('mobile')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- type -->
                            <input type="hidden" name="user_type" id="user_type" value="U">
                            {{-- Date of birth --}}
                            <div class="form-group row">
                                <label for="date_of_birth" class="col-form-label col-md-2">Patient Date of Birth</label>
                                <div class="col-md-10">
                                    <input id="date_of_birth" name="date_of_birth" type="date" class="form-control" value="{{ old('date_of_birth') }}"
                                           placeholder="Enter Patient Date of Birth">
                                    @error('date_of_birth')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- Gender  --}}
                            <div class="form-group row">
                                <label for="gender" class="col-form-label col-md-2">Gender</label>
                                <div class="col-md-10">
                                    <select id="gender" name="gender" class="form-select select" required>
                                        <option value="">Select Gender</option>
                                        <option value="M" {{ old('gender') == "M" ? 'selected' : ''}}>Male</option>
                                        <option value="F" {{ old('gender') == "F" ? 'selected' : ''}}>Female</option>
                                        <option value="O" {{ old('gender') == "O" ? 'selected' : ''}}>Others</option>
                                    </select>
                                    @error('gender')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- Blood Group  --}}
                            <div class="form-group row">
                                <label for="blood_group" class="col-form-label col-md-2">Blood Group</label>
                                <div class="col-md-10">
                                    <select id="blood_group" name="blood_group" class="form-select select">
                                        <option value="">Select Blood Group</option>
                                        <option value="A+" {{ old('blood_group') == "A+" ? 'selected' : ''}}>A+</option>
                                        <option value="A-" {{ old('blood_group') == "A-" ? 'selected' : ''}}>A-</option>
                                        <option value="B+" {{ old('blood_group') == "B+" ? 'selected' : ''}}>B+</option>
                                        <option value="B-" {{ old('blood_group') == "B-" ? 'selected' : ''}}>B-</option>
                                        <option value="O+" {{ old('blood_group') == "O+" ? 'selected' : ''}}>O+</option>
                                        <option value="O-" {{ old('blood_group') == "O-" ? 'selected' : ''}}>O-</option>
                                        <option value="AB+" {{ old('blood_group') == "AB+" ? 'selected' : ''}}>AB+</option>
                                        <option value="AB-" {{ old('blood_group') == "AB-" ? 'selected' : ''}}>AB-</option>
                                    </select>
                                    @error('blood_group')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Password -->
                            <div class="form-group row">
                                <label for="password" class="col-form-label col-md-2">Password</label>
                                <div class="col-md-10">
                                    <input id="password" name="password" type="password" class="form-control"
                                           placeholder="Enter patient password" required>
                                    @error('password')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Profile Image -->
                            <div class="form-group row">
                                <label for="profile_image" class="col-form-label col-md-2">Patient Image</label>
                                <div class="col-md-10">
                                    <input id="profile_image" name="profile_image" class="form-control" type="file">
                                    @error('profile_image')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i> Add Patient
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Specialities -->
    </div>
    </div>
    <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->

@endsection
