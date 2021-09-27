import * as $ from "jquery";
import "jquery-validation";
import "select2";

$('.select-district').select2({
    placeholder: "Selecciona su distrito",
    theme: 'bootstrap4',
    width: '100%'
});

$.validator.addMethod(
    "noDecimal",
    function (value, element) {
        return !(value % 1);
    },
    "No se aceptan números decimales"
);

$("#form").validate({
    errorElement: "span",
    errorPlacement: function (error, element) {
        error.addClass("invalid-feedback");
        element.closest(".form-group").append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass("is-invalid");
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass("is-invalid");
    }
});

$.extend($.validator.messages, {
    required: "Este campo es obligatorio.",
    remote: "Por favor, llene este campo.",
    email: "Por favor, escriba un correo electrónico válido.",
    url: "Por favor, escriba una URL válida.",
    date: "Por favor, escriba una fecha válida.",
    dateISO: "Por favor, escriba una fecha (ISO) válida.",
    number: "Por favor, escriba un número válido.",
    digits: "Por favor, escriba sólo dígitos.",
    creditcard: "Por favor, escriba un número de tarjeta válido.",
    equalTo: "Por favor, escriba el mismo valor de nuevo.",
    extension: "Por favor, escriba un valor con una extensión permitida.",
    maxlength: $.validator.format(
        "Por favor, no escriba más de {0} caracteres."
    ),
    minlength: $.validator.format(
        "Por favor, no escriba menos de {0} caracteres."
    ),
    rangelength: $.validator.format(
        "Por favor, escriba un valor entre {0} y {1} caracteres."
    ),
    range: $.validator.format("Por favor, escriba un valor entre {0} y {1}."),
    max: $.validator.format("Por favor, escriba un valor menor o igual a {0}."),
    min: $.validator.format("Por favor, escriba un valor mayor o igual a {0}."),
    nifES: "Por favor, escriba un NIF válido.",
    nieES: "Por favor, escriba un NIE válido.",
    cifES: "Por favor, escriba un CIF válido.",
});