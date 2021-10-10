@extends('admin.layout.app')
@section('title', 'Detalle de orden de compra')
@section('content')
    <!-- VENTANAS Proytectos-->
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Detalle de orden de compra</h1>
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
                            <div id="form">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="provider_name">Razón social</label>
                                        <input type="text" class="form-control" id="provider_name" name="provider_name"
                                            placeholder="Razón social" value="{{ $buy_order->provider->name }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="ruc">RUC</label>
                                        <input type="text" class="form-control" id="ruc" name="ruc" placeholder="RUC"
                                            value="{{ $buy_order->provider->ruc }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="num_doc">Nro de comprobante</label>
                                        <input type="text" class="form-control" id="num_doc" name="num_doc"
                                            placeholder="Nro de comprobante" value="{{ $buy_order->num_doc }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Productos</label>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Producto</th>
                                                    <th style="width: 8rem">Cantidad</th>
                                                    <th>Precio</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($buy_order->product as $product)
                                                    <tr>
                                                        <td>
                                                            {{ $product->name }}
                                                        </td>
                                                        <td>
                                                            {{ $product->pivot->quantity }}
                                                        </td>
                                                        <td>
                                                            S/. {{ $product->pivot->total }}
                                                        </td>
                                                        <td>
                                                            S/. {{ number_format((float) $product->pivot->quantity * (float) $product->pivot->total, 2, '.', '') }}
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="text-center" colspan="4">No hay productos</td>
                                                    </tr>
                                                @endforelse
                                                <tr>
                                                    <td colspan="3" class="text-right">Subtotal</td>
                                                    <td id="table-subtotal">S/. <span>{{ $buy_order->subtotal }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="text-right">Total</td>
                                                    <td id="table-total">S/. <span>{{ $buy_order->total }}</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
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
    <!-- Page specific script -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
