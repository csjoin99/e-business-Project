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
                                <form id="msform" v-on:submit.prevent="validate_first_step()">
                                    <!-- progressbar -->
                                    <ul id="progressbar">
                                        <li class="active" id="personal"><strong>Datos de reparto</strong></li>
                                        <li id="payment"><strong>Pago</strong></li>
                                        <li id="confirm"><strong>Finish</strong></li>
                                    </ul> <!-- fieldsets -->
                                    <fieldset>
                                        <div class="form-card">
                                            <h2 class="fs-title">Datos de envío</h2>
                                            <div>
                                                <input class="form-control" type="text" name="address"
                                                    placeholder="Dirección" v-model="shipment_data.address" />
                                                <label for="">error</label>
                                            </div>
                                            <input class="form-control" type="text" name="reference"
                                                placeholder="Referencia" v-model="shipment_data.reference" />
                                            <select class="form-control select-district" name="district" id="district"
                                                v-model="shipment_data.district">
                                                <option></option>
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district['nombre_ubigeo'] }}">
                                                        {{ $district['nombre_ubigeo'] }}</option>
                                                @endforeach
                                            </select>
                                            <input type="text" class="form-control datetimepicker-input" id="shipment_date"
                                                data-toggle="datetimepicker" data-target="#shipment_date"
                                                v-model="shipment_data.shipment_date" />
                                        </div>
                                        <input type="submit" name="next" class="next action-button" value="Next Step" />
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-card">
                                            <h2 class="fs-title">Payment Information</h2>
                                            <div class="radio-group">
                                                <div class='radio' data-value="credit">
                                                    <img src="https://i.imgur.com/XzOzVHZ.jpg" width="200px" height="100px">
                                                </div>
                                                <div class='radio' data-value="paypal">
                                                    <img src="https://i.imgur.com/jXjwZlj.jpg" width="200px" height="100px">
                                                </div>
                                                <br>
                                            </div>
                                            <label class="pay">Card Holder Name*</label>
                                            <input type="text" name="holdername" placeholder="" />
                                            <div class="row">
                                                <div class="col-9">
                                                    <label class="pay">Card Number*</label>
                                                    <input type="text" name="cardno" placeholder="" />
                                                </div>
                                                <div class="col-3">
                                                    <label class="pay">CVC*</label>
                                                    <input type="password" name="cvcpwd" placeholder="***" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3">
                                                    <label class="pay">Expiry Date*</label>
                                                </div>
                                                <div class="col-9">
                                                    <select class="list-dt" id="month" name="expmonth">
                                                        <option selected>Month</option>
                                                        <option>January</option>
                                                        <option>February</option>
                                                        <option>March</option>
                                                        <option>April</option>
                                                        <option>May</option>
                                                        <option>June</option>
                                                        <option>July</option>
                                                        <option>August</option>
                                                        <option>September</option>
                                                        <option>October</option>
                                                        <option>November</option>
                                                        <option>December</option>
                                                    </select>
                                                    <select class="list-dt" id="year" name="expyear">
                                                        <option selected>Year</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="button" name="previous" class="previous action-button-previous"
                                            value="Previous" />
                                        <input type="button" name="make_payment" class="next action-button"
                                            value="Confirm" />
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-card">
                                            <h2 class="fs-title text-center">Success !</h2>
                                            <br><br>
                                            <div class="row justify-content-center">
                                                <div class="col-3">
                                                    <img src="https://img.icons8.com/color/96/000000/ok--v2.png"
                                                        class="fit-image">
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="row justify-content-center">
                                                <div class="col-7 text-center">
                                                    <h5>You Have Successfully Signed Up</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
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
            theme: 'bootstrap4'
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
