@extends('web.layout.layout')
@section('content')
    <!--NAvBar -->
    @include('web.partials.nav')
    <!--Carrito -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="cesta" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Mi cesta</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            No hay articulos
        </div>
    </div>
    <div class="container">
        <div class="breadcrumb">
            <div class="container">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tienda</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="ex3">
            @foreach ($products as $product)
                <button type="button" name="button">
                    <div class="card-img">
                        <img class="descripcion"
                            src="{{ $product->product_photo->count() ? $product->product_photo->first()->image : asset('img/web/no-img.png') }}"
                            alt="">
                    </div>
                    <div class="card-body">
                        <a href="{{ route('product.detail', ['slug' => $product->slug]) }}" class="descripcion">
                            {{ $product->name }}
                        </a>
                        <br>
                        @if ($product->discount)
                            <p class="text-muted text-decoration-line-through">S/{{ $product->price }}</p>
                        @endif
                        <p>S/{{ $product->real_price }}</p>
                    </div>
                </button>
            @endforeach
        </div>
    </div>
    <br>
    @include('web.partials.footer')
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
@endsection
