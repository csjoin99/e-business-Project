@extends('admin.layout.app')
@section('title', 'Auditoría')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Auditoría</h1>
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
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Usuario</th>
                                            <th>Correo</th>
                                            <th>Rol</th>
                                            <th>Evento</th>
                                            <th>Módulo</th>
                                            <th>Fecha</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($audit_list as $audit)
                                            <tr>
                                                <td>{{ $audit->user_with_trashed->name }}</td>
                                                <td>{{ $audit->user_with_trashed->email }}</td>
                                                <td>{{ $audit->user_with_trashed->roles->first()->name }}</td>
                                                <td>
                                                    @switch($audit->event)
                                                        @case('created')
                                                            Registro
                                                        @break
                                                        @case('updated')
                                                            Edición
                                                        @break
                                                        @default
                                                            Eliminación
                                                    @endswitch
                                                </td>
                                                <td>{{ $audit->auditable_type::MODULE_NAME }}</td>
                                                <td>{{ Carbon::createFromFormat('Y-m-d H:i:s', $audit->created_at)->format('d-m-Y H:i:s') }}
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-nowrap">
                                                        <a href="{{ route('audit.show', $audit) }}"
                                                            class="btn btn-primary mr-1"><i class="fas fa-eye"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                                <tr class="odd">
                                                    <td valign="top" colspan="6" class="dataTables_empty text-center">No hay
                                                        registros
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    {{ $audit_list->onEachSide(1)->appends(request()->except(['page']))->links('admin.partials.pagination') }}
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
