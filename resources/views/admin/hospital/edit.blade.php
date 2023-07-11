@extends('layout.mainlayout_admin')
@section('title', 'Edit Hospital')
@section('content')
    <div class="page-wrapper">

        <!-- Specialities -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit Hospital Details</h5>
                    </div>
                    <div class="card-body">
                        @if(session()->has('flash'))
                            <x-alert>{{ session('flash')['message'] }}</x-alert>
                        @endif
                        <form method="POST" action="{{ route('hospital.update', $hospital) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="form-group row">
                                <label for="hospital_name" class="col-form-label col-md-2">Hospital name</label>
                                <div class="col-md-10">
                                    <input id="hospital_name" name="hospital_name"
                                           value="{{ $hospital->hospital_name }}" type="text" class="form-control"
                                           placeholder="Enter Hospital name" required>
                                    @error('hospital_name')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-form-label col-md-2">Address</label>
                                <div class="col-md-10">
                                    <input id="address" name="address" value="{{ $hospital->address }}" type="text"
                                           class="form-control" placeholder="Enter Hospital Location" required>
                                    @error('address')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="city" class="col-form-label col-md-2">City</label>
                                <div class="col-md-10">
                                    <input id="city" name="city" type="text" value="{{ $hospital->city }}"
                                           class="form-control" placeholder="Enter Hospital Location" required>
                                    @error('city')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="country" class="col-form-label col-md-2">Country</label>
                                <div class="col-md-10">
                                    <input id="country" name="country" value="{{ $hospital->country }}" type="text"
                                           class="form-control" placeholder="Enter Hospital Location" required>
                                    @error('country')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="state" class="col-form-label col-md-2">State</label>
                                <div class="col-md-10">
                                    <input id="state" name="state" type="text" value="{{ $hospital->state }}"
                                           class="form-control" placeholder="Enter Hospital Location" required>
                                    @error('state')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="zip" class="col-form-label col-md-2">Hospital Zip</label>
                                <div class="col-md-10">
                                    <input id="zip" name="zip" type="text" value="{{ $hospital->zip }}"
                                           class="form-control" placeholder="Enter Hospital Zip Code" required>
                                    @error('zip')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-form-label col-md-2">Image</label>
                                <div class="col-md-10">
                                    <input id="image" name="image" class="form-control" type="file">
                                    @error('image')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-form-label col-md-2">Hospital Administrator name</label>
                                <div class="col-md-10">
                                    <input id="name" name="name" type="text" class="form-control"
                                           value="{{ $admin->name }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-form-label col-md-2">Hospital Administrator email</label>
                                <div class="col-md-10">
                                    <input id="email" name="email" type="email" class="form-control"
                                           value="{{ $admin->email }}">
                                </div>
                            </div>
                            <button class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i> Update
                                Hospital Details
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Specialities -->

        <!-- ChangePassword -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Change Hospital Password</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.hosptial.password.update', $hospital) }}">
                            @csrf
                            <div class="form-group row">
                                <label for="password" class="col-form-label col-md-2">New Password</label>
                                <div class="col-md-10">
                                    <input id="password" name="password"
                                        type="password" class="form-control"
                                        placeholder="Enter New Password" required>
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
                                    <input id="password_confirmation" name="password_confirmation"
                                        type="password" class="form-control"
                                        placeholder="Enter Confirm Password" required>
                                    @error('password_confirmation')
                                        <div class="text-danger pt-2">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i> Update
                                Change Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /ChangePassword -->
    </div>
    </div>
    <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->

@endsection
