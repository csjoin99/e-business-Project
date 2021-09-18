@extends('web.layout.layout')

@section('title')
Carrito de compra
@endsection

@section('css')
<link href="{{asset('css/shopping-cart/index.css')}}" rel="stylesheet" />
@endsection

@section('header')
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Carrito de compra</h1>
            <p class="lead fw-normal text-white-50 mb-0"></p>
        </div>
    </div>
</header>
@endsection

@section('content')
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="container-fluid">
            <div class="row">
                <aside class="col-lg-9">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-borderless table-shopping-cart">
                                <thead class="text-muted">
                                    <tr class="small text-uppercase">
                                        <th scope="col">Productos</th>
                                        <th scope="col" width="120">Cantidad</th>
                                        <th scope="col" width="120">Precio</th>
                                        <th scope="col" class="text-right d-none d-md-block" width="200"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <figure class="itemside align-items-center">
                                                <div class="aside"><img src="https://i.imgur.com/1eq5kmC.png"
                                                        class="img-sm"></div>
                                                <figcaption class="info"> <a href="#" class="title text-dark"
                                                        data-abc="true">Tshirt with round nect</a>
                                                    <p class="text-muted small">SIZE: L <br> Brand: MAXTRA</p>
                                                </figcaption>
                                            </figure>
                                        </td>
                                        <td>
                                            <select class="form-control">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select> </td>
                                        <td>
                                            <div class="price-wrap"> <var class="price">$10.00</var> <small
                                                    class="text-muted"> $9.20 each </small> </div>
                                        </td>
                                        <td class="text-right d-none d-md-block">
                                            <a href="" class="btn btn-light" data-abc="true">Eliminar</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </aside>
                <aside class="col-lg-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <form>
                                <div class="form-group"> <label>Have coupon?</label>
                                    <div class="input-group"> <input type="text" class="form-control coupon" name=""
                                            placeholder="Coupon code"> <span class="input-group-append"> <button
                                                class="btn btn-primary btn-apply coupon">Apply</button> </span> </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <dl class="dlist-align">
                                <dt>Total price:</dt>
                                <dd class="text-right ml-3">$69.97</dd>
                            </dl>
                            <dl class="dlist-align">
                                <dt>Discount:</dt>
                                <dd class="text-right text-danger ml-3">- $10.00</dd>
                            </dl>
                            <dl class="dlist-align">
                                <dt>Total:</dt>
                                <dd class="text-right text-dark b ml-3"><strong>$59.97</strong></dd>
                            </dl>
                            <hr> <a href="#" class="btn btn-out btn-primary btn-square btn-main" data-abc="true"> Make
                                Purchase </a> <a href="#" class="btn btn-out btn-success btn-square btn-main mt-2"
                                data-abc="true">Continue Shopping</a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>
@endsection