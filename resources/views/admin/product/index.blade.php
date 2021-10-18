@extends('admin.layout.app')
@section('title', 'Lista de productos')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lista de productos</h1>
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
                            <div class="row mb-3">
                                <div class="col-6 d-flex flex-column justify-content-center">
                                    <a href="{{ route('product.create') }}" class="btn btn-outline-success"
                                        style="width: fit-content">Registrar</a>
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    <form method="GET" class="row px-2 w-100 d-flex flex-column"
                                        style="max-width: 20rem">
                                        <label for="" style="line-height: 0.5rem">Buscar</label>
                                        <input type="search" class="form-control form-control-m" id="search-input"
                                            name="search" value="{{ request()->search }}">
                                    </form>
                                </div>
                            </div>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Nombre</th>
                                        <th>Categoría</th>
                                        <th>Precio</th>
                                        <th>Descuento</th>
                                        <th>Stock</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                    <tr>
                                        <td>{{ $product->code }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>
                                            @if ($product->discount)
                                            <del>S/.{{$product->price}}</del> S/.{{$product->real_price}}
                                            @else
                                            {{$product->price}}
                                            @endif
                                        </td>
                                        <td>{{ $product->discount ? floatval($product->discount).'%' : '-' }}</td>
                                        <td>Stock: {{ $product->stock }}/Temp stock:{{ $product->temp_stock }}</td>
                                        <td>
                                            <div class="d-flex flex-nowrap">
                                                @if ($product->deleted_at)
                                                <form action="{{route('product.restore',$product)}}" method="POST">
                                                    @csrf
                                                    <a role="button" class="btn btn-info" name="undo-button"><i
                                                            class="fas fa-undo"></i></a>
                                                </form>
                                                @else
                                                <a href="{{route('product.edit',$product)}}"
                                                    class="btn btn-primary mr-1"><i class="fas fa-pen"></i></a>
                                                <a href="{{route('product.photo.index',$product)}}"
                                                    class="btn btn-info mr-1"><i class="fas fa-camera"></i></a>
                                                <form action="{{route('product.destroy',$product)}}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <a role="button" class="btn btn-danger" name="delete-button"><i
                                                            class="fas fa-trash"></i></a>
                                                </form>
                                                @endif
                                                
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="odd">
                                        <td valign="top" colspan="7" class="dataTables_empty text-center">No hay
                                            registros
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $products->onEachSide(1)->appends(request()->except(['page']))->links('admin.partials.pagination') }}
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
<script src="{{ asset('js/confirm-deletion.js') }}"></script>
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
@endsection