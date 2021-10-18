<nav class="navbar navbar-expand-lg navbar-light border">
    <div class=" container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">
            <!--Insertar un svg  -->
            {{ $settings->name }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item active">
                    <a class="nav-link active" href="{{ route('home') }}">Inicio</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link active" href="{{ route('store') }}">Tienda</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link dropdown-toggle active" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Categorías
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($global_product_categories as $category)
                            <a class="dropdown-item" href="{{ route('store', ['categoria' => $category->slug]) }}">
                                <p>{{ $category->name }}</p>
                            </a>
                        @endforeach
                    </div>
                </li>
            </ul>
            <div class="btn-group" role="group" aria-label="Basic outlined example">
                <div class="nav-item navbar-icon-link" data-bs-toggle="search">
                    <a role="button" id="navSearch1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('assets/icons/search.svg') }}">
                    </a>
                    <div style="width: 20rem" class="dropdown-menu dropdown-menu-end shadow rounded p-2"
                        aria-labelledby="navSearch1" data-bs-popper="none">
                        <form class="input-group">
                            <input class="form-control border-light" type="search" placeholder="Buscar Produto"
                                aria-label="Search">
                            <button class="btn btn-light m-0" type="submit">Search</button>
                        </form>
                    </div>
                </div>

                <div class="nav-item navbar-icon-link" data-bs-toggle="user">
                    <a role="button">
                        <img src="{{ asset('assets/icons/person.svg') }}">
                    </a>
                </div>
                <div class="nav-item navbar-icon-link" data-bs-toggle="cart">
                    <a role="button" data-bs-toggle="offcanvas" data-bs-target="#cesta" aria-controls="offcanvasRight">
                        <img src="{{ asset('assets/icons/cart.svg') }}">
                        <span class="position-absolute translate-middle badge rounded-pill bg-success">
                            0
                            <span class="visually-hidden">productos</span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
