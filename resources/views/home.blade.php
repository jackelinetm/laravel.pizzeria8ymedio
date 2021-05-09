@extends('layouts.frontend.main')
@section('title', 'Pizzeria Cafeteria 8 y medio')
@section('content')
    <div class="parallax1">

        <div class="center">
            <img src="{{ asset('assets/media/logoOchoyMedio.png') }}" alt="logo pzzeria cafeteria ocho y medio" class="image_full" />
            <img src="{{ asset('assets/media/isologo.png') }}" class="image_mobile">
        </div>

    </div>
    <div class="container">
        <br>
        <div class="row">
            @foreach($top_three_products as $product)
            <div class="col">
                <div class="card text-center ">
                    <div class="card-body" style="min-height: 390px;">
                        <h5 class="card-title">
                            <img class="circular--square" src="{{ empty($product->image)? asset('pizza.jpg') : asset('storage/images/' . $product->image) }}" />
                            <br/><br/>
                            <strong>{{ $product->name }}</strong>
                            <b>{{ $product->price }} €</b>
                        </h5>
                        <p>{!! $product->description !!}</p>
                        <a class="btn btn-primary btn-lg sharp" href="{{ route('menu') }}" role="button">Ir al menu</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <br>
    </div>
    <div class="parallax2"></div>
    @include('layouts.frontend.instagram-feed')
@endsection

