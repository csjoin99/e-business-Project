@extends('web.layout.layout')

@section('css')
    <link href="{{ asset('css/home/index.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/store/index.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!--NAvBar -->
    @include('web.partials.nav')
    <!--Carrito -->
    @include('web.partials.cart')
    <br>
    <div class="ex1">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tienda</li>
                </ol>
            </nav>
        </div>
    </div>
    <br>
    <br>
    <div class="container">
        <div class="ex3">
            <div class="row">
                <div class="col-sm-3">
                    <div class="Filtros">
                        <p>Filtros</p>
                        <select class="form-select" aria-label="Default select example">
                            <option value="mayor-precio">Mayor Precio</option>
                            <option value="menor-precio">Menor Precio</option>
                        </select>
                        <br>
                        <div class="Tipo">
                            <h5>Tipo de Producto</h5>
                            <hr>
                            @foreach ($categories as $category)
                                <label class="list-group-item">
                                    <input class="form-check-input me-1" type="checkbox" value="{{ $category->slug }}">
                                    {{ $category->name }}
                                </label>
                            @endforeach
                            <h5>Precio</h5>
                            <hr>
                            <div class="d-flex align-items-center">
                                <input type="number" class="form-control form-control-xs" placeholder="Mínimo" min="1">
                                <div class="text-gray-350 mx-2">‒</div>
                                <input type="number" class="form-control form-control-xs" placeholder="Máximo" max="10000">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="ListProductos">
                        <p>{{ $total }}</p>
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                            @forelse ($products as $product)
                                <div class="col">
                                    <a class="Producto-items"
                                        href="{{ route('product.detail', ['slug' => $product->slug]) }}" type="button">
                                        <img src="{{ $product->product_photo->count() ? $product->product_photo->first()->image : asset('img/web/no-img.png') }}"
                                            alt="">
                                        <p class="name">{{ $product->name }}</p>
                                        @if ($product->discount)
                                            <p class="text-muted text-decoration-line-through">S/{{ $product->price }}</p>
                                        @endif
                                        <p style="color:orange">S/{{ $product->real_price }}</p>
                                    </a>
                                </div>
                            @empty
                                <h1>No hay productos</h1>
                            @endforelse
                        </div>
                    </div>
                </div>
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
@endsection
