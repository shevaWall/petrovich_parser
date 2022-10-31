<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{asset('favicon-admin.ico')}}">

    @if(Route::is('admin.users'))
        <link href="{{asset('js/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('js/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    @endif

    <link rel="stylesheet" href="{{asset('css/admin/preloader.min.css')}}" type="text/css" />
    <link href="{{asset('css/admin/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/admin/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/admin/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{asset('js/admin/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />

    <title>Административная панель</title>
</head>
<body>

<div id="layout-wrapper">
    @auth
        @include('admin.menu.header')
        @include('admin.menu.verticalMenu')
    @endauth
    <div class="main-content">
        @yield('content')
        @auth
            @include('admin.footer')
        @endauth
    </div>
</div>
<script src="{{asset('js/admin/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('js/admin/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/admin/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('js/admin/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('js/admin/libs/node-waves/waves.min.js')}}"></script>
<script src="{{asset('js/admin/libs/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('js/admin/libs/pace-js/pace.min.js')}}"></script>
<script src="{{asset('js/admin/pass-addon.init.js')}}"></script>
<script src="{{asset('js/admin/libs/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('js/admin/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('js/admin/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js')}}"></script>
@if(!Route::is('admin.registration') && !Route::is('admin.login'))
    @if(Route::is('admin.index'))
        <script src="{{asset('/js/admin/pages/dashboard.init.js')}}"></script>
    @endif

    @if(Route::is('admin.users'))
        <script src="{{asset('js/admin/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('js/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('js/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('js/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
        <script src="{{asset('js/admin/pages/datatable-pages.init.js')}}"></script>
    @endif

    <script src="{{asset('js/admin/app.js')}}"></script>
@endif
</body>
</html>
