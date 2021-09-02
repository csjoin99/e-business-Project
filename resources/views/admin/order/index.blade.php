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
                            <table id="example1" class="table table-bordered table-striped nowrap w-100 responsive" data-responsive="true">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Cliente</th>
                                        <th>Fecha de compra</th>
                                        <th>Distrito</th>
                                        <th>Fecha de envío</th>
                                        <th>Estado de envío</th>
                                        <th>Precio de envío</th>
                                        <th>Descuento</th>
                                        <th>Subtotal</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                    <tr>
                                        <td>{{ $order->code }}</td>
                                        <td>{{ $order->user ? "{$order->user->name} {$order->user->lastname}" : $order->client }}
                                        </td>
                                        <td>{{ Carbon::createFromFormat('Y-m-d H:i:s', $order->created_at)->format('d-m-Y') }}
                                        </td>
                                        <td>{{ $order->district ? $order->district : '-' }}</td>
                                        <td>{{ $order->shipment_date }}</td>
                                        <td>
                                            @switch($order->shipment_status)
                                            @case(1)
                                            <span class="badge badge-success">{{ $order->shipment_status_text }}</span>
                                            @break
                                            @case(2)
                                            <span class="badge badge-warning">{{ $order->shipment_status_text }}</span>
                                            @break
                                            @default
                                            <span class="badge badge-danger">{{ $order->shipment_status_text }}</span>
                                            @endswitch
                                        </td>
                                        <td>S/. {{ number_format($order->shipment_price,2) }}</td>
                                        <td>{{ $order->coupon ? "S/. {$order->discount}" : '-' }}</td>
                                        <td>S/. {{ number_format($order->subtotal,2) }}</td>
                                        <td>S/. {{ number_format($order->total,2) }}</td>
                                        <td>
                                            @switch($order->status)
                                            @case(1)
                                            <span class="badge badge-success">{{ $order->status_text }}</span>
                                            @break
                                            @case(2)
                                            <span class="badge badge-warning">{{ $order->status_text }}</span>
                                            @break
                                            @default
                                            <span class="badge badge-danger">{{ $order->status_text }}</span>
                                            @endswitch
                                        </td>
                                        <td>
                                            <div class="d-flex flex-nowrap">
                                                <form action="{{route('order.destroy',$order)}}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <a role="button" class="btn btn-danger" name="cancel-button"><i
                                                            class="fas fa-times"></i></a>
                                                </form>
                                                {{-- <a href="{{route('order.show',$order)}}">Detail</a> --}}
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