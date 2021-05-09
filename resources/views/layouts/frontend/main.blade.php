<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="description"
          content="tu pizzería en Tarragona, donde se puede disfrutar de una amplia variedad de pizzas artesanales con ingredientes de primera calidad, además de ensaladas, carpaccio, pasta y piadina.">
    <meta name="keywords"
          content="pizzeria, pizza, tarragona, ensaladas, restaurante, cafeteria, bares, familiar, italiano">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="Spanish">
    <meta name="revisit-after" content=" days">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/styles/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/nav.css') }}">
    <link href="{{ asset('assets/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link rel="icon"
          type="image/png"
          href="{{ asset('assets/media/favicon.png') }}">
    <style type="text/css">
        .spacer-100 {
            display: block;
            height: 100px;
        }

        .spacer-50 {
            display: block;
            height: 50px;
        }

        h3.menu-section-title {
            font-size: 1.3em;
            padding: 5px;
        }
    </style>
</head>
<body>
<header class="header">
    <a href="{{ auth('admin')->check()? route('dashboard') : route('home') }}" class="logo">
        Pizzeria Cafeteria 8 y Medio</a>
    <input class="menu-btn" type="checkbox" id="menu-btn"/>
    <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
    <ul class="menu">
        @if(auth('admin')->check())
            <li><a href="{{ route('home') }}">Ordenes</a></li>
            <li><a href="{{ route('categories.index') }}">Categorias</a></li>
            <li><a href="{{ route('products.index') }}">Productos</a></li>
            <li><a href="{{ route('customers.index') }}">Usuarios</a></li>
            <!-- <li><a href="{{ route('admin.profile') }}">Perfil</a></li>-->
            <li><a href="javascript:void(0);" onclick="document.getElementById('logoutForm').submit();">Logout</a>
        @else
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('menu') }}">Menu</a></li>
            @php $count = \Darryldecode\Cart\Facades\CartFacade::getContent()->count(); @endphp
            <li><a href="{{ route('cart') }}">Carrito @if($count) <span
                        class="badge badge-success">{{ $count }}</span> @endif
                </a></li>
            @guest
                <li><a href="{{ route('login') }}">Ingresar</a></li>
                <li><a href="{{ route('register') }}">Registrarse</a></li>
            @endguest
            @auth
                <li><a href="{{ route('orders') }}">Pedidos</a></li>
                <li><a href="{{ route('profile') }}">Perfil</a></li>
                <li><a href="javascript:void(0);" onclick="document.getElementById('logoutForm').submit();">Logout</a>
                </li>

            @endauth
        @endif

            <form id="logoutForm" action="{{ route('logout') }}" method="post" class="form-inline d-inline">
                @csrf
            </form>

    </ul>
</header>
@yield('content')

{{-- para que no se vea el footer en el panel de admin --}}
@if(!auth('admin')->check())
<div class="footer">
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-3 item">
                    <h3>Explore</h3>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('menu') }}">Menu</a></li>
                        <li><a href="{{ route('cart') }}">Carrito</a></li>
                        <!-- <li><a href="{{ route('contact') }}">Contacto</a></li>-->
                    </ul>
                </div>
                <div class="col-sm-6 col-md-3 item">
                    <h3>Address</h3>
                    <ul>
                        Plaça de Mossèn
                        <br/>
                        Jacint Verdaguer, 6.
                        <br/>
                        43003, Tarragona.
                    </ul>
                </div>
                <div class="col-md-6 item text">
                    <h3>About Us</h3>
                    <p>Benvinguts a la Pizzeria Cafeteria 8 y Medio, la teva pizzeria a Tarragona, on es pot disfrutar
                        d'una amplia varietat de pizzas artesanals amb ingredients de primera qualitat, ademés
                        d'amanides, carpaccio, pasta i piadina.</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-12 col-lg-12 item">
                    <img src="{{ asset('assets/media/creative_commons.png') }}" class="logos"/>
                    <img src="{{ asset('assets/media/dondominio.png') }}" class="logos"/>
                    <img src="{{ asset('assets/media/wapps.png') }}" class="logos"/>
                </div>
            </div>
        </div>
    </footer>
</div>
@endif
<script type="text/javascript"  src="{{ asset('assets/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript"  src="{{ asset('assets/popper.min.js') }}"></script>
<script type="text/javascript"  src="{{ asset('assets/bootstrap.min.js') }}"></script>
<script type="text/javascript"  src="{{ asset('assets/jquery.dataTables.min.js') }}"></script>
@stack('scripts')
</body>
</html>
