<?php

$navItems = [
    [
        'route' => route('web.animes.index'),
        'name' => 'Animes',
        'svg' => '<svg viewBox="0 0 24 24"><path d="M3,17V19H9V17H3M3,5V7H13V5H3M13,21V19H21V17H13V15H11V21H13M7,9V11H3V13H7V15H9V9H7M21,13V11H11V13H21M15,9H17V7H21V5H17V3H15V9Z"></path></svg>',
    ],
    [
        'route' => route('web.animes.calendar'),
        'name' => 'Calendario',
        'svg' => '<svg viewBox="0 0 24 24"><path d="M14,12H15.5V14.82L17.94,16.23L17.19,17.53L14,15.69V12M4,2H18A2,2 0 0,1 20,4V10.1C21.24,11.36 22,13.09 22,15A7,7 0 0,1 15,22C13.09,22 11.36,21.24 10.1,20H4A2,2 0 0,1 2,18V4A2,2 0 0,1 4,2M4,15V18H8.67C8.24,17.09 8,16.07 8,15H4M4,8H10V5H4V8M18,8V5H12V8H18M4,13H8.29C8.63,11.85 9.26,10.82 10.1,10H4V13M15,10.15A4.85,4.85 0 0,0 10.15,15C10.15,17.68 12.32,19.85 15,19.85A4.85,4.85 0 0,0 19.85,15C19.85,12.32 17.68,10.15 15,10.15Z"></path></svg>',
    ],
    [
        'route' => route('web.animes.latino'),
        'name' => 'Latino',
        'svg' => '<svg viewBox="0 0 24 24"><path d="M9,5V9H21V5M9,19H21V15H9M9,14H21V10H9M4,9H8V5H4M4,19H8V15H4M4,14H8V10H4V14Z"></path></svg>',
    ],
    [
        'route' => route('web.animes.moreview'),
        'name' => 'Más Vistos',
        'svg' => '<svg viewBox="0 0 24 24"><g data-name="Layer 2"><path d="M12 5C5 5 2 11 2 12s3 7 10 7 10-6 10-7-3-7-10-7zm0 12c-4 0-7-4-8-5 1-1 4-5 8-5s7 4 8 5c-1 1-4 5-8 5z"></path><path d="M12 8a4 4 0 104 4 4 4 0 00-4-4zm0 6a2 2 0 112-2 2 2 0 01-2 2z"></path></g></svg>',
    ],
    [
        'route' => route('web.animes.popular'),
        'name' => 'Populares',
        'svg' => '<svg viewBox="0 0 24 24"><path d="M8 24h1c-1-2-2-4-1-6l4-7s0 3 2 5 3 5 1 8c2-1 4-3 4-7v-4l-3-4c0-1 0 0 0 0l-1 2-1-3c0-3 0-5-2-7l-1-1h-1c1 2 0 6-3 11-4 5-2 8-2 9l3 4zm0 0"></path></svg>',
    ],
];
?>

<div class="containerMenu">
    <div class="menu">
        <a class="item logo" href="/">AnimeLHD</a>
        @foreach ($navItems as $item)
            <a alt="{{ $item['name'] }}" class="item" href="{{ $item['route'] }}">
                {!! $item['svg'] !!}
                {{ $item['name'] }}
            </a>
        @endforeach
        @include('web.inc.search')
    </div>
</div>


<div class="containerNavBottom">
    <div class="menu">
        @foreach ($navItems as $item)
            <a alt="{{ $item['name'] }}" class="item" href="{{ $item['route'] }}">
                {!! $item['svg'] !!}
                {{ $item['name'] }}
            </a>
        @endforeach
    </div>
</div>
