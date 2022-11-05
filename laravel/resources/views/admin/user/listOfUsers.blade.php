@extends('admin.layout')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Пользователи</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Пользователи</a></li>
                                <li class="breadcrumb-item active">Список пользователей</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="mb-3">
                        <h5 class="card-title">Список пользователей <span class="text-muted fw-normal ms-2">({{$users->count()}})</span></h5>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                        <div>
                            <a href="{{route('admin.users.create')}}" class="btn btn-light"><i class="bx bx-plus me-1"></i> Add New</a>
                        </div>

                        <div class="dropdown">
                            <a class="btn btn-link text-muted py-1 font-size-16 shadow-none dropdown-toggle" href="#"
                               role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-horizontal-rounded"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive mb-4">
                <table class="table align-middle datatable dt-responsive table-check nowrap"
                       style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                    <thead>
                    <tr>
                        <th scope="col" style="width: 50px;">
                            <div class="form-check font-size-16">
                                <input type="checkbox" class="form-check-input" id="checkAll">
                                <label class="form-check-label" for="checkAll"></label>
                            </div>
                        </th>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Role</th>
                        <th scope="col">Email</th>
                        <th style="width: 80px; min-width: 80px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $usr)
                    <tr>
                        <th scope="row">
                            <div class="form-check font-size-16">
                                <input type="checkbox" class="form-check-input" id="contacusercheck1">
                                <label class="form-check-label" for="contacusercheck1"></label>
                            </div>
                        </th>
                        <td>
                            {{$usr->id}}
                        </td>
                        <td>
                            <img src="{{asset('images/admin/users/avatar-2.jpg')}}" alt="" class="avatar-sm rounded-circle me-2">
                            <a href="{{route('admin.users.profile', $usr->id)}}" class="text-body">{{$usr->name}}</a>
                        </td>
                        <td>UI/UX Designer</td>
                        <td>{{$usr->email}}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{route('admin.users.profile', $usr->id)}}">Обзор</a></li>
                                    <li><a class="dropdown-item" href="{{route('admin.users.edit', $usr->id)}}">Редактировать</a></li>
                                    <div class="dropdown-divider"></div>
                                    <li><a class="dropdown-item bg-danger text-white" href="{{route('admin.users.delete', $usr->id)}}">Удалить</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
