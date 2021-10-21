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

@section('content')
    @include('web.partials.nav')
    <!--Carrito -->
    @include('web.partials.cart-static')
    <section id="checkout-section">
        <div class="mt-5">
            <div class="container">
                <div class="mb-4">
                    <div class="col-lg-8 mx-auto text-center">
                        <h2 class="">Datos de entrega</h2>
                    </div>
                </div>
            </div>
            <div class="
                            mb-5 row">
                <div class="col-lg-7 mx-auto">
                    <div class="card">
                        <div class="tab-content">
                            <form id="form" class="mx-5 my-3" action="{{ route('store.shipment.data') }}"
                                method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="address">
                                        <h6>Dirección</h6>
                                    </label>
                                    <div class="input-group">
                                        <input type="text" name="address" placeholder="Ingrese su dirección"
                                            class="form-control" value="{{ session()->get('shipment_data.address') }}"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="reference">
                                        <h6>Referencia</h6>
                                    </label>
                                    <div class="input-group">
                                        <input type="text" name="reference" placeholder="Ingrese la referencia"
                                            class="form-control" value="{{ session()->get('shipment_data.reference') }}"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="shipment_date">
                                        <h6>Fecha de entrega</h6>
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control datetimepicker-input" name="shipment_date"
                                            data-toggle="datetimepicker" data-target="#shipment_date"
                                            value="{{ session()->get('shipment_data.shipment_date') }}" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="district">
                                        <h6>Distrito</h6>
                                    </label>
                                    <select class="form-control select-district" name="district" required>
                                        <option></option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district['nombre_ubigeo'] }}"
                                                {{ session()->get('shipment_data.district') === $district['nombre_ubigeo'] ? 'selected' : '' }}>
                                                {{ $district['nombre_ubigeo'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="subscribe btn btn-primary btn-block shadow-sm">
                                        Siguiente
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment-with-locales.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="{{ asset('js/web/shipment-data/index.js') }}"></script>
    <script>
        $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: '< Ant',
            nextText: 'Sig >',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
                'Octubre', 'Noviembre', 'Diciembre'
            ],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
            weekHeader: 'Sm',
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['es']);
        $(function() {
            $(".datetimepicker-input").datepicker({
                dateFormat: 'dd-mm-yy',
                minDate: 0,
            });
        });
    </script>
@endsection
