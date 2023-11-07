@extends('web.layout')

@section('title', 'Ver ' . $anime->name . ' Capítulo ' . $episode->number . ' Sub Español Latino en HD Online')

@section('meta')
    <meta name="description"
        content="{{ 'Anime ' . $anime->name . ' capitulo ' . $episode->number . ' Sub Español Latino, ver online y descargar en hd 720p sin ninguna limitación' }}" />
    <meta name="og:title"
        content="{{ 'Ver ' . $anime->name . ' Capítulo ' . $episode->number . ' Sub Español Latino en HD Online • ' . config('app.name') }}" />
    <meta name="og:description"
        content="{{ 'Anime ' . $anime->name . ' capitulo ' . $episode->number . ' Sub Español Latino, ver online y descargar en hd 720p sin ninguna limitación' }}" />
    <meta name="og:locale" content="es_LA" />
    <meta name="og:type" content="video.episode" />
    <meta name="og:image" content="{{ 'https://image.tmdb.org/t/p/w780' . $anime->banner }}" />
    <meta property="og:image:width" content="552" />
    <meta property="og:image:height" content="310" />
    <meta itemProp="image" content="{{ 'https://image.tmdb.org/t/p/w780' . $anime->banner }}" />
@endsection



@section('content')

    <div class="contenedor">
        <div class="containerEpisode">

            @if (count($players) > 0)

                <div class="videoPlayer">
                    <div class="options">
                        <div class="type">
                            <label for="selectLanguage">Idioma:</label>
                            <select id="selectLanguage">
                                @php
                                    $languagesShown = [];
                                @endphp

                                @foreach ($players as $player)
                                    @if (($player->languaje === '0' || $player->languaje === '1') && !in_array($player->languaje, $languagesShown))
                                        @php
                                            $languagesShown[] = $player->languaje;
                                        @endphp
                                        <option value="{{ $player->languaje }}">
                                            {{ $player->languaje == '0' ? 'Subtitulado' : 'Latino' }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="type">
                            <label for="selectServer">Servidor:</label>
                            <select id="selectServer"></select>
                        </div>
                    </div>

                    <div class="video">
                        <div id="message" class="message">El video se está cargando...</div>
                        <iframe id="videoIframe" frameborder="0" allowfullscreen data-token="{{ csrf_token() }}"></iframe>
                    </div>
                </div>

            @endif

            <div class="navCaps">
                <div class="column">
                    <img src="{{ 'https://image.tmdb.org/t/p/w45' . $anime->poster }}" alt="{{ $anime->name }}">
                    <div class="details">
                        <div class="info">
                            <h1>{{ $anime->name }}</h1>
                            <div class="currentEp">
                                Episodio {{ $episode->number }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="actions">
                    @if ($episodeA)
                        <a href="{{ route('web.episode', ['anime' => $anime->slug, 'episode' => $episodeA->number]) }}"
                            class="button">
                            <svg viewBox="0 0 24 24">
                                <path d="M15.41,16.58L10.83,12L15.41,7.41L14,6L8,12L14,18L15.41,16.58Z"></path>
                            </svg>
                            <span>Ep. Anterior</span>
                        </a>
                    @endif

                    <a class="button" href="{{ route('web.anime', [$anime->slug]) }}">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M7,13H21V11H7M7,19H21V17H7M7,7H21V5H7M2,11H3.8L2,13.1V14H5V13H3.2L5,10.9V10H2M3,8H4V4H2V5H3M2,17H4V17.5H3V18.5H4V19H2V20H5V16H2V17Z">
                            </path>
                        </svg>
                    </a>

                    @if ($episodeN)
                        <a href="{{ route('web.episode', ['anime' => $anime->slug, 'episode' => $episodeN->number]) }}"
                            class="button">
                            <span>Ep. Siguiente</span>
                            <svg viewBox="0 0 24 24">
                                <path d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z"></path>
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('aditionals')
    <script>
        const videoNewUrl = "{{ route('web.video', [':id']) . '?_token=' . csrf_token() }}"

        const players = {!! json_encode($players) !!};

        function updateServerOptions(selectedLanguage) {
            const selectServer = document.getElementById('selectServer');
            selectServer.innerHTML = '';
            const filteredPlayers = players.filter(player => player.languaje === selectedLanguage);
            filteredPlayers.forEach(player => {
                const option = document.createElement('option');
                option.value = player.id;
                option.innerText = player.title;
                selectServer.appendChild(option);
            });
        }

        const selectLanguage = document.getElementById('selectLanguage');
        const selectServer = document.getElementById('selectServer');
        const videoIframe = document.getElementById('videoIframe');
        const message = document.getElementById('message');


        selectLanguage.addEventListener('change', () => {
            const selectedLanguage = selectLanguage.value;

            videoIframe.style.display = 'none';
            message.style.display = 'flex';

            updateServerOptions(selectedLanguage);

            const defaultPlayer = players.find(player => player.languaje === selectedLanguage);
            videoIframe.src = defaultPlayer ? videoNewUrl.replace(':id', defaultPlayer.id) : '';

            if (!defaultPlayer) {
                videoIframe.style.display = 'none';
            } else {
                videoIframe.style.display = 'block';
            }
        });

        selectServer.addEventListener('change', () => {

            videoIframe.style.display = 'none';
            message.style.display = 'flex';

            const selectedServerId = selectServer.value;
            const selectedLanguage = selectLanguage.value;

            const selectedPlayer = players.find(player => player.id == selectedServerId && player.languaje ===
                selectedLanguage);

            if (selectedPlayer) {
                videoIframe.src = videoNewUrl.replace(':id', selectedPlayer.id);
                videoIframe.style.display = 'block';
            } else {
                videoIframe.src = '';
                videoIframe.style.display = 'none';
            }

        });

        videoIframe.onload = () => {
            message.style.display = 'none';
        };

        // Disparar el evento change al cargar la página para actualizar las opciones de servidor
        selectLanguage.dispatchEvent(new Event('change'));
    </script>

@endsection
