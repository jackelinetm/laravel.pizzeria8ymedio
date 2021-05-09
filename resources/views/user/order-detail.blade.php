@extends('layouts.frontend.main')
@section('title', 'Detalle de Pedido')
@section('content')

    <div class="container py-md-5">
        <br>
        <br>
        <div class="title-content text-center">
            <h6 class="sub-title">
                <strong>
                    <a href="{{ route('orders') }}" class="btn btn-simple btn-link">Volver a los pedidos</a>
                </strong>
            </h6>
            <h3 class="title-big">Pedido #{{ $order->id }}</h3>
        </div>
        <div class="pt-lg-5 pt-4">
            <div class="row menu-body">

                <div class="col-lg-8 offset-lg-2 menu-section pr-lg-5">
                    <div>
                        @foreach($order->order_lines as $line)
                            <div class="menu-item">
                                <div class="row border-dot ">
                                    <div class="col-2"><img src="{{ $line->product->get_image() }}"
                                                            class="img-responsive w-50"></div>
                                    <div class="col-6 menu-item-name">
                                        <h6>{{ $line->product->name }}</h6>
                                        <small>{{ $line->product->category->name }}</small>
                                    </div>
                                    <div class="col-4 menu-item-price text-right">
                                        <h6><small>{{ $line->quantity }} &times; {{ $line->price }} &nbsp;
                                                &mdash;
                                                &nbsp;</small> {{ number_format($line->amount, 2) }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                            <div class="menu-item">
                                <div class="row ">
                                    <div class="col-2"></div>
                                    <div class="col-6 menu-item-name">
                                        <h6>Cantidad Total</h6>
                                    </div>
                                    <div class="col-4 menu-item-price text-right">
                                        <h6>{{ number_format($order->amount, 2) }}</h6>
                                    </div>
                                </div>
                            </div>
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

