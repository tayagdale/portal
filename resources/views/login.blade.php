@extends('layouts.simple')

@section('content')
    <!-- Page Content -->
    <div class="bg-image" style="background-image: url('assets/images/login.jpg');background-size: contain ">
        <div class="row g-0 bg-primary-dark-op">
            <!-- Meta Info Section -->
            <div class="hero-static col-lg-5 d-none d-lg-flex flex-column justify-content-center">
                <div class="p-4 p-xl-5 flex-grow-1 d-flex align-items-center">
                    <div class="w-100">
                        <a class="link-fx fw-semibold fs-2 text-white" href="./">
                            Steritex
                        </a>
                        <p class="text-white-75 me-xl-8 mt-2">
                            Welcome to your amazing app. Feel free to login and start managing your projects and clients.
                        </p>
                    </div>
                </div>
                <div class="p-4 p-xl-5 d-xl-flex justify-content-between align-items-center fs-sm">
                </div>
            </div>
            <!-- END Meta Info Section -->

            <!-- Main Section -->
            <div class="hero-static col-lg-7 d-flex flex-column align-items-center bg-body-extra-light">
                <div class="p-3 w-100 d-lg-none text-center">
                </div>
                <div class="p-4 w-100 flex-grow-1 d-flex align-items-center">
                    <div class="w-100">
                        <!-- Header -->
                        <div class="text-center mb-5">
                            <p class="mb-3">
                                <!-- <i class="fa fa-2x fa-circle-notch text-primary-light"></i> -->
                            </p>
                            <h1 class="fw-bold mb-2 text-default">
                                Admin Login
                            </h1>
                            <p class="fw-medium text-muted">
                                <!-- Welcome, please login or <a href="#" class="text-default">sign up</a> for a new account. -->
                            </p>
                        </div>
                        <!-- END Header -->

                        <!-- Sign In Form -->
                        <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _js/pages/op_auth_signin.js) -->
                        <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                        <div class="row g-0 justify-content-center">
                            <div class="col-sm-8 col-xl-4">
                                <form method="post" action="{{ route('login.perform') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    @include('layouts.partials.messages')
                                    <div class="mb-4">
                                        <input type="text" class="form-control form-control-lg form-control-alt py-3"
                                            id="login-username" name="username" value="{{ old('username') }}"
                                            placeholder="Username" autofocus>
                                        @if ($errors->has('username'))
                                            <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                                        @endif
                                    </div>
                                    <div class="mb-4">
                                        <input type="password" class="form-control form-control-lg form-control-alt py-3"
                                            id="login-password" name="password" placeholder="Password">
                                        @if ($errors->has('password'))
                                            <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div>
                                            {{-- <a class="text-muted fs-sm fw-medium d-block d-lg-inline-block mb-1"
                                                href="#">
                                                Forgot Password?
                                            </a> --}}
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-lg bg-default text-white">
                                                Sign In
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- END Sign In Form -->
                    </div>
                </div>
            </div>
            <!-- END Main Section -->
        </div>
    </div>
    <!-- END Page Content -->
@endsection
