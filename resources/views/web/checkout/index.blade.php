@extends('web.layout.layout')

@section('title')
    Checkout
@endsection

@section('css')
    <link href="{{ asset('css/checkout/index.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
@endsection

@section('header')
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Checkout</h1>
                <p class="lead fw-normal text-white-50 mb-0"></p>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <section id="checkout-section">
        <div class="mt-5">
            <div class="container">
                <div class="mb-4">
                    <div class="col-lg-8 mx-auto text-center">
                        <h2 class="">Elija un metodo de pago</h2>
                    </div>
                </div>
            </div>
            <div class="mb-5 row">
                <div class="col-lg-7 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <div class="shadow-sm pt-4 pl-2 pr-2 pb-2">
                                <ul role="tablist"
                                    class="nav nav-tabs bg-light nav-pills rounded nav-fill mb-3">
                                    <li class="nav-item">
                                        <a data-toggle="pill" href="#upon_delivery" class="nav-link active ">
                                            <i class="fas fa-money-bill-wave mr-2"></i>
                                            Contra entrega
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a data-toggle="pill" href="#stripe" class="nav-link ">
                                            <i class="fas fa-credit-card mr-2"></i>
                                            Tarjeta
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div id="upon_delivery" class="tab-pane fade show active py-3 px-3">
                                <form id="upon-delivery-form" class="text-center" action="{{route('upon.delivery')}}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="subscribe btn btn-outline-primary shadow-sm">
                                        Finalizar compra
                                    </button>
                                </form>
                            </div>
                            <div id="stripe" class="tab-pane fade py-3 px-3">
                                <form id="strip-form" class="text-center" action="{{route('stripe')}}" method="POST">
                                    @csrf
                                    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                        data-key="{{ config('services.stripe.key') }}" data-amount="{{number_format(session()->get('order.total'),2,'','')}}" data-name="Portal Commerce"
                                        data-description="Compra" data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                        data-locale="auto">
                                    </script>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment-with-locales.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="{{ asset('js/web/checkout/index.js') }}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/javascript.util/0.12.12/javascript.util.min.js"></script>
@endsection
