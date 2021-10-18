@extends('web.layout.layout')

@section('title')
{{$product->name}}
@endsection

@section('css')
<link href="{{asset('css/product-detail/index.css')}}" rel="stylesheet" />
@endsection

@section('header')
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Producto</h1>
            <p class="lead fw-normal text-white-50 mb-0"></p>
        </div>
    </div>
</header>
@endsection

@section('content')
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="">
            <div class="container-fliud">
                <div class="wrapper row">
                    <div class="preview col-md-5">
                        <div class="preview-pic tab-content">
                            <div class="tab-pane active" id="pic-1"><img class="pop"
                                    src="{{$product->product_photo->count() ? $product->product_photo->first()->image : 'https://e7.pngegg.com/pngimages/709/358/png-clipart-price-toyservice-soil-business-no-till-farming-no-rectangle-pie.png'}}" />
                            </div>
                        </div>
                        @if ($product->product_photo->count())
                        <ul class="preview-thumbnail nav nav-tabs">
                            @foreach ($product->product_photo as $product_photo)
                            <li class="active">
                                <a data-target="{{"#pic-{$product_photo->id}"}}" data-toggle="tab">
                                    <img src="{{$product_photo->image}}" />
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                    <div class="details col-md-7">
                        <h3 class="product-title">{{$product->name}}</h3>
                        <h4 class="product-category">{{$product->category->name}}</h4>
                        <p class="product-description">
                            {{$product->description}}
                        </p>
                        <h4 class="price">Precio:
                            <del class="text-muted">{{$product->discount ? "S/. {$product->price}" : ""}}</del>
                            <span> S/.{{$product->real_price}}</span>
                        </h4>
                        <div class="action mt-5">
                            <button class="btn-cart btn btn-outline-dark mt-auto" v-on:click="add_cart" data-id="{{$product->id}}" type="button">Añadir a carrito</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script src="{{asset('js/web/product-detail/index.js')}}"></script>
<script>
    const img_list = document.querySelector(".preview-thumbnail").querySelectorAll('li');
    const img = document.querySelector("img[class='pop']");
    img_list.forEach((item)=>{
        item.querySelector("img").addEventListener('click',()=>{
            img.src = item.querySelector('img').src
        })
    })
</script>
@endsection