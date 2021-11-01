@extends('web.layout.layout')
@section('title')
    Inicio
@endsection
@section('css')
    <link href="{{ asset('css/home/index.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!--NAvBar -->
    @include('web.partials.nav')
    <!--Carrito -->
    @include('web.partials.cart')
    <div class="container py-5">
        <h3 class="text-color-brand">Inicio de sesion de cliente</h3>
        <div class="row">
            <div class="col-sm">
                <h5 class="text-color-brand">Clientes registrados</h5>
                <hr>
                <p>Si tiene una cuenta, inicie sesión con su dirección de correo electrónico.</p>
                <form class="" action="{{ route('web.login.post') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address(*)</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password(*)</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <button type="submit" class="btn btn-dark">Inciar sesion</button>
                    {{-- <a class="cambioContra" href="#">¿Olvidó su contraseña?</a> --}}
                    <div id="Help" class="form-text">(*)Campo necesario.</div>
                </form>
            </div>
            <div class="col-sm">
                <h5 class="text-color-brand">Nuevos clientes</h5>
                <hr>
                <p>Crear una cuenta tiene muchos beneficios: Pago más rápido, guardar más de una dirección, seguimiento de
                    pedidos y mucho más.</p>
                <a href="{{ route('web.register') }}" class="btn btn-dark btn-lg">Crear Cuenta</a>
            </div>
        </div>
    </div>
    <br>
    @include('web.partials.footer')
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/web/shopping-cart/index.js') }}"></script>
@endsection
