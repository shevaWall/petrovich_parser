@extends('admin.layout')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Редактирование пользователя</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('admin.users')}}">Пользователи</a></li>
                                <li class="breadcrumb-item"><a href="{{route('admin.users.profile', $user->id)}}">{{$user->name}}</a></li>
                                <li class="breadcrumb-item active">Редактирование</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <form class="card" method="post" action="{{route('admin.users.edit', $user->id)}}">
                        @csrf
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="mb-3">
                                            <label for="userName" class="form-label">Name</label>
                                            <input class="form-control" required type="text" name="name"
                                                   id="userName" value="{{$user->name}}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="userEmail" class="form-label">Email</label>
                                            <input class="form-control" required type="email" name="email"
                                                   id="userEmail" value="{{$user->email}}">
                                            @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary w-md" name="sendMe" value="1">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
