@extends('layout.mainlayout_hospital')
@section('title', 'Edit Profile')
@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="container">
            <!-- Profile Information -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm">

                        <!-- Change Password Form -->
                        <form method="POST" action="{{ route('hospital.password.update') }}">
                            @if(session()->has('flash'))
                                <x-alert>{{ session('flash')['message'] }}</x-alert>
                            @endif
                            @csrf
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" name="password" class="form-control">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control">
                                @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Save New Password</button>
                            </div>
                        </form>
                        <!-- /Change Password Form -->

                    </div>
                </div>
            </div>
            <!-- /Profile Information -->
        </div>
    </div>
    </div>

    </div>

    </div>
    <!-- /Page Content -->
    </div>
@endsection
