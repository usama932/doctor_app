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
                        <!-- Change Password Form -->
                        <form method="POST" action="{{ route('admin.password.update') }}">
                            @csrf
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" name="password" class="form-control" />
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" />
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
    <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->

@endsection
