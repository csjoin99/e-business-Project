<div class="offcanvas offcanvas-end" tabindex="-1" id="cesta" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Mi cesta</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="items">
            <h3 v-if="!this.cart.length">No hay articulos</h3>
            <div v-else v-for="item in this.cart" class="row mb-2">
                <div class="col-4">
                    <img class="w-100" :src="item.options.image">
                </div>
                <div class="col-8">
                    <a role="button" v-text="item.name"></a>
                    <p style="color:orange" v-text="`S/. ${parseFloat(item.subtotal).toFixed(2)}`"></p>
                    <input type="number" value="1" maxlength="5px" v-model="item.qty" v-on:change="cart_update_qty($event, item)">
                    <button v-on:click="cart_delete_item(item)" type="button" class="btn-close position-relative"
                        aria-label="Close"></button>
                </div>
            </div>

        </div>
        <div class="subtotal">
            <div class="d-flex justify-content-between">
                <p>Subtotal</p>
                <p v-text="`S/. ${this.order.subtotal}`"></p>
            </div>
        </div>
        <div class="botones">
            <div class="d-flex justify-content-between">
                <button class="btn btn-dark" data-bs-dismiss="offcanvas" type="button">Continue la Compra</button>
                <a href="{{route('shopping.cart')}}" class="btn btn-outline-dark" type="button">Mirar Carrito</a>
            </div>
        </div>
    </div>
</div>
