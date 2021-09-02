window.Swal = require("sweetalert2");

document.getElementsByName("delete-button").forEach((button) => {
    button.addEventListener("click", (e) => {
        e.preventDefault();
        Swal.fire({
            icon: "warning",
            title: "¡ELIMINAR!",
            text: "¿Estás seguro que quieres eliminar?",
            confirmButtonText: "Confirmar",
            confirmButtonColor: "#2F85D5",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            cancelButtonColor: "#DD3232",
        }).then((result) => {
            if (result.isConfirmed) {
                button.closest('form').submit();
            }
        });
    });
});

document.getElementsByName("undo-button").forEach((button) => {
    button.addEventListener("click", (e) => {
        e.preventDefault();
        Swal.fire({
            icon: "warning",
            title: "¡RESTAURAR!",
            text: "¿Estás seguro que restaurar al usuario?",
            confirmButtonText: "Confirmar",
            confirmButtonColor: "#2F85D5",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            cancelButtonColor: "#DD3232",
        }).then((result) => {
            if (result.isConfirmed) {
                button.closest('form').submit();
            }
        });
    });
});

document.getElementsByName("cancel-button").forEach((button) => {
    button.addEventListener("click", (e) => {
        e.preventDefault();
        Swal.fire({
            icon: "warning",
            title: "¡ANULAR!",
            text: "¿Estás seguro que quieres anular la orden?",
            confirmButtonText: "Confirmar",
            confirmButtonColor: "#2F85D5",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            cancelButtonColor: "#DD3232",
        }).then((result) => {
            if (result.isConfirmed) {
                button.closest('form').submit();
            }
        });
    });
});