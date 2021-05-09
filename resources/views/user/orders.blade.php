@extends('layouts.frontend.main')
@section('title', 'My Orders')
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
            <h3 class="title-big">Mis Pedidos</h3>
        </div>
        <div class="pt-lg-5 pt-4">
            <div class="row menu-body">

                <div class="col-lg-8 offset-lg-2 menu-section pr-lg-5">
                    <div>
                        @if($orders->count() > 0)
                            @foreach($orders as $order)
                                <div class="menu-item">
                                    <div class="row border-dot ">
                                        <div class="col-3">{{ $order->created_at->format('d M, Y h:i a') }}</div>
                                        <div class="col-5 menu-item-name">
                                            <h6>Order # {{ $order->id }}</h6>
                                            {!! $order->status_badge() !!}
                                        </div>
                                        <div class="col-4 menu-item-price text-right">
                                            <h6>{{ number_format($order->amount, 2) }}
                                            </h6>
                                            <a href="{{ route('order-detail', ['id' => $order->id]) }}" class="btn btn-link btn-simple p-0">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center">No has hecho ningún pedido todavía.
                                <a href="{{ route('menu') }}" class="btn-simple btn-link">Click aquí</a> para ir al menú.</p>
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

