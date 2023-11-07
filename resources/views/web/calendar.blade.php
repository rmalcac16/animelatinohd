@extends('web.layout')

@section('title', $title)


@section('meta')
    <meta name="description"
        content="{{ 'Anime Online Gratis, mira los últimos capitulos de los animes del momento sin ninguna restriccion subtitulados al español latino en • ' . config('app.name') }}" />
    <meta name="og:title" content="{{ $title . ' • ' . config('app.name') }}" />
    <meta name="og:description"
        content="{{ 'Anime Online Gratis, mira los últimos capitulos de los animes del momento sin ninguna restriccion subtitulados al español latino en • ' . config('app.name') }}" />
    <meta name="og:locale" content="es_LA" />
    <meta name="og:type" content="website" />
    <meta name="og:image" content="https://i.imgur.com/Iof3uSm.jpg" />
    <meta property="og:image:width" content="265" />
    <meta property="og:image:height" content="265" />
    <meta itemProp="image" content="https://i.imgur.com/Iof3uSm.jpg" />
@endsection

@section('content')

    <div class="contenedor">
        <h1 class="title">
            <span>{{ $title }}</span>
            <small>{{ $subtitle }}</small>
        </h1>

        @php
            use Carbon\Carbon;
            $contador = 1;
            $days = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'];
        @endphp

        <div class="calendar">
            @forelse ($animes as $day => $animesList)
                <div class="daynameContainer">
                    <div class="dayname">
                        @if ($contador == 1)
                            {{ 'Hoy' }}
                        @elseif($contador == 2)
                            {{ 'Mañana' }}
                        @else
                            {{ $days[$day - 1] }}
                        @endif
                    </div>
                    <span class="line"></span>
                </div>
                @php
                    $contador++;
                @endphp
                @if (count($animesList) > 0)
                    <div class="list-animes">
                        @foreach ($animesList as $anime)
                            <a class="item" href="{{ route('web.anime', [$anime->slug]) }}">
                                <div class="content"
                                    style="background-image: url({{ 'https://image.tmdb.org/t/p/w300/' . $anime->banner }})">
                                    <div class="info">
                                        @php
                                            $anime->date = Carbon::parse($anime->date);
                                            $hoursAgo = $anime->date->diffInHours(now());
                                        @endphp
                                        <p>
                                            Episodio {{ $hoursAgo > 24 ? $anime->lastEpisode + 1 : $anime->lastEpisode }}
                                            @if ($hoursAgo < 24)
                                                • <b>Hace {{ $anime->date->diffForHumans() }}</b>
                                            @endif
                                        </p>

                                        <h1>
                                            <div class="limit">{{ $anime->name }}</div>
                                        </h1>
                                    </div>
                                    <div class="overlay"></div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p>No hay animes para este día.</p>
                @endif
            @empty
                <p>No hay datos disponibles.</p>
            @endforelse
        </div>
    </div>
@endsection


@section('aditionals')

    <script>
        function handleChange(selectId, paramName) {
            var selectedOption = document.getElementById(selectId).value;
            var url = new URL(window.location.href);
            url.searchParams.set(paramName, selectedOption);
            window.location.href = url.toString();
        }

        function limpiarFiltros() {
            // Restablecer los valores de los selects a su estado inicial
            document.getElementById("sel_type").value = "";
            document.getElementById("sel_status").value = "";
            document.getElementById("sel_year").value = "";

            // Redirigir a la URL sin los parámetros de los filtros
            var url = new URL(window.location.href);
            url.searchParams.delete("type");
            url.searchParams.delete("status");
            url.searchParams.delete("anio");
            window.location.href = url.toString();
        }
    </script>

@endsection
