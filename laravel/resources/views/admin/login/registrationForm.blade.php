@extends('admin.layout')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="tab" role="tabpanel">
                <ul class="nav nav-tabs" role="tablist">
                    {{--<li role="presentation" class="active">
                        <a href="#Section1" aria-controls="home" role="tab" data-toggle="tab">sign in</a>
                    </li>--}}
                    <li role="presentation" class="active">
                        <a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab">sign up</a>
                    </li>
                </ul>
                <div class="tab-content tabs">
                    <div role="tabpanel" class="tab-pane fade in active" id="Section2">
                        <form class="form-horizontal" method="post" action="{{route('admin.registration')}}">
                            @csrf
                            <div class="form-group">
                                <label for="SingUpName">Your name</label>
                                <input type="text" class="form-control" id="SingUpName" name="name">
                                @error('name')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="SingUpEmail">Email</label>
                                <input type="email" class="form-control" id="SingUpEmail" name="email">
                                @error('email')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="SingUpPassword">Password</label>
                                <input type="password" class="form-control" id="SingUpPassword" name="password">
                                @error('password')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-default" name="sendMe" value="1">Sign up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
