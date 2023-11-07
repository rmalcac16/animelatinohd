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
    <script src="{{ asset('web/tailwindcss/main') }}"></script>
    <link href="{{ asset('web/css/styles.css') }}" rel="stylesheet" type="text/css" />
    @yield('styles')
</head>

<body>
    @include('web.inc.navbar')

    @yield('content')

    <script src="{{ asset('web/js/jquery-3.7.0.min.js') }}"></script>

    @yield('aditionals')

    <script>
        function _0x4c7d() {
            var _0x56f8c1 = ['location', '2705498LZPKyi', 'width', '282dLTRlK', 'visible', 'origin', '11805ZOxRGP',
                'resize', 'visibilityState', '3614283TILwUA', 'innerHeight', '946072IefUXS', '9DrUCoa', 'href',
                'innerWidth', '270808FKbyMh', 'addEventListener', 'outerHeight', 'height', '7QDdrDE', '627aYiYXF',
                '40CMxrEq', '1613328QSMdDX', '759072dgMCon'
            ];
            _0x4c7d = function() {
                return _0x56f8c1;
            };
            return _0x4c7d();
        }

        function _0x4455(_0x29c9af, _0x57755a) {
            var _0x4c7de5 = _0x4c7d();
            return _0x4455 = function(_0x44550a, _0x203100) {
                _0x44550a = _0x44550a - 0xae;
                var _0x50625c = _0x4c7de5[_0x44550a];
                return _0x50625c;
            }, _0x4455(_0x29c9af, _0x57755a);
        }(function(_0x25c887, _0x422bc4) {
            var _0x1a9554 = _0x4455,
                _0x573f7b = _0x25c887();
            while (!![]) {
                try {
                    var _0x25d294 = -parseInt(_0x1a9554(0xaf)) / 0x1 + parseInt(_0x1a9554(0xb2)) / 0x2 + parseInt(
                            _0x1a9554(0xbd)) / 0x3 * (-parseInt(_0x1a9554(0xbc)) / 0x4) + -parseInt(_0x1a9554(0xb7)) /
                        0x5 * (parseInt(_0x1a9554(0xb4)) / 0x6) + -parseInt(_0x1a9554(0xc4)) / 0x7 * (parseInt(
                            _0x1a9554(0xc0)) / 0x8) + parseInt(_0x1a9554(0xba)) / 0x9 * (-parseInt(_0x1a9554(0xae)) /
                            0xa) + -parseInt(_0x1a9554(0xc5)) / 0xb * (-parseInt(_0x1a9554(0xb0)) / 0xc);
                    if (_0x25d294 === _0x422bc4) break;
                    else _0x573f7b['push'](_0x573f7b['shift']());
                } catch (_0x14454a) {
                    _0x573f7b['push'](_0x573f7b['shift']());
                }
            }
        }(_0x4c7d, 0xd7e45), (function() {
            var _0x1b585f = _0x4455,
                _0x4420aa = ![],
                _0xf19bde = 0xa0;

            function _0x470164() {
                var _0x93a145 = _0x4455,
                    _0x2ef073 = window['outerWidth'] - window[_0x93a145(0xbf)] > _0xf19bde,
                    _0x19dd8d = window[_0x93a145(0xc2)] - window[_0x93a145(0xbb)] > _0xf19bde;
                if ((_0x2ef073 || _0x19dd8d) && !_0x4420aa) _0x4420aa = !![], window['location']['href'] = window[
                    _0x93a145(0xb1)][_0x93a145(0xb6)];
                else !(_0x2ef073 || _0x19dd8d) && _0x4420aa && (_0x4420aa = ![]);
            }
            setInterval(_0x470164, 0x3e8), window[_0x1b585f(0xc1)](_0x1b585f(0xb8), _0x470164);
            var _0x4627fb = {
                'width': window['innerWidth'],
                'height': window[_0x1b585f(0xbb)]
            };

            function _0x221d78() {
                var _0x5f1b77 = _0x1b585f;
                (window['outerWidth'] < _0x4627fb[_0x5f1b77(0xb3)] || window[_0x5f1b77(0xc2)] < _0x4627fb[_0x5f1b77(
                    0xc3)]) && _0x41a72d();
            }

            function _0x41a72d() {
                var _0x4c102f = _0x1b585f;
                window[_0x4c102f(0xb1)][_0x4c102f(0xbe)] = '/';
            }
            window[_0x1b585f(0xc1)](_0x1b585f(0xb8), _0x221d78), document[_0x1b585f(0xc1)]('visibilitychange',
                function() {
                    var _0x15b337 = _0x1b585f;
                    document[_0x15b337(0xb9)] === _0x15b337(0xb5) && _0x221d78();
                });
        }()));
    </script>

</body>

</html>
