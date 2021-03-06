<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    {{-- <link href="{{ asset('css/home/index.css') }}" rel="stylesheet" type="text/css" /> --}}
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>@yield('title')</title>
    @yield('css')
    @if ($settings->color)
        <style>
            .text-color-brand {
                color: {{ $settings->color }} !important;
            }

            .background-color-brand {
                background-image: linear-gradient({{ $settings->color }}, {{ $settings->color }}) !important;
            }

            .border-color-brand {
                border-color: {{ $settings->color }} !important;
            }

        </style>
    @endif
</head>

<body>
    <div id="body">
        @yield('content')
    </div>
</body>
@yield('js')
<script>
    let web_logout = document.querySelector('a[id="web-logout"]');
    if (web_logout) {
        web_logout.addEventListener('click', () => {
            let form = web_logout.closest('form');
            form.submit();
        });
    }
</script>

</html>
