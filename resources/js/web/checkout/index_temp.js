window.Vue = require("vue/dist/vue.js");
import toastr from "toastr";

const vm = new Vue({
    el: "#checkout-section",
    data: {
        shipment_data: {
            address: "",
            reference: "",
            district: "",
            shipment_date: new Date().toLocaleDateString("en-GB"),
            errors: {
                address: "",
                reference: "",
                district: "",
                shipment_date: "",
            },
        },
    },
    computed: {},
    methods: {
        async validate_first_step() {
            const form = document.querySelector('form[id="msform"]');
            this.shipment_data.errors = {
                address: "",
                reference: "",
                district: "",
                shipment_date: "",
            };
            this.shipment_data.district = document.querySelector(
                'select[id="district"]'
            ).value;
            this.shipment_data.shipment_date = document.querySelector(
                'input[id="shipment_date"]'
            ).value;
            if (!this.shipment_data.address) {
                this.shipment_data.errors.address = "Ingrese la dirección";
            }
            if (!this.shipment_data.reference) {
                this.shipment_data.errors.reference = "Ingrese la referencia";
            }
            if (!this.shipment_data.district) {
                this.shipment_data.errors.district = "Selecciona el distrito";
            }
            if (!this.shipment_data.shipment_date) {
                this.shipment_data.errors.shipment_date =
                    "Seleccione la fecha de envío";
            }
            const has_errors = Object.entries(this.shipment_data.errors).some(
                (item) => {
                    return item[1];
                }
            );
            if (has_errors) {
                console.log('errors: ',this.shipment_data.errors);
                return;
            } else {
                console.log('success');
            }
        },
    },
    async created() {
        console.log("CREATED");
    },
});
