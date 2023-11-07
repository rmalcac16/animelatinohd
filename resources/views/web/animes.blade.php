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
        @php
            function formatViews($views)
            {
                $abbreviations = [12 => 'T', 9 => 'B', 6 => 'M', 3 => 'K'];
                foreach ($abbreviations as $exponent => $abbreviation) {
                    if ($views >= pow(10, $exponent)) {
                        return round($views / pow(10, $exponent), 1) . $abbreviation;
                    }
                }
                return $views;
            }
        @endphp

        <h1 class="title">
            <span>{{ $title }}</span>
            <small>{{ $subtitle }}</small>
        </h1>

        @if ($filter)

            <div class="filters">
                <div class="filter">
                    <label>Tipo</label>
                    <select id="sel_type" onchange="handleChange('sel_type', 'type')">
                        @php
                            $optionsType = [
                                '' => 'Todos',
                                'tv' => 'Anime',
                                'movie' => 'Pelicula',
                                'special' => 'Especial',
                                'ova' => 'Ova',
                                'ona' => 'Ona',
                            ];

                            $type = request('type');
                        @endphp

                        @foreach ($optionsType as $value => $label)
                            <option value="{{ $value }}" {{ $type == $value ? 'selected' : '' }}>
                                {{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter">
                    <label>Estado</label>
                    <select id="sel_status" onchange="handleChange('sel_status', 'status')">
                        @php
                            $optionsStatus = [
                                '' => 'Todos',
                                '1' => 'En emisión',
                                '0' => 'Finalizado',
                            ];

                            $status = request('status');
                        @endphp

                        @foreach ($optionsStatus as $value => $label)
                            <option value="{{ $value }}"
                                @if (isset($status)) {{ (int) $status === (int) $value ? 'selected' : '' }} @endif>
                                {{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter">
                    <label>Género</label>
                    <select id="sel_genre" onchange="handleChange('sel_genre', 'genre')">
                        <option value="">Todos</option>
                        @foreach ($genres as $genre)
                            @php
                                $selectedGenre = request('genre');
                            @endphp
                            <option value="{{ $genre->slug }}" {{ $selectedGenre == $genre->slug ? 'selected' : '' }}>
                                {{ $genre->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter">
                    <label>Año</label>
                    <select id="sel_year" onchange="handleChange('sel_year', 'anio')">
                        @php
                            $startYear = 1980;
                            $endYear = 2023;
                            $selectedYear = request('anio');
                        @endphp

                        <option value="" {{ empty($selectedYear) ? 'selected' : '' }}>Todos</option>

                        @for ($year = $endYear; $year >= $startYear; $year--)
                            <option value="{{ $year }}"
                                @if (isset($selectedYear)) {{ (int) $selectedYear === (int) $year ? 'selected' : '' }} @endif>
                                {{ $year }}</option>
                        @endfor
                    </select>
                </div>

                <button class="btnClear" onclick="limpiarFiltros()">Limpiar</button>

            </div>

        @endif
        <div class="list-items">
            @forelse ($animes as $anime)
                <a href="{{ route('web.anime', [$anime->slug]) }}" class="item">
                    <div class="imageContainer">
                        <img alt="{{ __('Ver Anime ' . $anime->name . ' totalmente gratis y en HD') }}"
                            src="{{ 'https://image.tmdb.org/t/p/w300/' . $anime->poster }}" />
                        <div class="bg"></div>
                        <div class="score">
                            @if ($anime->totalviews)
                                <span>
                                    <svg viewBox="0 0 24 24">
                                        <g data-name="Layer 2">
                                            <path
                                                d="M12 5C5 5 2 11 2 12s3 7 10 7 10-6 10-7-3-7-10-7zm0 12c-4 0-7-4-8-5 1-1 4-5 8-5s7 4 8 5c-1 1-4 5-8 5z">
                                            </path>
                                            <path d="M12 8a4 4 0 104 4 4 4 0 00-4-4zm0 6a2 2 0 112-2 2 2 0 01-2 2z"></path>
                                        </g>
                                    </svg>
                                </span>
                            @endif
                            {{ $anime->vote_average ?? formatViews($anime->totalviews) }}
                            @if ($anime->vote_average)
                                <b>★</b>
                            @endif
                        </div>
                    </div>
                    <div class="infoContainer">
                        <p class="title">{{ $anime->name }}</p>
                        <span
                            class="year">{{ $date = date_parse(date('Y-m-d', strtotime($anime->aired)))['year'] }}</span>
                    </div>
                </a>
            @empty
                {{ 'No hay datos' }}
            @endforelse
        </div>

        @if ($pagination)
            <div class="pagination-container">
                {{ $animes->appends(request()->query())->links('web.inc.custom') }}
            </div>
        @endif

    </div>
@endsection


@section('aditionals')

    <script>
        function handleChange(selectId, paramName) {
            var selectedOption = document.getElementById(selectId).value;
            var url = new URL(window.location.href);
            url.searchParams.delete("page");
            url.searchParams.set(paramName, selectedOption);
            window.location.href = url.toString();
        }

        function limpiarFiltros() {
            // Restablecer los valores de los selects a su estado inicial
            document.getElementById("sel_type").value = "";
            document.getElementById("sel_status").value = "";
            document.getElementById("sel_year").value = "";
            document.getElementById("sel_genre").value = "";

            // Redirigir a la URL sin los parámetros de los filtros y mantener "page" en la URL
            var url = new URL(window.location.href);
            url.searchParams.delete("type");
            url.searchParams.delete("status");
            url.searchParams.delete("anio");
            url.searchParams.delete("page");
            url.searchParams.delete("genre");

            window.location.href = url.toString();
        }
    </script>


@endsection
