@extends('admin.layout.app')
@section('title', 'Kardex')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}">
@endsection
@section('content')
    <!-- VENTANAS Proytectos-->
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Kardex</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content" id="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <!-- form start -->
                            <form id="form" method="POST" enctype="multipart/form-data" v-on:submit.prevent="submit">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 form-group">
                                            <label for="customer">Productos</label>
                                            <select class="form-control select-category" name="product" id="product"
                                                required>
                                                <option></option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">
                                                        {{ $product->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('customer')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-6 form-group">
                                            <label for="date">Rango de fecha:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control float-right" id="date" name="date"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-success" :disabled="submit_loading" v-on:click="check_kardex()">Consultar</button>
                                    </div>
                                    <div class="form-group">
                                        <label>Kardex</label>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Fecha</th>
                                                    {{-- <th>Producto</th> --}}
                                                    <th colspan="3" class="text-center">Entradas</th>
                                                    <th colspan="3" class="text-center">Salida</th>
                                                    <th colspan="3" class="text-center">Total</th>
                                                </tr>
                                                <tr>
                                                    <th>Fecha</th>
                                                    {{-- <th>Producto</th> --}}
                                                    <th>Cantidad</th>
                                                    <th>Valor unitario</th>
                                                    <th>Valor total</th>
                                                    <th>Cantidad</th>
                                                    <th>Valor unitario</th>
                                                    <th>Valor total</th>
                                                    <th>Cantidad</th>
                                                    <th>Valor unitario</th>
                                                    <th>Valor total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-if="kardex_list.length" v-for="item in kardex_list">
                                                    <td v-text="item.date"></td>
                                                    <td>
                                                        <span v-text="item.type=='compra' ? item.quantity : ''"></span>
                                                    </td>
                                                    <td>
                                                        <span v-text="item.type=='compra' ? `S/. ${item.unit_price}` : ''"></span>
                                                    </td>
                                                    <td>
                                                        <span v-text="item.type=='compra' ? `S/. ${item.total}` : ''"></span>
                                                    </td>
                                                    <td>
                                                        <span v-text="item.type=='orden' ? item.quantity : ''"></span>
                                                    </td>
                                                    <td>
                                                        <span v-text="item.type=='orden' ? (item.unit_price ? `S/. ${item.unit_price_format}` : `S/. 0.00`) : ''"></span>
                                                    </td>
                                                    <td>
                                                        <span v-text="item.type=='orden' ? (item.total ? `S/. ${item.total_format}` : `S/. 0.00`) : ''"></span>
                                                    </td>
                                                    <td>
                                                        <span v-text="item.end_stock"></span>
                                                    </td>
                                                    <td>
                                                        <span v-text="`S/. ${item.current_price_format}`"></span>
                                                    </td>
                                                    <td>
                                                        <span v-text="`S/. ${item.new_total}`"></span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>

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
    <!-- Page specific script -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- the main fileinput plugin script JS file -->
    <script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('admin/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('js/admin/kardex/index.js') }}"></script>
    <script src="{{ asset('js/form-validation.js') }}"></script>
    <script>
        $('.select-category').select2({
            placeholder: "Seleccione un producto",
            theme: 'bootstrap4',
            tags: true,
            width: '100%',
        });
    </script>
    <script>
        $('#date').daterangepicker({
            locale: {
                format: 'DD/MM/YYYY'
            }
        });
    </script>
@endsection
