@extends('web.layout.layout')
@section('css')
    <link href="{{ asset('css/home/index.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!--NAvBar -->
    @include('web.partials.nav')
    <!--Carrito -->
    @include('web.partials.cart')
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active "
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2">
            </button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3">
            </button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <h5 class="text-carousel">First slide label</h5>
                <p class="text-carousel">Some representative placeholder content for the first slide.</p>
            </div>
            <div class="carousel-item">
                <h5 class="text-carousel">Second slide label</h5>
                <p class="text-carousel">Some representative placeholder content for the second slide.</p>
            </div>
            <div class="carousel-item">
                <h5 class="text-carousel">Third slide label</h5>
                <p class="text-carousel">Some representative placeholder content for the third slide.</p>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container">
        <div class="ex1">
            <a class="card" type="button">
                <img src="{{ asset('assets/icons/truck.svg') }}">
                <p>Envios en todos los dias</p>
            </a>
            <a class="card" type="button">
                <img src="{{ asset('assets/icons/shop.svg') }}">
                <p>Recogo en varias surcusales</p>
            </a>
            <a class="card" type="button">
                <img src="{{ asset('assets/icons/shield-check.svg') }}">
                <p>Productos con garantias</p>
            </a>
            <a class="card" type="button">
                <img src="{{ asset('assets/icons/tools.svg') }}">
                <p>Mantenimiento garantizado</p>
            </a>
            <a class="card" type="button">
                <img src="{{ asset('assets/icons/people.svg') }}">
                <p>Asesoramientos de productos</p>
            </a>
        </div>
        <br>
        <div class="ex2">
            <h6>Productos mas vendidos:</h6>
        </div>
        <br>
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
