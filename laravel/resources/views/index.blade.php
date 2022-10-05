@extends('layout')

@section('content')
    <div class="row">
        <div class="col-12 text-end">Последнее обновление: {dd.mm.yyyy} {hh:mm}</div>

        <div class="col">
            <a href="{{route('dispatch.categories')}}" type="button"
               class="btn btn-primary @if($parserInformation[0]->status) disabled @endif" id="getCategory"
            >Получить категории</a>

            <p>В базе данных <b>{{$categoryCount}}</b> категорий.</p>
            @if($parserInformation[0]->status)
                <div class="progress">
{{--                    todo: сделать прогрессбар--}}
                    {{--  <div class="progress-bar" role="progressbar" style="width: {{$category['progressbar']}}%;"
                           aria-valuenow="{{$category['progressbar']}}" aria-valuemin="0"
                           aria-valuemax="100">{{$category['progressbar']}}%
                      </div>--}}
                </div>
            @endif
        </div>
        <div class="col">
            <a href="{{route('dispatch.shopItems')}}" type="button"
               class="btn btn-primary @if($parserInformation[1]->status) disabled @endif" id="getShopItems"
            >Получить товары</a>

            <p>В базе данных <b>{{$shopItemCount}}</b> товаров.</p>
            @if($parserInformation[1]->status)
                <div class="progress">
                    {{-- <div class="progress-bar" role="progressbar" style="width: {{$shopItems['progressbar']}}%;"
                          aria-valuenow="{{$shopItems['progressbar']}}" aria-valuemin="0"
                          aria-valuemax="100">{{$shopItems['progressbar']}}%
                     </div>--}}
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
