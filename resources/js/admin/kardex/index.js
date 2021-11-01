window.Vue = require("vue/dist/vue.js");

const vm = new Vue({
    el: "#content",
    data: {
        kardex_list: [],
        kardex_first: null,
        kardex_last: null,
        submit_loading: false,
    },
    computed: {},
    methods: {
        async check_kardex() {
            try {
                this.submit_loading = true;
                const product = document.querySelector(
                    'select[id="product"]'
                ).value;
                const range_date =
                    document.querySelector('input[id="date"]').value;
                if (product.length <= 0 || range_date.length <= 0) {
                    throw "Debe seleccionar el producto y un rango de fecha";
                } else {
                    const url = `${window.location.origin}/api/check-kardex`;
                    const response = await fetch(url, {
                        method: "POST",
                        cache: "no-cache",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            product,
                            range_date,
                        }),
                    });
                    if (response.status !== 400) {
                        const { data } = await response.json();
                        console.log(data);
                        this.kardex_list = data;
                    } else {
                        const { message } = await response.json();
                        throw message;
                    }
                }
            } catch (error) {
                this.kardex_list = [];
                toastr.error(error);
            } finally {
                this.submit_loading = false;
            }
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
    created() {},
});
