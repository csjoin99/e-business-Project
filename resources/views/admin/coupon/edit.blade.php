@extends('admin.layout.app')
@section('title', 'Editar cupón')
@section('css')
<link rel="stylesheet" href="{{asset('admin/plugins/daterangepicker/daterangepicker.css')}}">
@endsection
@section('content')
<!-- VENTANAS Proytectos-->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar cupón</h1>
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
                        <form id="form" action="{{ route('coupon.update',$coupon) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="code">Código</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" id="code"
                                        name="code" placeholder="Ingresar código" maxlength="50"
                                        value="{{$coupon->code}}" required>
                                    @error('code')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="discount">Descuento</label>
                                    <input type="number"
                                        class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}"
                                        id="discount" name="discount" placeholder="Ingresar descuento" min="0"
                                        value="{{$coupon->discount}}" required>
                                    @error('discount')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="type">Tipo</label>
                                    <select
                                        class="form-control select-category {{ $errors->has('type') ? 'is-invalid' : '' }}"
                                        name="type" id="type" required>
                                        <option></option>
                                        <option {{$coupon->type === 'Fijo' ? 'selected' : ''}} value="Fijo">Fijo
                                        </option>
                                        <option {{$coupon->type === 'Porcentaje' ? 'selected' : ''}} value="Porcentaje">
                                            Porcentaje</option>
                                    </select>
                                    @error('type')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="date">Fecha inicio - Fecha fin:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text"
                                            class="form-control float-right {{ $errors->has('date') ? 'is-invalid' : '' }}"
                                            id="date" name="date" readonly>
                                    </div>
                                    @error('date')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <input type="number"
                                        class="form-control {{ $errors->has('stock') ? 'is-invalid' : '' }}" id="stock"
                                        name="stock" placeholder="Ingresar stock" min="0" value="{{$coupon->stock}}" noDecimal="1"
                                        required>
                                    @error('stock')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Guardar</button>
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
<script>
    $('.select-category').select2({
        placeholder: "Seleccione una categoría",
        theme: 'bootstrap4'
    });

</script>
<!-- the main fileinput plugin script JS file -->
<script src="{{asset('admin/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script>
    console.log("{{Carbon::createFromFormat('Y-m-d', $coupon->date_start)->format('m-d-Y')}}");
    $('#date').daterangepicker({
        startDate: "{{Carbon::createFromFormat('Y-m-d', $coupon->date_start)->format('m-d-Y')}}",
        endDate: "{{Carbon::createFromFormat('Y-m-d', $coupon->date_end)->format('m-d-Y')}}",
    });
</script>

@endsection