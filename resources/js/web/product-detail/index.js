window.Vue = require("vue/dist/vue.js");

const vm = new Vue({
    el: "#body",
    data: {
        loading: true,
    },
    computed: {
        
    },
    methods: {
        async add_cart(e) {
            const url = `${window.location.origin}/api/cart-add-item`;
            const product_id = e.target.dataset.id;
            const response = await fetch(url, {
                method: "POST",
                cache: "no-cache",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    id: product_id,
                }),
            });
            if (response.status === 400) {
                const { error } = await response.json();
            } else {
                const {data, total_items} = await response.json();
                document.querySelector('#cart-count').textContent = total_items;
                console.log(data, total_items);
            }
            return;
        },
    },
    created() {
        
    },
});
