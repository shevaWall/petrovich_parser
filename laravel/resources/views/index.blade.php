@extends('layout')

@section('content')
    <div class="row">
        <div class="col-12 text-end">Последнее обновление: {dd.mm.yyyy} {hh:mm}</div>

        <div class="col">
            <button type="button" class="btn btn-primary" id="getCategory" data-delete-message="все текущие категории"
                    @if($category['status']) disabled @endif
                    data-url="{{route('parser.parseCategories')}}">Получить категории
            </button>
            @if(isset($category['count']))
                <p>В базе данных <b>{{$category['count']}}</b> категорий.</p>
            @endif
            @if($category['status'])
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{$category['progressbar']}}%;"
                         aria-valuenow="{{$category['progressbar']}}" aria-valuemin="0"
                         aria-valuemax="100">{{$category['progressbar']}}%
                    </div>
                </div>
            @endif
        </div>
        <div class="col">
            <button type="button" class="btn btn-primary" id="getShopItems" data-delete-message="все текущие товары"
                    data-url="{{route('parser.parseShopItems')}}">Получить товары
            </button>
            @if(isset($shopItems['count']))
                <p>В базе данных <b>{{$shopItems['count']}}</b> товаров.</p>
            @endif
            @if($shopItems['status'])
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{$shopItems['progressbar']}}%;"
                         aria-valuenow="{{$shopItems['progressbar']}}" aria-valuemin="0"
                         aria-valuemax="100">{{$shopItems['progressbar']}}%
                    </div>
                </div>
            @endif
        </div>
        <div class="col">
            <button type="button" class="btn btn-success" id="getAll"
                    data-delete-message="все текущие категории и товары"
                    data-url="{{route('parser.parseCategoriesAndShopItems')}}">Получить всё
            </button>
        </div>
        <div class="col">
            <button type="button" class="btn btn-danger" id="delAll">Удалить всё</button>
        </div>
    </div>
@endsection
