@extends('web.layout.layout')
@section('title')
    Detalle de {{ $product->name }}
@endsection
@section('css')
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <link href="{{ asset('css/home/index.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/product-detail/index.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @include('web.partials.nav')
    <!--Carrito -->
    @include('web.partials.cart')
    <section>
        <div class="breadcrumb">
            <div class="container">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('store') }}">Tienda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="container">
            <div class="ex2">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="carousel carousel-main">
                            @forelse ($product->product_photo as $photo)
                                <div class="carousel-image"><img src="{{ $photo->image }}" alt="">
                                </div>
                            @empty
                                <div class="carousel-image"><img src="{{ asset('img/web/no-img.png') }}" alt="">
                                </div>
                            @endforelse
                        </div>
                        <div class="carousel carousel-nav">
                            @forelse ($product->product_photo as $photo)
                                <div class="carousel-image"><img src="{{ $photo->image }}" alt="">
                                </div>
                            @empty
                                <div class="carousel-image"><img src="{{ asset('img/web/no-img.png') }}" alt="">
                                </div>
                            @endforelse
                        </div>
                        <br>
                        <br>
                    </div>
                    <div class="col-sm-4">
                        <div class="informacion">
                            <h4>{{ $product->name }}</h4>
                            @if ($product->discount)
                                <h5 class="text-muted text-decoration-line-through">S/. {{ $product->price }}</h5>
                            @endif
                            <h5 class="text-color-brand">S/. {{ $product->real_price }}</h5>
                            <p>Cantidad</p>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn-Cantidad" onclick="update_qty(-1)">-</button>
                                <input id="add_item_qty" type="number" class="input-Cantidad" value="1" min="1">
                                <button type="button" class="btn-Cantidad" onclick="update_qty(1)">+</button>
                            </div>
                            <br>
                            <button type="button" class="btn-Agregar" data-id="{{ $product->id }}"
                                v-on:click="cart_add_item($event)">Agregar al
                                Carrito</button>
                            <div class="info border-color-brand">
                                <p>
                                    {{ $product->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ex3">
            <div class="container">
                <h2>Productos relacionados</h2>
                <div class="carousel"
                    data-flickity='{ "freeScroll": true, "contain": true, "prevNextButtons": false, "pageDots": false,"autoPlay": true  }'>
                    @foreach ($recommended_products as $recommended_product)
                        <div class="carousel-cell">
                            <a class="Producto-Recomendados"
                                href="{{ route('product.detail', ['slug' => $recommended_product->slug]) }}">
                                <div class="w-100 d-flex justify-content-center">
                                    <img src="{{ $recommended_product->product_photo->count() ? $recommended_product->product_photo->first()->image : asset('img/web/no-img.png') }}"
                                        alt="">
                                </div>
                                <h6 class="text-center">{{ $recommended_product->name }}</h6>
                                @if ($recommended_product->discount)
                                    <p class="text-center text-muted text-decoration-line-through">
                                        S/{{ $recommended_product->price }}</p>
                                @endif
                                <p class="text-center">S/{{ $recommended_product->real_price }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @include('web.partials.footer')
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(
                function() {
                    $('.carousel-main').flickity();
                    // 2nd carousel, navigation
                    $('.carousel-nav').flickity({
                        asNavFor: '.carousel-main',
                        contain: true,
                        pageDots: false
                    });
                }, 500);
        });
    </script>
    <script src="{{ asset('js/web/shopping-cart/index.js') }}"></script>
    <script>
        const input = document.querySelector('input[id="add_item_qty"]');

        function update_qty(qty) {
            let new_value = parseInt(input.value) + parseInt(qty);
            if (new_value <= 1) {
                input.value = 1;
            } else {
                input.value = new_value;
            }
        }
        input.addEventListener('change', () => {
            if (input.value <= 1) {
                input.value = 1;
            }
        });
    </script>
@endsection
