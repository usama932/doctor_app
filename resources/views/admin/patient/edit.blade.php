@extends('layout.mainlayout_admin')
@section('title', 'Edit Patient')
@section('content')
    <div class="page-wrapper">
        <!-- Patient edit -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit Patient</h5>
                    </div>
                    <div class="card-body">
                        @if(session()->has('flash'))
                            <x-alert>{{ session('flash')['message'] }}</x-alert>
                        @endif
                        <form method="POST" action="{{ route('patient.update', $patient) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <!-- Name -->
                            <div class="form-group row">
                                <label for="name" class="col-form-label col-md-2">Patient Name</label>
                                <div class="col-md-10">
                                    <input id="name" name="name" type="text" value="{{ old('name',$patient->name) }}"
                                        class="form-control" placeholder="Enter patient name" required>
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
                                    <input id="email" name="email" type="text" value="{{ old('email', $patient->email) }}"
                                        class="form-control" placeholder="Enter patient email" required >
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
                                    <input id="mobile" name="mobile" type="tel" class="form-control" value="{{ old('mobile', $patient->mobile) }}"   placeholder="Enter patient mobile number" required>
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
                                    <input id="date_of_birth" name="date_of_birth" type="date" class="form-control" value="{{ old('date_of_birth', $patient->date_of_birth) }}"
                                           placeholder="Enter Patient Date of Birth">
                                    @error('date_of_birth')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="gender" class="col-form-label col-md-2">Gender</label>
                                <div class="col-md-10">
                                    <select id="gender" name="gender" class="form-select select" required>
                                        <option value="">Select Gender</option>
                                        <option value="M" {{ old('gender',$patient->gender) == "M" ? 'selected' : '' }}>Male</option>
                                        <option value="F" {{ old('gender',$patient->gender) == "F" ? 'selected' : '' }}>Female
                                        </option>
                                        <option value="O" {{ old('gender',$patient->gender) == "O" ? 'selected' : '' }}>Others
                                        </option>
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
                                        <option value="A+" {{ old('blood_group', $patient->blood_group) == "A+" ? 'selected' : ''}}>A+</option>
                                        <option value="A-" {{ old('blood_group', $patient->blood_group) == "A-" ? 'selected' : ''}}>A-</option>
                                        <option value="B+" {{ old('blood_group', $patient->blood_group) == "B+" ? 'selected' : ''}}>B+</option>
                                        <option value="B-" {{ old('blood_group', $patient->blood_group) == "B-" ? 'selected' : ''}}>B-</option>
                                        <option value="O+" {{ old('blood_group', $patient->blood_group) == "O+" ? 'selected' : ''}}>O+</option>
                                        <option value="O-" {{ old('blood_group', $patient->blood_group) == "O-" ? 'selected' : ''}}>O-</option>
                                        <option value="AB+" {{ old('blood_group', $patient->blood_group) == "AB+" ? 'selected' : ''}}>AB+</option>
                                        <option value="AB-" {{ old('blood_group', $patient->blood_group) == "AB-" ? 'selected' : ''}}>AB-</option>
                                    </select>
                                    @error('blood_group')
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
                            {{-- Account  --}}
                            <div class="form-group row">
                                <label for="status" class="col-form-label col-md-2">Account Status</label>
                                <div class="col-md-10">
                                    <select id="status" name="status" class="form-select select">
                                        <option value="">Select Account Status</option>
                                        <option value="Active" {{ old('status', $patient->status) == "Active" ? 'selected' : ''}}>Active</option>
                                        <option value="Inactive" {{ old('status', $patient->status) == "Inactive" ? 'selected' : ''}}>Inactive</option>
                                    </select>
                                    @error('status')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i> Update
                                Patient Details
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Patient edit -->

        <!-- Password edit -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Change Password</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.patient.update.password', $patient) }}">
                            @csrf
                            <!-- Password -->
                            <div class="form-group row">
                                <label for="password" class="col-form-label col-md-2">New Password</label>
                                <div class="col-md-10">
                                    <input id="password" name="password" type="password"
                                        class="form-control" placeholder="Enter patient new password" required >
                                    @error('password')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password_confirmation" class="col-form-label col-md-2">Confirm Password</label>
                                <div class="col-md-10">
                                    <input id="password" name="password_confirmation" type="password"
                                        class="form-control" placeholder="Enter confirm password" required >
                                    @error('password_confirmation')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <button class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i> Update
                                Update Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Patient edit -->
    </div>
    </div>
    <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->

@endsection
