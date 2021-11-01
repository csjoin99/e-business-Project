const product = document.querySelector('select[id="product"]');
const date = document.querySelector('input[id="date"]');
const button = document.querySelector('button[id="get-report"]');

button.addEventListener("click", async () => {
    button.disabled = true;
    const url = `${window.location.origin}/api/report-product`;
    if (product.value.length <= 0 || date.value.length <= 0) {
        toastr.error("Debe seleccionar un producto y un rango de fecha");
        button.disabled = false;
    } else {
        const response = await fetch(url, {
            method: "POST",
            cache: "no-cache",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                product: product.value,
                date: date.value,
            }),
        });
        if (response.status !== 400) {
            const { data_order_sum, data_buy_order_sum, data_label } =
                await response.json();
            let chart_order_data = data_order_sum;
            let chart_buy_order_data = data_buy_order_sum;
            let chart_label = data_label;
            button.disabled = false;
            myChart.destroy();
            myChart = new Chart(ctx, {
                type: "line",
                data: {
                    labels: chart_label,
                    datasets: [
                        {
                            label: "Ventas",
                            data: chart_order_data,
                            backgroundColor: "rgba(255, 99, 132, 0.8)",
                            borderColor: "rgba(255, 99, 132, 0.8)",
                            borderWidth: 1,
                            fill: false,
                        },
                        {
                            label: "Compras",
                            data: chart_buy_order_data,
                            backgroundColor: "rgba(54, 162, 235, 0.8)",
                            borderColor: "rgba(54, 162, 235, 0.8)",
                            borderWidth: 1,
                            fill: false,
                        },
                    ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                    legend: {
                        position: "top",
                    },
                    title: {
                        display: true,
                        text: "Reporte de producto",
                    },
                },
            });
        } else {
            const { message } = await response.json();
            toastr.error(message);
            button.disabled = false;
        }
    }
});

const ctx = document.getElementById("myChart").getContext("2d");
let myChart = new Chart(ctx, {
    type: "line",
    data: {
        labels: [],
        datasets: [
            {
                label: "Nro de ventas",
                data: [],
                backgroundColor: [],
                borderColor: [],
                borderWidth: 1,
            },
        ],
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
            },
        },
        legend: {
            position: "top",
        },
        title: {
            display: true,
            text: "Reporte de producto",
        },
    },
});
