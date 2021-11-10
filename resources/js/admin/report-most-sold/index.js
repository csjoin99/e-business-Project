import Chart from "chart.js/auto";
import ChartDataLabels from "chartjs-plugin-datalabels";

const date = document.querySelector('input[id="date"]');
const button = document.querySelector('button[id="get-report"]');

button.addEventListener("click", async () => {
    button.disabled = true;
    const url = `${window.location.origin}/api/report-most-sold`;
    if (date.value.length <= 0) {
        toastr.error("Debe seleccionar un rango de fecha");
        button.disabled = false;
    } else {
        const response = await fetch(url, {
            method: "POST",
            cache: "no-cache",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                date: date.value,
            }),
        });
        if (response.status !== 400) {
            const { data, label, title } = await response.json();
            button.disabled = false;
            myChart.destroy();
            myChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: label,
                    datasets: [
                        {
                            label: "Cantidad de productos vendidos",
                            data: data,
                            backgroundColor: "rgb(54, 162, 235)",
                            borderColor: "rgb(54, 162, 235)",
                            borderWidth: 1,
                            fill: false,
                        }
                    ],
                },
                options: {
                    plugins: {
                        legend: {
                            display: true
                        },
                        datalabels: {
                            anchor: 'center',
                            align: 'center',
                            backgroundColor: function(context) {
                                return context.dataset.backgroundColor;
                            },     
                            color: 'white',
                        }
                    },
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
                        text: title,
                    },
                    layout: {
                        padding: {
                        top: 32,
                        right: 16,
                        bottom: 16,
                        left: 8
                        }
                    },
                },
                plugins: [ChartDataLabels],
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
    type: "bar",
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
        plugins: {
            legend: {
                display: false,
            },
        },
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
        layout: {
            padding: {
                top: 32,
                right: 16,
                bottom: 16,
                left: 8,
            },
        },
    },
});
