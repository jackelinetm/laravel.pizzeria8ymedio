@extends('layouts.frontend.main')
@section('title', 'Our Menu')
@section('content')

    <div class="container py-md-5">
        <br>
        <br>
        <div class="title-content text-center">
            <h6 class="sub-title">
                <strong>
                    Elaboramos nuestros postres siguiendo la cocina tradicional italiana, añadiendo un toque de modernidad.
                </strong>
            </h6>
            <h3 class="title-big">Menu</h3>
        </div>

        @if(session()->has('message'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info text-center">{!! session('message') !!} <a class="btn btn-link p-0" href="{{ route('cart') }}">View Cart</a> </div>
            </div>
        </div>
        @endif
        <div class="pt-lg-5 pt-2">
            <div class="row menu-body">



                @foreach($categories as $category)
                <div class="col-lg-6 menu-section pr-lg-5">
                    <div>
                            {{--<img class="circular--square" src="./media/galeria/pizzeria4.jpg">--}}
                        <h3 class="menu-section-title">{!! $category->name !!}</h3>
                        <!-- Item starts -->
                        @foreach($category->products as $product)
                        <div class="menu-item">
                            <div class="row border-dot ">
                                <div class="col-4">
                                    <img src="{{ $product->get_image() }}"
                                         class="img-responsive w-100">
                                </div>
                                <div class="col-5 menu-item-name">
                                    <h6>{!! $product->name !!}</h6>
                                    <p><small>{!! $product->description !!}</small></p>
                                </div>
                                <div class="col-3 menu-item-price text-right">
                                    <form action="{{ route('add-to-cart') }}" method="post">
                                        @csrf
                                        <h6>{{ number_format($product->price, 2) }}</h6>
                                        <p><button type="submit" class="btn btn-link btn-simple p-0">Add to Cart</button></p>
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                    </form>

                                </div>
                            </div>
                            <div class="menu-item-description">

                            </div>
                        </div>
                        @endforeach
                        <!-- Item ends -->
                    </div>
                    <br>
                    <br>

                </div>
                <br>
                @endforeach
                {{--<div class="col-lg-6 menu-section pl-lg-5" id="piadina_rotolino_amanides">
                    <div id="piadina">
                        <div class="row justify-content-center">
                            <img class="circular--square" src="./media/galeria/pizzeria7.jpg">
                            <img class="circular--square" src="./media/galeria/bandeja2.jpg">
                            <img class="circular--square" src="./media/presentacion/bebidas.jpg">
                        </div>
                        <h3 class="menu-section-title">Piadina</h3>
                        <div class="menu-item">
                            <div class="row border-dot no-gutters">
                                <div class="col-8 menu-item-name">
                                    <h6>Llonganissa, mozzarella, ceba caramelitzada i salsa brava</h6>
                                </div>
                                <div class="col-4 menu-item-price text-right">
                                    <h6>4.5</h6>
                                </div>
                            </div>
                            <div class="menu-item-description">
                                <p>Longaniza, mozzarella, cebolla caramelizada y salsa brava</p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                </div>--}}
            </div>
        </div>
    </div>
    <div class="parallax2"></div>
@endsection

