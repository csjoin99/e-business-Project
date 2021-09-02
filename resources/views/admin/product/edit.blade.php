@extends('admin.layout.app')
@section('title', 'Editar categoría')
@section('content')
<!-- VENTANAS Proytectos-->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar producto</h1>
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
                        <form id="form" action="{{ route('product.update',$product) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name"
                                        name="name" placeholder="Ingresar nombre" maxlength="100"
                                        value="{{$product->name}}" required>
                                    @error('name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Categoría</label>
                                    <select
                                        class="form-control select-category {{ $errors->has('category_id') ? 'is-invalid' : '' }}"
                                        name="category_id" id="category_id" required>
                                        <option></option>
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}" {{$product->category_id == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="price">Precio</label>
                                    <input type="number"
                                        class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" id="price"
                                        name="price" placeholder="Ingresar el precio" min="1" value="{{$product->price}}" required>
                                    @error('price')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                    {{-- @if ($errors->has('price'))
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @endif --}}
                                </div>
                                <div class="form-group">
                                    <label for="discount">Descuento % (Opcional)</label>
                                    <input type="number"
                                        class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}"
                                        id="discount" name="discount" placeholder="Ingresar descuento" min="1"
                                        max="100" value="{{$product->discount}}">
                                    @error('discount')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                    {{-- @if ($errors->has('discount'))
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @endif --}}
                                </div>
                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <input type="number"
                                        class="form-control {{ $errors->has('stock') ? 'is-invalid' : '' }}" id="stock"
                                        name="stock" placeholder="Ingresar el stock" min="0" value="{{$product->stock}}" noDecimal="1" required>
                                    @error('stock')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Descripción</label>
                                    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                        name="description" id="description" cols="30" rows="10" required>{{$product->description}}</textarea>
                                    @error('description')
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
@endsection