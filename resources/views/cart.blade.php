@extends('layouts.frontend.main')
@section('title', 'Tu Carrito')
@section('content')

    <div class="container py-md-5">
        <br>
        <br>
        <div class="title-content text-center">
            <h6 class="sub-title">
                <strong>
                    &nbsp;
                </strong>
            </h6>
            <h3 class="title-big">Tu carrito</h3>
        </div>
        <div class="pt-lg-5 pt-4">
            <div class="row menu-body">
                @php
                    $cart_items = \Darryldecode\Cart\Facades\CartFacade::getContent();

                @endphp
                <div class="col-lg-8 offset-lg-2 menu-section pr-lg-5">
                    <div>
                        @if($cart_items->count() > 0)
                            @foreach($cart_items as $item)
                                <div class="menu-item">
                                    <div class="row border-dot ">
                                        <div class="col-2">
                                            <img src="{{ $item->attributes['image'] }}"
                                                 class="img-responsive w-50">
                                        </div>
                                        <div class="col-6 menu-item-name">
                                            <h6>{{ $item->name }}</h6>
                                            <small>{{ $item->attributes['category'] }}</small>
                                        </div>
                                        <div class="col-4 menu-item-price text-right">
                                            <form action="{{ route('remove-from-cart') }}" method="post">
                                                @csrf
                                                <h6><small>{{ $item->quantity }} &times; {{ $item->price }} &nbsp;
                                                        &mdash;
                                                        &nbsp;</small> {{ number_format($item->price*$item->quantity, 2) }}
                                                </h6>
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <button  type="submit" class="btn btn-link btn-simple p-0">Quitar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                                <div class="menu-item">
                                    <div class="row ">
                                        <div class="col-2"></div>
                                        <div class="col-6 menu-item-name">
                                            <h6>Total</h6>
                                        </div>
                                        <div class="col-4 menu-item-price text-right">
                                            <h6>{{ number_format(\Darryldecode\Cart\Facades\CartFacade::getTotal(), 2) }}</h6>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-2"></div>
                                        <div class="col-6 menu-item-name"></div>
                                        <div class="col-4 menu-item-price text-right">
                                            <a class="btn btn-primary" href="{{ route('checkout') }}">Checkout</a>
                                        </div>
                                    </div>
                                </div>

                        @else
                            <p class="text-center">Tu orden está vacía. <a href="{{ route('menu') }}"
                                 class="btn-simple btn-link">Click aquí</a> para ir al menú.</p>
                    @endif
                    <!-- Item ends -->

                    </div>
                    <br>
                    <br>

                </div>
                <br>
            </div>
        </div>
    </div>
    <div class="parallax2"></div>
@endsection

