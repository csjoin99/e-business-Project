<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="#!">{{$settings->name}}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{route('store')}}">Tienda</a></li>
            </ul>
            <form class="d-flex">
                <a class="btn btn-outline-dark" href="{{route('shopping.cart')}}">
                    <i class="bi-cart-fill me-1"></i>
                    Cart
                    <span id="cart-count" class="badge bg-dark text-white ms-1 rounded-pill">{{Cart::count()}}</span>
                </a>
            </form>
        </div>
    </div>
</nav>