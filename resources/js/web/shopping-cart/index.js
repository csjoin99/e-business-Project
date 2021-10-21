window.Vue = require("vue/dist/vue.js");
import toastr from "toastr";

const vm = new Vue({
    el: "#body",
    data: {
        loading: true,
        cart: [],
        order: {
            subtotal: 0,
            discount: 0,
            total: 0,
        },
        coupon: {
            code: "",
        },
    },
    computed: {},
    methods: {
        async cart_add_item(event) {
            const product_id = event.target.dataset.id;
            const qty = document.querySelector('input[id="add_item_qty"]').value;
            const url = `${window.location.origin}/api/cart-add-item`;
            const response = await fetch(url, {
                method: "POST",
                cache: "no-cache",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    id: product_id,
                    qty: qty,
                }),
            });
            if (response.status === 400) {
                let { message } = await response.json();
                toastr.error(message, "Error");
                input.classList.add("border-danger");
            } else {
                let {cart, total_items, order} = await response.json();
                document.querySelector('#cart-count').textContent = total_items;
                cart = Object.entries(cart).map((item, index) => {
                    return item[1];
                });
                this.cart = cart;
                this.order = order;
            }
            return;
        },
        update_cart_qty(total_items) {
            document.querySelector("#cart-count").textContent = total_items;
        },
        async get_cart_content() {
            const url = `${window.location.origin}/api/get-cart-content`;
            const response = await fetch(url, { method: "POST" });
            if (response.status !== 200) {
                return [];
            } else {
                let { cart, coupon, order } = await response.json();
                cart = Object.entries(cart).map((item, index) => {
                    return item[1];
                });
                return { cart, coupon, order };
            }
        },
        async cart_update_qty(event, item) {
            const input = event.target;
            const url = `${window.location.origin}/api/cart-update-item`;
            const data = {
                id: item.id,
                rowId: item.rowId,
                qty: item.qty,
            };
            const response = await fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data),
            });
            if (response.status !== 200) {
                let { message } = await response.json();
                input.classList.add("border-danger");
                toastr.error(message, "Error");
            } else {
                let { data, total_items, order } = await response.json();
                Object.assign(item, data);
                this.update_cart_qty(total_items);
                this.order = order;
                input.classList.remove("border-danger");
            }
        },
        async cart_delete_item(item) {
            const url = `${window.location.origin}/api/cart-delete-item`;
            const data = {
                rowId: item.rowId,
            };
            const response = await fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data),
            });
            if (response.status !== 200) {
                let { message } = await response.json();
                toastr.error(message, "Error");
            } else {
                let { message, total_items, cart_content, order } =
                    await response.json();
                this.update_cart_qty(total_items);
                this.cart = Object.entries(cart_content).map((item, index) => {
                    return item[1];
                });
                this.order = order;
            }
        },
        async get_coupon(event) {
            const button = event.target.querySelector('button[type="submit"]');
            button.disabled = true;
            const url = `${window.location.origin}/api/cart-get-coupon`;
            const data = {
                code: this.coupon.code,
            };
            const response = await fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data),
            });
            if (response.status !== 200) {
                let resp = await response.json();
                if (resp.order) {
                    this.order = resp.order;
                }
                toastr.error(resp.message, "Error");
            } else {
                let { coupon, order } = await response.json();
                this.coupon = coupon;
                this.order = order;
            }
            button.disabled = false;
        },
        async submit_order(event) {
            const order_has_items = this.cart.length;
            if (order_has_items) {
                location.href = `${window.location.origin}/datos-envio`;
            } else {
                toastr.error(
                    "Su carrito de compras debe tener productos",
                    "Error"
                );
            }
        },
    },
    async created() {
        const { cart, coupon, order } = await this.get_cart_content();
        this.cart = cart;
        Object.assign(this.coupon, coupon);
        Object.assign(this.order, order);
        toastr.options = {
            debug: false,
            positionClass: "toast-top-right",
            onclick: null,
            fadeIn: 300,
            fadeOut: 1000,
            timeOut: 5000,
            extendedTimeOut: 1000,
        };
    },
});
