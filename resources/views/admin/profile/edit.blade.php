@extends('layout.mainlayout_admin')
@section('title', 'Edit Profile')
@section('content')

<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Profile Information -->
        <div class="card-body">
            <div class="row">
                <div class="col-sm">
                    @if(session()->has('flash'))
                        <x-alert>{{ session('flash')['message'] }}</x-alert>
                    @endif
                    <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Basic -->
                        <div class="col-md-12">
                            <div class="pro-title d-flex justify-content-between">
                                <h6>Personal information</h6>
                            </div>
                        </div>

                        <div class="form-row row">
                            <div class="col-md-4 mb-3">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="name"
                                    value="{{ old('name', $admin->name) }}" required>
                                @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="email"
                                        value="{{ old('email', $admin->email) }}" required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="username">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="username">@</span>
                                    <input type="text" class="form-control" id="username"
                                            name="username" placeholder="Username" value="{{ old('username', $admin->username) }}">
                                    @error('username')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="mobile">Phone number</label>
                                <input type="tel" class="form-control" id="mobile" name="mobile"
                                        placeholder="+12345678" value="{{ old('mobile', $admin->mobile) }}">
                                @error('mobile')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="profile_image">Profile Image</label>
                                <input id="profile_image" name="profile_image" class="form-control" type="file">
                                @error('profile_image')
                                        <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Personal Info -->
                        <div class="form-row row">
                            <div class="col-md-4 mb-3">
                                <label for="date_of_birth">Date of birth</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                    placeholder="date_of_birth" value="{{ $admin->date_of_birth }}" required>
                                @error('date_of_birth')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="gender">Gender</label>
                                <div class="col-md-10">
                                    <select id="gender" name="gender" class="form-select select">
                                        <option value="">Select Gender</option>
                                        <option value="M" {{ old('gender', $admin->gender) == "M" ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="F" {{ old('gender', $admin->gender) == "F" ? 'selected' : '' }}>Female
                                        </option>
                                        <option value="O" {{ old('gender', $admin->gender) == "O" ? 'selected' : '' }}>Others
                                        </option>
                                    </select>
                                    @error('gender')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Address -->
                        <div class="form-row row">
                            <div class="col-md-12 mb-3">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Address" value="{{ old('address',$admin->address) }}">
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" id="country" placeholder="Country"
                                    name="country" value="{{ old('country',$admin->country) }}" required>
                                @error('country')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="state">State</label>
                                <input type="text" class="form-control" id="state" name="state" placeholder="State"
                                    value="{{ old('state',$admin->state) }}" required>
                                @error('state')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="zip_code">Zip Code</label>
                                <input type="text" class="form-control" id="zip_code" name="zip_code"
                                        placeholder="Zip Code" value="{{ old('zip_code',$admin->zip_code) }}" required>
                                @error('zip_code')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Description -->
                        <div class="form-row row">
                            <label for="description" class="col-form-label col-md-2">Description</label>
                            <div class="col-md-12 mb-3">
                            <textarea rows="5" cols="5"
                                id="description" name="description" class="form-control"
                                placeholder="Enter description here">{{ old('description',$admin->description) }}</textarea>
                            @error('description')
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
<!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->

@endsection
