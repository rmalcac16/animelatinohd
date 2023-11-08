<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, shrink-to-fit=no">
    <title>@yield('title') • {{ config('app.name', 'Laravel') }}</title>
    <link rel="canonical" href={{ url()->full() }} />
    <meta name="og:url" content={{ url()->full() }} />
    @yield('meta')
    <meta name="robots" content="index, follow" />
    <meta name="theme-color" content="#000000" />
    <link rel="manifest" href="/manifest.json" />
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap"
        rel="stylesheet">
    <link href="{{ asset('web/css/styles.css') }}" rel="stylesheet" type="text/css" />
    @yield('styles')
</head>

<body>
    @include('web.inc.navbar')

    @yield('content')

    <script src="{{ asset('web/js/jquery-3.7.0.min.js') }}"></script>

    @yield('aditionals')

</body>

</html>
