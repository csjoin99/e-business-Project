@extends('admin.layout.app')
@section('title', 'Lista de pedidos')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/fullcalendar/main.css') }}">
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Pedidos</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div id="calendar"></div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <div class="modal fade" id="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Estado de envío</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="form-delivery" method="POST">
                                <input type="hidden" id="order_id" name="order_id">
                                <div class="form-group">
                                    <label for="lastname">Entrega</label>
                                    <select class="form-control" name="shipment_status" id="shipment_status">
                                        <option value="" hidden>Seleccionar</option>
                                        <option value="0">En espera</option>
                                        <option value="1">Entregado</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Pago</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="" hidden>Seleccionar</option>
                                        <option value="0">Por pagar</option>
                                        <option value="1">Pagado</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button id="form-delivery-button" type="button" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.container-fluid -->


    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Bootstrap 4 -->
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
    <!-- Page specific script -->
    {{-- Toast --}}
    <script src="{{ asset('admin/plugins/toastr/toastr.min.js') }}"></script>
    <script>
        const session_message = "{{ session('success') }}";
        if (session_message) {
            toastr.success(session_message)
        }
        const session_failure = "{{ session('failure') }}";
        if (session_failure) {
            toastr.error(session_failure)
        }
    </script>
    <script src="{{ asset('admin/plugins/fullcalendar/main.js') }}"></script>
    <script>
        let form = document.querySelector('form[id="form-delivery"]');
        let submit_button = document.querySelector('button[id="form-delivery-button"]');
        let order_id = document.querySelector('input[id="order_id"]');
        let shipment_status = document.querySelector('select[id="shipment_status"]');
        let status = document.querySelector('select[id="status"]');
        let orders_data = {!! json_encode($orders, JSON_HEX_TAG) !!};
        let calendar_data = orders_data.map(item => {
            return {
                title: `N° ${item.code}`,
                start: new Date(item.shipment_date),
                backgroundColor: item.color, //red
                borderColor: item.color, //red
                allDay: true,
                id: item.id
            }
        })
        var Calendar = FullCalendar.Calendar;
        var calendarEl = document.getElementById('calendar');
        var calendar = new Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            themeSystem: 'bootstrap',
            //Random default events
            events: calendar_data,
            /* editable: true,
            droppable: true, */ // this allows things to be dropped onto the calendar !!!
            drop: function(info) {
                // is the "remove after drop" checkbox checked?
                if (checkbox.checked) {
                    // if so, remove the element from the "Draggable Events" list
                    info.draggedEl.parentNode.removeChild(info.draggedEl);
                }
            },
            eventClick: function(info) {
                console.log(info.event._def.publicId);
                let order_item = orders_data.find((item) => {
                    return item.id == info.event._def.publicId;
                });
                order_id.value = order_item.id;
                shipment_status.querySelectorAll('option').forEach(option => {
                    if (option.value == order_item.shipment_status) {
                        option.selected = true;
                    }
                });
                status.querySelectorAll('option').forEach(option => {
                    if (option.value == order_item.status) {
                        option.selected = true;
                    }
                });
                $('#modal').modal('show');
            }

        });
        calendar.render();
        submit_button.addEventListener('click', async () => {
            submit_button.disabled = true;
            const url = `${window.location.origin}/api/delivery-update`;
            const response = await fetch(url, {
                method: "POST",
                cache: "no-cache",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    id: order_id.value,
                    shipment_status: shipment_status.value,
                    status: status.value,
                }),
            });
            if (response.status === 400) {
                const {
                    message
                } = await response.json();
                submit_button.disabled = false;
                toastr.error(message)
            } else {
                const {
                    data,
                    message
                } = await response.json();
                submit_button.disabled = false;
                toastr.success(message)
                window.location.reload(false);
            }
        });
    </script>
@endsection
