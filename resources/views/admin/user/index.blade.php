@extends('admin.layout.app')
@section('title', 'Lista de usuarios')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lista de usuarios</h1>
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
                                    <a href="{{ route('user.create') }}" class="btn btn-outline-success"
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
                                        <th>Nombre</th>
                                        <th>Avatar</th>
                                        <th>Email</th>
                                        <th>Rol</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }} {{ $user->lastname }}</td>
                                        <td>
                                            <img style="max-width: 80px"
                                                src="{{ $user->avatar ? $user->avatar : 'https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?f=y' }}"
                                                alt="">
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->roles->count() ? $user->roles->first()->name : '' }}</td>
                                        <td>
                                            @if ($user->deleted_at)
                                            <span class="badge badge-danger">Inactivo</span>
                                            @else
                                            <span class="badge badge-success">Activo</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex flex-nowrap">
                                                @if ($user->deleted_at)
                                                <form action="{{route('user.restore',$user)}}" method="POST">
                                                    @csrf
                                                    <a role="button" class="btn btn-info" name="undo-button"><i
                                                            class="fas fa-undo"></i></a>
                                                </form>
                                                @else
                                                <a href="{{route('user.edit',$user)}}" class="btn btn-primary mr-1"><i
                                                        class="fas fa-pen"></i></a>
                                                <form action="{{route('user.destroy',$user)}}" method="POST">
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
                                        <td valign="top" colspan="6" class="dataTables_empty text-center">No hay
                                            registros
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $users->onEachSide(1)->appends(request()->except(['page']))->links('admin.partials.pagination') }}
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