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
                                        <h5 class="mb-0">Register Account</h5>
                                        <p class="text-muted mt-2">Get your free Minia account now.</p>
                                    </div>
                                    <form class="needs-validation custom-form mt-4 pt-2"
                                          action="{{route('admin.registration')}}" method="post">
                                        @csrf
                                        <div class="mb-3 @error('email') has-error @enderror">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class=  "form-control" id="email"
                                                   placeholder="Enter email" required name="email"
                                                   value="">
                                            @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3 @error('name') has-error @enderror">
                                            <label for="name" class="form-label">Your name</label>
                                            <input type="text" class="form-control" id="name"
                                                   placeholder="Enter name" required name="name"
                                                   value="">
                                            @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3 @error('password') has-error @enderror">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password"
                                                   placeholder="Enter password" required name="password"
                                                   value="">
                                            @error('password')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <button class="btn btn-primary w-100 waves-effect waves-light"
                                                    type="submit" name="sendMe" value="1">Register
                                            </button>
                                        </div>
                                    </form>

                                    <div class="mt-5 text-center">
                                        <p class="text-muted mb-0">Already have an account ? <a
                                                href="{{route('admin.login')}}"
                                                class="text-primary fw-semibold">
                                                Login </a></p>
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
