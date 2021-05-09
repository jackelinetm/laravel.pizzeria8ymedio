@extends('layouts.frontend.main')
@section('title', 'Order Placed')
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
            <h3 class="title-big">¡Hemos recibido tu orden!</h3>
        </div>
        <div class="pt-lg-5 pt-4">
            <div class="row">
                <div class="col-md-12">
                    <p style="text-align: center">Tu orden # {{ $order_id }} ha sido recibida. Te contactaremos pronto. Gracias.</p>
                    <p style="text-align: center"><a href="{{ route('menu') }}" class="btn btn-link">Continuar comprando</a></p>
                    <div class="spacer-100"></div>

                </div>
            </div>
        </div>
    </div>
    <div class="parallax2"></div>
@endsection

