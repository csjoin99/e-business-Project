@extends('web.layout.layout')

@section('title')
Tienda
@endsection

@section('header')
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Tienda</h1>
            <p class="lead fw-normal text-white-50 mb-0"></p>
        </div>
    </div>
</header>
@endsection

@section('content')
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">

        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach ($products as $product)
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Sale badge-->
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale
                    </div>
                    <!-- Product image-->
                    <a href="{{route('product.detail',['slug' => $product->slug])}}">
                        <img class="card-img-top" style="object-fit: cover; max-height: 150px"
                            src="{{$product->product_photo->count() ? $product->product_photo->first()->image : 'https://e7.pngegg.com/pngimages/709/358/png-clipart-price-toyservice-soil-business-no-till-farming-no-rectangle-pie.png' }}"
                            alt="{{$product->name}}" />
                    </a>
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">{{$product->name}}</h5>
                            <!-- Product reviews-->
                            {{-- <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div> --}}
                            <!-- Product price-->
                            @if ($product->discount)
                            <span class="text-muted text-decoration-line-through">S/.
                                {{number_format($product->price,2)}}</span>
                            @endif
                            S/. {{number_format($product->real_price,2)}}
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><button class="btn btn-outline-dark mt-auto" v-on:click="add_cart" data-id="{{$product->id}}">Añadir a
                                carrito</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection