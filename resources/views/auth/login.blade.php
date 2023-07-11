<?php $page = "index-13"; ?>
@extends('layout.mainlayout_index1')
@section('title', 'Login')
@section('content')
    <!-- Header -->
    @include('components.patient_header')
    <!-- /Header -->

    <div class="row align-items-center mt-4">

    </div>
    </div>
    </section>
    <!-- /Home Banner -->
    <section class="login">
        <!-- Page Content -->
        <div class="content" style="min-height:205px;">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-8 offset-md-2">

                        <!-- Login Tab Content -->
                        <div class="account-content">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-md-7 col-lg-6 login-left">
                                    <img src="{{ URL::asset('/assets/img/login-banner.png')}}" class="img-fluid"
                                         alt="Doccure Login">
                                </div>
                                <div class="col-md-12 col-lg-6 login-right">
                                    <div class="login-header">
                                        <h3>Login <span>Doccure</span></h3>
                                    </div>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group form-focus">
                                            <input type="text" class="form-control floating" name="email"
                                                id="Email" value="{{old('email')}}">
                                            <label class="focus-label">Enter Email</label>
                                            @error('0')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                            @error('email')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group form-focus">
                                            <input type="password" class="form-control floating pass-input"
                                                   name="password" id="password">
                                            <label class="focus-label">Enter Password</label><span
                                                class="fa fa-eye-slash toggle-password pt-4"></span>
                                            @error('0')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                            @error('password')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label class="custom_check mr-2 mb-0 d-inline-flex"> Remember me
                                                        <input type="checkbox" name="radio">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    @error('checkbox')
                                                    <div class="text-danger pt-2">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="col-6 text-end">
                                                    <a class="forgot-link" href="{{url('admin/forgot-password')}}">Forgot
                                                        Password ?</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-grid">
                                            <button class="btn btn-primary" type="submit">Login</button>
                                        </div>
                                        <div class="dont-have">Don't have an account? <a
                                                href="{{ route('register') }}">Sign up</a></div>
                                        <div class="login-or">
                                            <span class="or-line"></span>
                                            <p class="span-or">or login with </p>
                                        </div>
                                        <!-- Social Login -->
                                        <div class="social-login">
                                            <a href="#"><img
                                                    src="{{ URL::asset('/assets_admin/img/icon/google.png')}}"
                                                    class="img-fluid" alt="Logo"></a>
                                            <a href="#"><img
                                                    src="{{ URL::asset('/assets_admin/img/icon/facebook.png')}}"
                                                    class="img-fluid" alt="Logo"></a>
                                            <a href="#"><img
                                                    src="{{ URL::asset('/assets_admin/img/icon/twitter.png')}}"
                                                    class="img-fluid" alt="Logo"></a>
                                        </div>
                                        <!-- /Social Login -->
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /Login Tab Content -->

                    </div>
                </div>

            </div>

        </div>
        <!-- /Page Content -->
    </section>
    <!-- /Page Content -->

@endsection
