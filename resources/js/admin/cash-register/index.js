window.Vue = require("vue/dist/vue.js");

const vm = new Vue({
    el: "#content",
    data: {
        loading: true,
        subtotal: (0).toFixed(2),
        discount: (0.0).toFixed(2),
        total: (0.0).toFixed(2),
        coupon: {
            code: "",
            discount: 0,
            discount_value: "",
            type: "",
        },
        product: {
            id: "",
            name: "",
            price: "",
            real_price: "",
            qty: "",
            stock: "",
            total: "",
        },
        product_list: [],
        search_list: [],
        submit_loading: false,
    },
    computed: {},
    methods: {
        async get_coupon() {
            const ulr = `${window.location.origin}/api/get-coupon-data`;
            const coupon_input = document.querySelector('input[id="coupon"]');
            if (coupon_input.value !== "") {
                const response = await fetch(ulr, {
                    method: "POST",
                    cache: "no-cache",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        code: coupon_input.value,
                    }),
                });
                if (response.status === 400) {
                    const { error } = await response.json();
                    coupon_input.classList.add("border-danger");
                    coupon_input.nextSibling.nextSibling.textContent = error;
                    this.coupon = {
                        code: "",
                        discount: (0.0).toFixed(2),
                        discount_value: "",
                        type: "",
                    };
                } else {
                    const { coupon } = await response.json();
                    this.coupon = coupon;
                    coupon_input.classList.remove("border-danger");
                    coupon_input.nextSibling.nextSibling.textContent = "";
                }
            } else {
                this.coupon = {
                    code: "",
                    discount: (0.0).toFixed(2),
                    discount_value: "",
                    type: "",
                };
                coupon_input.classList.remove("border-danger");
                coupon_input.nextSibling.nextSibling.textContent = "";
            }
            this.calculate_price();
        },
        async add_product(product) {
            if (
                this.product_list.some((item) => {
                    return item.id === product.id;
                })
            )
                return;
            this.product = {
                id: product.id,
                name: product.name,
                price: product.price,
                real_price: product.real_price,
                qty: 1,
                stock: product.temp_stock,
                total: (1 * product.real_price).toFixed(2),
            };
            this.product_list.push(this.product);
            this.search_list = this.search_list.filter((item) => {
                return item.id !== product.id;
            });
            this.calculate_price();
        },
        async update_product(e) {
            const input = e.target;
            const qty = parseFloat(input.value);
            const url = `${window.location.origin}/api/find-product-by-id`;
            const response = await fetch(url, {
                method: "POST",
                cache: "no-cache",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    id: this.product.id,
                }),
            });
            if (response.status !== 400) {
                const { product } = await response.json();
                if (
                    qty <= 0 ||
                    qty > parseFloat(product.stock) ||
                    qty % 1 != 0
                ) {
                    input.classList.add("border-danger");
                    return;
                } else {
                    input.classList.remove("border-danger");
                    this.product_list = this.product_list.map((item) => {
                        item.total = (item.real_price * item.qty).toFixed(2);
                        return item;
                    });
                    this.calculate_price();
                }
            }
        },
        delete_product(product) {
            this.product_list = this.product_list.filter((item) => {
                return item.id !== product.id;
            });
            this.list_products();
            this.calculate_price();
        },
        async list_products() {
            const url = `${window.location.origin}/api/search-products`;
            const search = document.querySelector('input[id="search"]').value;
            const response = await fetch(url, {
                method: "POST",
                cache: "no-cache",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    search,
                    product_list: this.product_list,
                }),
            });
            if (response.status !== 400) {
                const { products } = await response.json();
                this.search_list = products;
            }
        },
        calculate_price() {
            let total = 0;
            this.product_list.forEach((prod) => {
                total += parseFloat(prod.total);
            });
            this.subtotal = total.toFixed(2);
            if (this.coupon.code) {
                if (this.coupon.type === "Porcentaje") {
                    this.discount = (
                        (this.subtotal * this.coupon.discount) /
                        100
                    ).toFixed(2);
                } else {
                    this.discount =
                        parseFloat(this.subtotal) <=
                        parseFloat(this.coupon.discount)
                            ? this.subtotal
                            : this.coupon.discount;
                    this.discount = parseFloat(this.discount).toFixed(2);
                }
            }
            this.total = (this.subtotal - this.discount).toFixed(2);
        },
        async submit() {
            try {
                this.submit_loading = true;
                if (!this.product_list.length) throw "Debe agregar productos";
                if (
                    this.product_list.some((item) => {
                        return (
                            parseFloat(item.qty) <= 0 ||
                            parseFloat(item.qty) > parseFloat(item.stock) ||
                            parseFloat(item.qty) % 1 != 0
                        );
                    })
                )
                    throw "La cantidad de un producto no es correcto";

                if (!document.getElementById("customer").value)
                    throw "Falta seleccionar al cliente";
                const url = `${window.location.origin}/api/store-cash-register`;
                const formData = new FormData(
                    document.querySelector('form[id="form"]')
                );
                formData.append(
                    "product_list",
                    JSON.stringify(this.product_list)
                );
                formData.append("discount", this.discount);
                formData.append("subtotal", this.subtotal);
                formData.append("total", this.total);
                const response = await fetch(url, {
                    method: "POST",
                    cache: "no-cache",
                    body: formData,
                });
                if (response.status !== 400) {
                    toastr.success("Orden registrada");
                    window.location.href = `${window.location.origin}/admin/order`;
                } else {
                    const { error } = await response.json();
                    throw error;
                }
            } catch (error) {
                toastr.error(error);
                this.submit_loading = false;
            }
        },
    },
    created() {
        this.loading = false;
        if (!this.loading)
            document
                .querySelector('tr[id="product_list"]')
                .classList.remove("d-none");
        this.list_products();
    },
});
