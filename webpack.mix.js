const mix = require('laravel-mix');

/*
|--------------------------------------------------------------------------
| Mix Asset Management
|--------------------------------------------------------------------------
|
| Mix provides a clean, fluent API for defining some Webpack build steps
| for your Laravel applications. By default, we are compiling the CSS
| file for the application as well as bundling up all the JS files.
|
 */
mix.sass(
    "resources/sass/app.scss",
    "public/css"
);

mix.sass(
    "resources/sass/product-detail/index.scss",
    "public/css/product-detail"
);

mix.sass(
    "resources/sass/shopping-cart/index.scss",
    "public/css/shopping-cart"
);

mix.sass(
    "resources/sass/home/index.scss",
    "public/css/home"
);

mix.sass(
    "resources/sass/store/index.scss",
    "public/css/store"
);

mix.sass(
    "resources/sass/checkout/index.scss",
    "public/css/checkout"
);

mix.js("resources/js/app.js", "public/js");

mix.js("resources/js/form-validation.js", "public/js");
mix.js("resources/js/confirm-deletion.js", "public/js");

mix.js("resources/js/admin/cash-register/index.js", "public/js/admin/cash-register");
mix.js("resources/js/admin/buy-order/index.js", "public/js/admin/buy-order");
mix.js("resources/js/admin/kardex/index.js", "public/js/admin/kardex");
mix.js("resources/js/admin/report-product/index.js", "public/js/admin/report-product");
mix.js("resources/js/admin/report-most-sold/index.js", "public/js/admin/report-most-sold");

mix.js("resources/js/web/product-detail/index.js", "public/js/web/product-detail");
mix.js("resources/js/web/shopping-cart/index.js", "public/js/web/shopping-cart");
mix.js("resources/js/web/shipment-data/index.js", "public/js/web/shipment-data");
mix.js("resources/js/web/checkout/index.js", "public/js/web/checkout");
mix.js("resources/js/web/store/index.js", "public/js/web/store");