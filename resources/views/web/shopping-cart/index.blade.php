@extends('web.layout.layout')

@section('title')
    Carrito de compra
@endsection

@section('css')
    <link href="{{ asset('css/shopping-cart/index.css') }}" rel="stylesheet" />
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
    <section id="shopping-cart-section" class="py-5">
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
                                        <tr v-if="!this.cart.length">
                                            <td colspan="4" class="text-center font-weight-bold">No hay items</td>
                                        </tr>
                                        <tr v-else v-for="item in this.cart">
                                            <td>
                                                <figure class="itemside align-items-center">
                                                    <div class="aside">
                                                        <img :src="item.options.image" class="img-sm"
                                                            style="object-fit: cover">
                                                    </div>
                                                    <figcaption class="info">
                                                        <a href="#" class="title text-dark" data-abc="true"
                                                            v-text="item.name"></a>
                                                        <p class="text-muted small" v-text="item.options.category"></p>
                                                    </figcaption>
                                                </figure>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" min="0"
                                                    :max="item.options.stock" v-model="item.qty"
                                                    v-on:change="cart_update_qty($event, item)">
                                            </td>
                                            <td>
                                                <div class="price-wrap">
                                                    <span class="price" v-text="`S/. ${item.subtotal}`"></span>
                                                    <small class="text-muted"
                                                        v-text="`S/. ${parseFloat(item.price).toFixed(2)}`"></small>
                                                </div>
                                            </td>
                                            <td class="text-right d-none d-md-block">
                                                <a role="button" class="btn btn-light" data-abc="true"
                                                    v-on:click="cart_delete_item(item)">Eliminar</a>
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
                                <form @submit.prevent="get_coupon($event)">
                                    <div class="form-group"> <label>Cupón</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control coupon" name="coupon"
                                                placeholder="Código de cupón" v-model="coupon.code">
                                            <span class="input-group-append">
                                                <button type="submit" class="btn btn-primary btn-apply coupon h-100">Buscar</button>
                                            </span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <dl class="dlist-align">
                                    <dt>Subtotal:</dt>
                                    <dd class="text-right ml-3 order-price" v-text="`S/. ${this.order.subtotal}`"></dd>
                                </dl>
                                <dl class="dlist-align">
                                    <dt>Descuento:</dt>
                                    <dd class="text-right text-danger ml-3 order-price" v-text="`- S/. ${this.order.discount}`"></dd>
                                </dl>
                                <dl class="dlist-align">
                                    <dt>Total:</dt>
                                    <dd class="text-right text-dark b ml-3 order-price" v-text="`S/. ${this.order.total}`"><strong></strong></dd>
                                </dl>
                                <hr>
                                <form @submit.prevent="submit_order($event)">
                                    <button type="submit" class="btn btn-primary btn-square btn-main" data-abc="true">
                                        Realizar compra
                                    </button>
                                </form>
                                <a href="{{route('store')}}" class="btn btn-success btn-square btn-main mt-2" data-abc="true">
                                    Seguir comprando
                                </a>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('admin/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('js/web/shopping-cart/index.js') }}"></script>
@endsection
