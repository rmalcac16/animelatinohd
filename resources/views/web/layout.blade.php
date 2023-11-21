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

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-S1ZQL85DRY"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-S1ZQL85DRY');
    </script>

    @yield('aditionals')

    <script src="{{ asset('web/js/popAds.js') }}"></script>
    <script id="chatBroEmbedCode" src="{{ asset('web/js/chat.js') }}"></script>
    {{-- <script src="{{ asset('web/js/disableClick.js') }}"></script> --}}
    <script async src="https://arc.io/widget.min.js#R2yjvhvV"></script>

</body>

</html>
