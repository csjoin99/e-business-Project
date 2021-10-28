<div class="offcanvas offcanvas-end" tabindex="-1" id="cesta" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Mi cesta</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="items">
            @forelse (Cart::content() as $item)
                <div class="row mb-2">
                    <div class="col-4">
                        <img class="w-100" src="{{ $item->options['image'] }}">
                    </div>
                    <div class="col-8">
                        <a role="button">{{ $item->name }}</a>
                        <p class="text-color-brand" style="color:orange">S/. {{ number_format($item->price, 2) }}</p>
                        <input type="number" value="{{ $item->qty }}" style="max-width: 100px" readonly>
                    </div>
                </div>
            @empty
                <h3>No hay articulos</h3>
            @endforelse
        </div>
        <div class="subtotal">
            <div class="d-flex justify-content-between">
                <p>Subtotal</p>
                <p>S/. {{ Cart::subtotal() }}</p>
            </div>
        </div>
        <div class="botones">
            <div class="d-flex justify-content-between">
                <button class="btn btn-dark" data-bs-dismiss="offcanvas" type="button">Continue la Compra</button>
                <a href="{{ route('shopping.cart') }}" class="btn btn-outline-dark" type="button">Mirar Carrito</a>
            </div>
        </div>
    </div>
</div>
