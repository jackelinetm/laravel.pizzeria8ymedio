@extends('layouts.frontend.main')
@section('title', 'Detalle de pedido')
@section('content')

    <div class="container py-md-5">
        <br>
        <br>
        <div class="title-content">
            <h3 class="title-big">Order# {{ $order->id }}</h3>
            <div class="m-2 border-dot">Hecha por <strong>{{ $order->user->name }}, {{ $order->user->email }}</strong>
                el <strong>{{ $order->created_at->format('d M, Y h:i a') }}</strong> &mdash;
                Estado: <strong>{{ $order->status }}</strong> &nbsp; &nbsp;
                @if($order->status == \App\Models\Order::PENDING)
                <a href="{{ route('admin.orders.change-status', ['id' => $order->id, 'status' => \App\Models\Order::APPROVED]) }}"
                   class="btn btn-xs p-2 btn-success">Marcar como Approved</a>
                    @elseif($order->status == \App\Models\Order::APPROVED)
                    <a href="{{ route('admin.orders.change-status', ['id' => $order->id, 'status' => \App\Models\Order::PENDING]) }}"
                       class="btn btn-xs p-2 btn-warning">Marcar como Pending</a>
                @endif

                <a href="{{ route('dashboard') }}" class="btn btn-simple btn-link p-2">Volver a la lista de pedidos</a>
            </div>
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
                                        <h6>Total Amount</h6>
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
@endsection

