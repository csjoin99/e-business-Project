@extends('web.layout.layout')

@section('title')
    Checkout
@endsection

@section('css')
    <link href="{{ asset('css/checkout/index.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css"
        integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg=="
        crossorigin="anonymous" />
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
        <div class="container-fluid" id="grad1">
            <div class="row justify-content-center mt-0">
                <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
                    <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                        <h2><strong>Checkout</strong></h2>
                        <div class="row">
                            <div class="col-md-12 mx-0">
                                <div id="msform">
                                    <!-- progressbar -->
                                    <div id="shipment">
                                        <form action="{{route('checkout.post')}}" id="shipment-form" method="POST">
                                            @csrf
                                            <div class="form-card">
                                                <h2 class="fs-title">Datos de envío</h2>
                                                <input class="form-control" type="text" name="address"
                                                    placeholder="Dirección" required />
                                                <input class="form-control" type="text" name="reference"
                                                    placeholder="Referencia" required />
                                                <select class="form-control select-district" name="district" id="district"
                                                    required>
                                                    <option></option>
                                                    @foreach ($districts as $district)
                                                        <option value="{{ $district['nombre_ubigeo'] }}">
                                                            {{ $district['nombre_ubigeo'] }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="text" class="form-control datetimepicker-input"
                                                    id="shipment_date" data-toggle="datetimepicker"
                                                    data-target="#shipment_date" required />
                                                <h2 class="fs-title">Método de pago</h2>
                                                <div class="custom-control custom-radio">
                                                    <input id="paypal" name="payment_method" type="radio" value="paypal"
                                                        class="custom-control-input" checked="" required="">
                                                    <label class="custom-control-label" for="paypal">Paypal</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input id="upon-delivery" name="payment_method" type="radio"
                                                        value="upon-delivery" class="custom-control-input" required="">
                                                    <label class="custom-control-label"
                                                        for="upon-delivery">Contraentrega</label>
                                                </div>
                                            </div>
                                            <button type="submit" name="next" class="next action-button"
                                                data-target="payment">
                                                Pagar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment-with-locales.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js"
        integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA=="
        crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/web/checkout/index.js') }}"></script>
    <script>
        $('.select-district').select2({
            placeholder: "Selecciona su distrito",
            theme: 'bootstrap4',
            width: '100%'
        });
    </script>
    <script>
        $(function() {
            $('#shipment_date').datetimepicker({
                format: 'L',
                minDate: new Date(),
                daysOfWeekDisabled: [0, 6],
                locale: 'es'
            });
        });
    </script>
@endsection
