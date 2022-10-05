@extends('layout')

@section('content')
    <div class="row">
        @foreach($categoryChildrens as $categoryChildren)
            <div class="col-xl-2 col-lg-3 col-xxs-6 my-4">
                <a href="{{$categoryChildren->code}}">
                    {{$categoryChildren->name}}
                </a>
            </div>
        @endforeach
    </div>

    <div class="shopItems-list row">
        @foreach($shopItems as $shopItem)
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        @if(!isset($shopItem->img))
                            <img src="/images/no_photo.png" class="img-fluid rounded-start"
                                 alt="изображение отсутствует">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <h5 class="card-title">
                                        <a href="/catalog/{{$category->code}}/{{$shopItem->code}}">{{$shopItem->name}}</a>
                                    </h5>
                                    <p class="card-text">
                                        @foreach($shopItem->properties as $property)
                                            @if($property->is_description == true)
                                                {{$property->title}}: {{$property->value[0]->title}}{{$property->unit}}.
                                            @endif
                                        @endforeach
                                    </p>
                                </div>
                                <div class="col-4">
                                    <p>Цена за {{$shopItem->price_per}} </p>
                                    <b class="fs-3">{{$shopItem->price_gold}} ₽</b>
                                    <p class="text-muted">{{$shopItem->price_retail}} ₽</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="col-auto mx-auto">
            {{$shopItems->links()}}
        </div>
    </div>
@endsection
