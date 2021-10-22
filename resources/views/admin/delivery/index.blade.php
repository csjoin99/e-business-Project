@extends('admin.layout.app')
@section('title', 'Lista de entregas')
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
                        <h1>Entregas</h1>
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
        const message = "{{ session('success') }}";
        if (message) {
            toastr.success(message)
        }
        const failure = "{{ session('failure') }}";
        if (failure) {
            toastr.error(failure)
        }
    </script>
    <script src="{{ asset('admin/plugins/fullcalendar/main.js') }}"></script>
    <script>
        const orders_data = {!! json_encode($orders, JSON_HEX_TAG) !!};

        console.log(orders_data);
        calendar_data = orders_data.map(item => {
            return {
                title: `N° ${item.code}`,
                start: new Date(item.shipment_date),
                backgroundColor: item.color, //red
                borderColor: item.color, //red
                allDay: true
            }
        })
        console.log(calendar_data);
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
                /* alert('Event: ' + info.event.title);
                alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                alert('View: ' + info.view.type); */

                // change the border color just for fun
                /* info.el.style.borderColor = 'red'; */
                alert("HOLA");
            }

        });

        calendar.render();
    </script>
@endsection
