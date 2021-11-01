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
        <h3 class="text-color-brand mb-2">Crear nueva cuenta de cliente</h3>
        <h4 class="text-color-brand mb-4">Información Personal</h4>
        <form id="form" action="{{ route('web.register.post') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-2">
                    <p>Nombre</p>
                </div>
                <div class="col-6 form-group">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" maxlength="100"
                        required>
                    @error('name')
                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Apellidos</p>
                </div>
                <div class="col-6 form-group">
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Apellidos"
                        maxlength="100" required>
                    @error('lastname')
                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <h4 class="text-color-brand my-4">Información de inicio de sesión</h4>
            <div class="row">
                <div class="col-2">
                    <p>Correo electrónico</p>
                </div>
                <div class="col-6 form-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico"
                        maxlength="100" required>
                    @error('email')
                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Contraseña</p>
                </div>
                <div class="col-6 form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña"
                        maxlength="100" required>
                    @error('password')
                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Confirmar contraseña</p>
                </div>
                <div class="col-6 form-group">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        maxlength="100" placeholder="Confirmar contraseña" data-rule-equalTo="#password" required>
                    @error('password_confirmation')
                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row mt-3">
                <button type="submit" class="btn btn-dark">Crear Usuario</button>
            </div>
        </form>
    </div>
    <br>
    @include('web.partials.footer')
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/web/shopping-cart/index.js') }}"></script>
    <script src="{{ asset('js/form-validation.js') }}"></script>
@endsection
