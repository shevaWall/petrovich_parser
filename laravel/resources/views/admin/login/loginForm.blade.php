@extends('admin.layout')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="tab" role="tabpanel">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#Section1" aria-controls="home" role="tab" data-toggle="tab">sign in</a>
                    </li>
                </ul>
                <div class="tab-content tabs">
                    <div role="tabpanel" class="tab-pane fade in active" id="Section1">
                        <form class="form-horizontal" method="post" action="{{route('admin.login')}}">
                            @csrf
                            <div class="form-group">
                                <label for="SingInEmail">Email</label>
                                <input type="email" class="form-control" id="SingInEmail" name="email">
                                @error('email')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="SingInPassword">Password</label>
                                <input type="password" class="form-control" id="SingInPassword" name="password">
                                @error('password')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            {{--<div class="form-group">
                                <div class="main-checkbox">
                                    <input value="None" id="SingInRememberMe" name="remember" type="checkbox">
                                    <label for="SingInRememberMe"></label>
                                </div>
                                <span class="text">Remember me</span>
                            </div>--}}
                            <div class="form-group">
                                <button type="submit" class="btn btn-default" name="sendMe" value="1">Sign in</button>
                            </div>
                            {{--<div class="form-group forgot-pass">
                                <button type="submit" class="btn btn-default">forgot password</button>
                            </div>--}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
