@extends('admin.layout.app')
@section('title', 'Lista de ordenes')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lista de ordenes</h1>
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
                                    {{-- <a href="{{ route('coupon.create') }}" class="btn btn-outline-success"
                                    style="width: fit-content">Registrar</a> --}}
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
                                        <th>Cliente</th>
                                        <th>Fecha</th>
                                        <th>Distrito</th>
                                        <th>Fecha de envío</th>
                                        <th>Estado de envío</th>
                                        <th>Precio de envío</th>
                                        <th>Descuento</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                    <tr>
                                        <td>{{ $order->code }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->district }}</td>
                                        <td>{{ $order->shipment_date }}</td>
                                        <td>{{ $order->shipment_status }}</td>
                                        <td>{{ $order->shipment_price }}</td>
                                        <td>{{ $order->discount }}</td>
                                        <td>{{ $order->total }}</td>
                                        <td>{{ $order->status }}</td>
                                        {{-- <td>
                                            @if ($coupon->status === 'Activo')
                                            <span class="badge badge-success">{{$coupon->status}}</span>
                                        @else
                                        <span class="badge badge-danger">{{$coupon->status}}</span>
                                        @endif
                                        </td> --}}
                                        <td>
                                            <div class="d-flex flex-nowrap">
                                                {{-- <a href="{{route('coupon.edit',$coupon)}}"
                                                class="btn btn-primary mr-1"><i class="fas fa-pen"></i></a>
                                                <form action="{{route('coupon.destroy',$coupon)}}" method="POST">
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
                                        <td valign="top" colspan="11" class="dataTables_empty text-center">No hay
                                            registros
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $orders->onEachSide(1)->appends(request()->except(['page']))->links('admin.partials.pagination') }}
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