@extends('admin.layout')

@section('content')
    <div class="auth-page">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-xxl-3 col-lg-4 col-md-5">
                    <div class="auth-full-page-content d-flex p-sm-5 p-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100">
                                @include('admin.login.header_beforeForm')
                                <div class="auth-content my-auto">
                                    <div class="text-center">
                                        <h5 class="mb-0">Welcome Back !</h5>
                                        <p class="text-muted mt-2">Sign in to continue to Minia.</p>
                                    </div>
                                    <form class="custom-form mt-4 pt-2" action="{{route('admin.login')}}" method="post">
                                        @csrf
                                        <div class="mb-3 @error('email') has-error @enderror">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" class="form-control" id="email"
                                                   placeholder="Enter Email" required name="email" value="">
                                            @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 @error('password') has-error @enderror">
                                            <div class="d-flex align-items-start">
                                                <div class="flex-grow-1">
                                                    <label class="form-label" for="password">Password</label>
                                                </div>
                                                {{--<div class="flex-shrink-0">
                                                    <div class="">
                                                        <a href="auth-recoverpw.php" class="text-muted">Forgot password?</a>
                                                        <a href="#" class="text-muted">Forgot password?</a>
                                                    </div>
                                                </div>--}}
                                            </div>
                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" class="form-control" placeholder="Enter password"
                                                       name="password" value="" required aria-label="Password"
                                                       aria-describedby="password-addon">
                                                @error('password')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                                <button class="btn btn-light ms-0" type="button" id="password-addon">
                                                    <i class="mdi mdi-eye-outline"></i>
                                                </button>
                                            </div>
                                        </div>
                                        {{--<div class="row mb-4">
                                            <div class="col">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="remember-check">
                                                    <label class="form-check-label" for="remember-check">
                                                        Remember me
                                                    </label>
                                                </div>
                                            </div>
                                        </div>--}}
                                        <div class="mb-3">
                                            <button class="btn btn-primary w-100 waves-effect waves-light"
                                                    type="submit" name="sendMe" value="1">Log In
                                            </button>
                                        </div>
                                    </form>

                                    {{--<div class="mt-4 pt-2 text-center">
                                        <div class="signin-other-title">
                                            <h5 class="font-size-14 mb-3 text-muted fw-medium">- Sign in with -</h5>
                                        </div>

                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="javascript:void()"
                                                   class="social-list-item bg-primary text-white border-primary">
                                                    <i class="mdi mdi-facebook"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void()"
                                                   class="social-list-item bg-info text-white border-info">
                                                    <i class="mdi mdi-twitter"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void()"
                                                   class="social-list-item bg-danger text-white border-danger">
                                                    <i class="mdi mdi-google"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>--}}

                                    <div class="mt-5 text-center">
                                        <p class="text-muted mb-0">
                                            Don't have an account ? <a href="{{route('admin.registration')}}"
                                                                       class="text-primary fw-semibold">
                                                Signup now </a>
                                        </p>
                                    </div>
                                </div>
                                @include('admin.login.footer_afterForm')
                            </div>
                        </div>
                    </div>
                </div>
                @include('admin.login.rightSideCarousel')
            </div>
        </div>
    </div>
@endsection
