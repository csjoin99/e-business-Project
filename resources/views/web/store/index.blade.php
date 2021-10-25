@extends('web.layout.layout')

@section('title')
    Tienda
@endsection

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
    <div id="store-container" class="container">
        <div class="ex3">
            <div class="row">
                <div class="col-sm-3">
                    <div class="Filtros">
                        <p>Filtros</p>
                        <select class="form-select" aria-label="Default select example"
                            v-on:change="filter_order($event)">
                            <option value="desc">Mayor Precio</option>
                            <option value="asc">Menor Precio</option>
                        </select>
                        <br>
                        <div class="Tipo">
                            <h5>Tipo de Producto</h5>
                            <hr>
                            @foreach ($categories as $category)
                                <label class="list-group-item">
                                    <input name="category-options" class="form-check-input me-1" type="checkbox"
                                        value="{{ $category->id }}" v-on:change="filter_category()">
                                    {{ $category->name }}
                                </label>
                            @endforeach
                            <h5>Precio</h5>
                            <hr>
                            <div class="d-flex align-items-center">
                                <input v-on:change="filter_range()" type="number" class="form-control form-control-xs"
                                    placeholder="Mínimo" name="min-range" min="0">
                                <div class="text-gray-350 mx-2">‒</div>
                                <input v-on:change="filter_range()" type="number" class="form-control form-control-xs"
                                    placeholder="Máximo" name="max-range" min="0" max="10000">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="col-sm-12">
                        <div class="ListProductos">
                            <p v-text="this.total">0 Artículos</p>
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                                <div class="col" v-if="products.length" v-for="item in products">
                                    <a class="Producto-items" v-bind:href="item.route" type="button">
                                        <img v-bind:src="item.image" alt="">
                                        <p class="name" v-text="item.name"></p>
                                        <p class="text-muted text-decoration-line-through" v-if="item.discount"
                                            v-text="`S/. ${item.price}`">S/. 0.00
                                        </p>
                                        <p style="color:orange" v-text="`S/. ${item.real_price}`">S/.
                                            0.00</p>
                                    </a>
                                </div>
                                <h1 v-else>No hay productos</h1>
                            </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('admin/plugins/toastr/toastr.min.js') }}"></script>
    <script>
        const purchase_message = "{{ session('purchase_message') }}";
        if (purchase_message) {
            toastr.success(purchase_message, 'Compra realizada')
        }
    </script>
    <script src="{{ asset('js/web/store/index.js') }}"></script>
@endsection
