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

        provider_list: [],
        provider: {
            id: "",
            name: "",
            ruc: "",
        }
    },
    computed: {},
    methods: {
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
                stock: product.stock,
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
            if(input.name === 'item_qty' && (qty <= 0 || qty % 1 != 0)){
                input.classList.add("border-danger");
                return;
            }
            else if (
                input.name === 'item_price' && (qty <= 0)
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
        },
        delete_product(product) {
            this.product_list = this.product_list.filter((item) => {
                return item.id !== product.id;
            });
            this.list_products();
            this.calculate_price();
        },
        async list_products() {
            const url = `${window.location.origin}/api/search-products-buy-order`;
            const search = document.querySelector('input[id="search"]').value;
            const response = await fetch(url, {
                method: "POST",
                cache: "no-cache",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    search,
                }),
            });
            if (response.status !== 400) {
                const { products } = await response.json();
                const list_products = products.map(product => {
                    return {
                        id: product.id,
                        name: product.name,
                        category: product.category,
                        stock: product.stock,
                        real_price: 1,
                    }
                })
                this.search_list = list_products;
                /* this.search_list = products; */
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
                            parseFloat(item.qty) % 1 != 0
                        );
                    })
                )
                    throw "La cantidad de un producto no es correcto";
                if (!document.getElementById("provider_name").value || !document.getElementById("ruc").value)
                    throw "Falta seleccionar al proveedor";
                if (!document.getElementById("num_doc").value)
                    throw "Falta ingresar el nro de comprobante";
                const url = `${window.location.origin}/api/store-buy-order`;
                const formData = new FormData();
                formData.append(
                    "product_list",
                    JSON.stringify(this.product_list)
                );
                /* formData.append("discount", this.discount); */
                formData.append("subtotal", this.subtotal);
                formData.append("total", this.total);
                /* document.querySelector('form[id="form"]') */
                formData.append("num_doc", document.querySelector('form[id="form"]').querySelector('input[id="num_doc"]').value);
                formData.append("provider_id", this.provider.id);
                const response = await fetch(url, {
                    method: "POST",
                    cache: "no-cache",
                    body: formData,
                });
                if (response.status !== 400) {
                    toastr.success("Orden de compra registrada");
                    window.location.href = `${window.location.origin}/admin/buy-order`;
                } else {
                    const { error } = await response.json();
                    throw error;
                }
            } catch (error) {
                toastr.error(error);
                this.submit_loading = false;
            }
        },

        async list_providers() {
            const url = `${window.location.origin}/api/search-providers`;
            const search = document.querySelector('input[id="search-providers"]').value;
            const response = await fetch(url, {
                method: "POST",
                cache: "no-cache",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    search,
                }),
            });
            if (response.status !== 400) {
                const { providers } = await response.json();
                this.provider_list = providers;
            }
        },
        async set_provider(provider) {
            this.provider = provider;
        }
    },
    created() {
        this.loading = false;
        if (!this.loading)
            document
                .querySelector('tr[id="product_list"]')
                .classList.remove("d-none");
        this.list_providers();
        this.list_products();
    },
});

