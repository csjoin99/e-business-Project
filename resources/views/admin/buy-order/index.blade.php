@extends('admin.layout.app')
@section('title', 'Lista de ordenes de compra')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lista de ordenes de compra</h1>
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
                                    <a href="{{ route('buy-order.create') }}" class="btn btn-outline-success"
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
                                        <th>N°</th>
                                        <th>Proveedor</th>
                                        <th>Total</th>
                                        <th>Fecha de registro</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($buy_order_list as $buy_order)
                                    <tr>
                                        <td>{{ $buy_order->num_doc }}</td>
                                        <td>{{ $buy_order->provider->name }}</td>
                                        <td>{{ $buy_order->total }}</td>
                                        <td>{{ Carbon::createFromFormat('Y-m-d H:i:s', $buy_order->created_at)->format('m-d-Y') }}</td>
                                        <td>
                                            <div class="d-flex flex-nowrap">
                                                <a href="{{route('buy-order.show',$buy_order)}}"
                                                    class="btn btn-primary mr-1"><i class="fas fa-eye"></i></a>
                                                {{-- <form action="{{route('buy-order.destroy',$buy_order)}}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <a role="button" class="btn btn-danger" name="delete-button"><i
                                                            class="fas fa-trash"></i></a>
                                                </form> --}}
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="odd">
                                        <td valign="top" colspan="8" class="dataTables_empty text-center">No hay
                                            registros
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $buy_order_list->onEachSide(1)->appends(request()->except(['page']))->links('admin.partials.pagination') }}
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