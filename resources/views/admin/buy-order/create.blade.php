@extends('admin.layout.app')
@section('title', 'Registrar orden de compra')
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
                        <h1>Registrar orden de compra</h1>
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
                                        <div class="col-5 form-group">
                                            <label for="provider_name">Razón social</label>
                                            <input type="text" id="provider_name" name="provider_name"
                                                class="form-control" v-model="provider.name" required readonly>
                                        </div>
                                        <div class="col-5 form-group">
                                            <label for="ruc">RUC</label>
                                            <input type="text" class="form-control" id="ruc" name="ruc"
                                                v-model="provider.ruc" required readonly>
                                            <small class="form-text text-danger"></small>
                                        </div>
                                        <div class="col-2 d-flex">
                                            <button type="button" class="btn btn-success my-auto" data-toggle="modal"
                                                data-target="#modal-provider">Buscar proveedor</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5 form-group">
                                            <label for="num_doc">Número de comprobante</label>
                                            <input type="text" id="num_doc" name="num_doc"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12 d-flex">
                                            <button type="button" class="btn btn-success my-auto" data-toggle="modal"
                                                data-target="#modal-product">Buscar productos</button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Productos</label>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Producto</th>
                                                    <th style="width: 8rem">Cantidad</th>
                                                    <th>Precio</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr id="table-no-products" v-if="!product_list.length">
                                                    <td class="text-center" colspan="5">No hay productos</td>
                                                </tr>
                                                <tr id="product_list" class="d-none"
                                                    v-for="product_item in product_list">
                                                    <td><button class="btn btn-danger" type="button"
                                                            v-on:click.prevent="delete_product(product_item)"><i
                                                                class="fas fa-times"></i></button></td>
                                                    <td v-text="product_item.name"></td>
                                                    <td><input type="number" name="item_qty" class="form-control "
                                                            v-model="product_item.qty" v-on:keyup.prevent="update_product">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="item_price" class="form-control "
                                                            v-model="product_item.real_price" v-on:keyup.prevent="update_product">
                                                    </td>
                                                    <td v-text="`S/. ${product_item.total}`"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" class="text-right">Subtotal</td>
                                                    <td id="table-subtotal">S/. <span v-text="subtotal">0.00</span></td>
                                                </tr>
                                                {{-- <tr>
                                                    <td colspan="4" class="text-right">Descuento <span
                                                            v-text="coupon.discount_value"></span></td>
                                                    <td id="table-discount"
                                                        v-text="discount > 0 ? `- S/. ${discount}` : `S/. ${discount}`">S/.
                                                        0.00</td>
                                                </tr> --}}
                                                <tr>
                                                    <td colspan="4" class="text-right">Total</td>
                                                    <td id="table-total">S/. <span v-text="total">0.00</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary"
                                        :disabled="submit_loading">Registrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
            {{-- Modal --}}
            <div class="modal fade" id="modal-product">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Lista de productos</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body for">
                            <div class="row form-group">
                                <input type="text" class="form-control col-lg-3" placeholder="Buscar..." id="search"
                                    name="search" v-on:keyup.prevent="list_products()">
                            </div>
                            <div class="row" style="overflow: auto; max-height: 500px;">
                                <table class="table" style="overflow: auto; height: 100px;">
                                    <thead style="position: sticky; top: -1px; background: white;">
                                        <tr>
                                            <th></th>
                                            <th>Producto</th>
                                            <th>Categoría</th>
                                            <th>Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if="!search_list.length">
                                            <td class="text-center" colspan="4">No hay productos</td>
                                        </tr>
                                        <tr v-for="item in search_list">
                                            <td><button type="button" class="btn btn-success"
                                                    v-on:click.prevent="add_product(item)"><i
                                                        class="fas fa-plus"></i></button></td>
                                            <td v-text="item.name"></td>
                                            <td v-text="item.category.name"></td>
                                            <td v-text="item.stock"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <div class="modal fade" id="modal-provider">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Lista de proveedores</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body for">
                            <div class="row form-group">
                                <input type="text" class="form-control col-lg-3" placeholder="Buscar..."
                                    id="search-providers" name="search" v-on:keyup.prevent="list_providers()">
                            </div>
                            <div class="row" style="overflow: auto; max-height: 500px;">
                                <table class="table" style="overflow: auto; height: 100px;">
                                    <thead style="position: sticky; top: -1px; background: white;">
                                        <tr>
                                            <th></th>
                                            <th>Razón social</th>
                                            <th>RUC</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if="!provider_list.length">
                                            <td class="text-center" colspan="3">No hay proveedores</td>
                                        </tr>
                                        <tr v-for="item in provider_list">
                                            <td><button type="button" class="btn btn-success"
                                                    v-on:click.prevent="set_provider(item)"><i
                                                        class="fas fa-plus"></i></button></td>
                                            <td v-text="item.name"></td>
                                            <td v-text="item.ruc"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
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
    <script>
        $('#date').daterangepicker();
    </script>
    <script src="{{ asset('admin/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('js/admin/buy-order/index.js') }}"></script>
    <script src="{{ asset('js/form-validation.js') }}"></script>
    <script>
        $('.select-category').select2({
            placeholder: "Ingrese al cliente",
            theme: 'bootstrap4',
            tags: true,
            width: '100%',
        });
    </script>
@endsection
