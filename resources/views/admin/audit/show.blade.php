@extends('admin.layout.app')
@section('title', 'Detalle de auditoría de ' . $audit->auditable_type::MODULE_NAME)
@section('css')
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/css/fileinput.min.css" media="all"
        rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css"
        crossorigin="anonymous">
@endsection
@section('content')
    <!-- VENTANAS Proytectos-->
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Detalle de auditoría de {{ $audit->auditable_type::MODULE_NAME }}</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <!-- form start -->
                            <form id="form">
                                <div class="card-body">
                                    @if (count($audit->old_values))
                                        <h4>Valores previos</h4>
                                        @foreach ($audit->old_values as $key => $item)
                                            @if (isset($audit->auditable_type::FIELDS[$key]))
                                                @switch($audit->auditable_type::FIELDS[$key]['field'])
                                                    @case('input')
                                                        <div class="form-group">
                                                            <label
                                                                for="name">{{ $audit->auditable_type::FIELDS[$key]['name'] }}:</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $item }}" readonly>
                                                        </div>
                                                    @break
                                                    @case('textarea')
                                                        <div class="form-group">
                                                            <label
                                                                for="name">{{ $audit->auditable_type::FIELDS[$key]['name'] }}:</label>
                                                            <textarea class="form-control" rows="5"
                                                                readonly>{{ $item }}</textarea>
                                                        </div>
                                                    @break
                                                    @case('image')
                                                        <div class="form-group">
                                                            <label
                                                                for="name">{{ $audit->auditable_type::FIELDS[$key]['name'] }}:</label>
                                                            <br>
                                                            <img src="{{ $item ? $item : asset('img/web/no-img.png') }}"
                                                                alt="" style="max-width: 10rem; max-height: 10rem">
                                                        </div>
                                                    @break
                                                    @case('model')
                                                        <div class="form-group">
                                                            <label
                                                                for="name">{{ $audit->auditable_type::FIELDS[$key]['name'] }}:</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $audit->auditable_type::FIELDS[$key]['model']::find($item)->field }}"
                                                                readonly>
                                                        </div>
                                                    @break
                                                    @default
                                                @endswitch

                                            @endif
                                        @endforeach
                                    @endif
                                    @if (count($audit->new_values) && count($audit->old_values))
                                        <hr>
                                    @endif
                                    @if (count($audit->new_values))
                                        <h4>Valores nuevos</h4>
                                        @foreach ($audit->new_values as $key => $item)
                                            @if (isset($audit->auditable_type::FIELDS[$key]))
                                                @switch($audit->auditable_type::FIELDS[$key]['field'])
                                                    @case('input')
                                                        <div class="form-group">
                                                            <label
                                                                for="name">{{ $audit->auditable_type::FIELDS[$key]['name'] }}:</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $item }}" readonly>
                                                        </div>
                                                    @break
                                                    @case('textarea')
                                                        <div class="form-group">
                                                            <label
                                                                for="name">{{ $audit->auditable_type::FIELDS[$key]['name'] }}:</label>
                                                            <textarea class="form-control" rows="5"
                                                                readonly>{{ $item }}</textarea>
                                                        </div>
                                                    @break
                                                    @case('image')
                                                        <div class="form-group">
                                                            <label
                                                                for="name">{{ $audit->auditable_type::FIELDS[$key]['name'] }}:</label>
                                                            <br>
                                                            <img src="{{ $item ? $item : asset('img/web/no-img.png') }}"
                                                                alt="" style="max-width: 10rem; max-height: 10rem">
                                                        </div>
                                                    @break
                                                    @case('model')
                                                        <div class="form-group">
                                                            <label
                                                                for="name">{{ $audit->auditable_type::FIELDS[$key]['name'] }}:</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $audit->auditable_type::FIELDS[$key]['model']::find($item)->field }}"
                                                                readonly>
                                                        </div>
                                                    @break
                                                    @default

                                                @endswitch

                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <!-- /.card-body -->
                            </form>
                        </div>
                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>

    <script src="{{ asset('js/form-validation.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Bootstrap 4 -->
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
@endsection
