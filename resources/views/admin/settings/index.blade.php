@extends('admin.layout.app')
@section('title', 'Configuración')
@section('css')
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/css/fileinput.min.css" media="all"
    rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css"
    crossorigin="anonymous">
@endsection
@section('content')
<!-- VENTANAS Proytectos-->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Configuración</h1>
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
                        <form id="form" action="{{route('settings.update',$settings)}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name"
                                        name="name" placeholder="Ingresar nombre de empresa" value="{{$settings->name}}"
                                        maxlength="255" required>
                                    @error('name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email"
                                        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email"
                                        name="email" placeholder="Ingresar correo" value="{{$settings->email}}"
                                        maxlength="255" required>
                                    @error('email')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="address">Dirección</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                        id="address" name="address" placeholder="Ingresar dirección"
                                        value="{{$settings->address}}" maxlength="255" required>
                                    @error('address')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone">Teléfono</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" id="phone"
                                        name="phone" placeholder="Ingresar teléfono" value="{{$settings->phone}}"
                                        maxlength="12" required>
                                    @error('phone')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="facebook">Facebook</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}"
                                        id="facebook" name="facebook" value="{{$settings->facebook}}"
                                        placeholder="Ingresar facebook (opcional)" maxlength="255">
                                    @error('facebook')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="instagram">Instagram</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('instagram') ? 'is-invalid' : '' }}"
                                        id="instagram" name="instagram" value="{{$settings->instagram}}"
                                        placeholder="Ingresar instagram (opcional)" maxlength="255">
                                    @error('instagram')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="twitter">Twitter</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('twitter') ? 'is-invalid' : '' }}"
                                        id="twitter" name="twitter" value="{{$settings->twitter}}"
                                        placeholder="Ingresar twitter (opcional)" maxlength="255">
                                    @error('twitter')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                {{-- <div class="form-group">
                                    <label for="logo">Logo</label>
                                    <input id="logo" name="logo" type="file" class="file"
                                        data-browse-on-zone-click="true" accept="image/png, image/gif, image/jpeg"
                                        @if ($settings->logo)
                                        data-initial-preview='<img src="{{$settings->logo}}"
                                            class="file-preview-image kv-preview-data"
                                            style="width: auto; height: auto; max-width: 100%; max-height: 100%; image-orientation: from-image;">'
                                        accept="image/png, image/gif, image/jpeg"
                                        @endif
                                        >
                                    @error('logo')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div> --}}
                                <div class="form-group">
                                    <label for="color">Color</label>
                                    <input type="color"
                                        class="form-control {{ $errors->has('color') ? 'is-invalid' : '' }}"
                                        id="color" name="color" value="{{$settings->color}}"
                                        placeholder="Ingresar color" maxlength="255">
                                    @error('color')
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
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/fileinput.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/locales/LANG.js"></script>
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