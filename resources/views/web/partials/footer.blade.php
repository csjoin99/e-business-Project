<div class="ex4">
    <div class="container">
        <footer class="py-5">
            <div class="row">
                <div class="col-sm-4">
                    <h5 class="text-color-brand">Sobre Nosotros</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="{{route('home')}}" class="nav-link p-0 text-muted">Home</a>
                        </li>
                        <li class="nav-item mb-2"><a href="{{route('store')}}" class="nav-link p-0 text-muted">Productos</a></li>
                        {{-- <li class="nav-item mb-2"><a role="button" class="nav-link p-0 text-muted">Preguntas
                                Frecuentes</a></li> --}}
                    </ul>
                </div>

                <div class="col-sm-4">
                    <h5 class="text-color-brand">Medios de pago</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item ">
                            <a href="#" class="nav-link p-0 text-muted">
                                <i class="fa fa-cc-stripe" style="font-size: 1.5rem; color: black"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-4">
                    <h5 class="text-color-brand">Síguenos</h5>
                    <ul class="nav">
                        @if ($settings->facebook)
                            <li class="nav-item ">
                                <a href="{{$settings->facebook}}" target="_blank">
                                    <img class="credit" src="{{ asset('assets/icons/facebook.svg') }}">
                                </a>
                            </li>
                        @endif
                        @if ($settings->whatsapp)
                            <li class="nav-item ">
                                <a href="https://api.whatsapp.com/send?phone={{$settings->whatsapp}}" target="_blank">
                                    <img class="credit" src="{{ asset('assets/icons/whatsapp.svg') }}">
                                </a>
                            </li>
                        @endif
                        @if ($settings->instagram)
                            <li class="nav-item ">
                                <a href="{{$settings->instagram}}" target="_blank">
                                    <img class="credit" src="{{ asset('assets/icons/instagram.svg') }}">
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            {{-- <div class="d-flex justify-content-between py-4 my-4 border-top">
                <p>© 2021 Company, Inc. All rights reserved.</p>
            </div> --}}
        </footer>
    </div>
</div>
