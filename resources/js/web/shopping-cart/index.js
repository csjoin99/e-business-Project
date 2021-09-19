window.Vue = require("vue/dist/vue.js");

const vm = new Vue({
    el: "#shopping-cart-section",
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
        async cart_update_qty(item) {
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
                console.log("error");
            } else {
                let { data, total_items, order } = await response.json();
                Object.assign(item, data);
                this.update_cart_qty(total_items);
                this.order = order;
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
                console.log("error");
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
        async get_coupon() {
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
                if(resp.order){
                    this.order = resp.order;
                }
                console.log(resp.message);
            } else {
                let { coupon, order } = await response.json();
                this.coupon = coupon;
                this.order = order;
                console.log(this.coupon);
            }
        },
    },
    async created() {
        const { cart, coupon, order } = await this.get_cart_content();
        this.cart = cart;
        Object.assign(this.coupon, coupon);
        Object.assign(this.order, order);
        console.log(this.cart, this.coupon, this.order);
    },
});
