@extends('web.layout')

@section('title', 'Ver ' . $episode->anime->name . ' Capítulo ' . $episode->number . ' Sub Español Latino en HD Online')

@section('meta')
    <meta name="description"
        content="{{ 'Anime ' . $episode->anime->name . ' capitulo ' . $episode->number . ' Sub Español Latino, ver online y descargar en hd 720p sin ninguna limitación' }}" />
    <meta name="og:title"
        content="{{ 'Ver ' . $episode->anime->name . ' Capítulo ' . $episode->number . ' Sub Español Latino en HD Online • ' . config('app.name') }}" />
    <meta name="og:description"
        content="{{ 'Anime ' . $episode->anime->name . ' capitulo ' . $episode->number . ' Sub Español Latino, ver online y descargar en hd 720p sin ninguna limitación' }}" />
    <meta name="og:locale" content="es_LA" />
    <meta name="og:type" content="video.episode" />
    <meta name="og:image" content="{{ 'https://image.tmdb.org/t/p/w780' . $episode->anime->banner }}" />
    <meta property="og:image:width" content="552" />
    <meta property="og:image:height" content="310" />
    <meta itemProp="image" content="{{ 'https://image.tmdb.org/t/p/w780' . $episode->anime->banner }}" />
@endsection



@section('content')

    <div class="contenedor">
        <div class="containerEpisode">

            @if ($episode->dataPlayers)
                <div class="videoPlayer">
                    <div class="options">
                        <div class="type">
                            <label for="selectLanguage">Idioma:</label>
                            <select id="selectLanguage">
                                @foreach ($episode->dataPlayers->keys() as $language)
                                    <option value="{{ $language }}">{{ $language == 0 ? 'Subtitulado' : 'Latino' }}
                                    </option>
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
                    <img src="{{ 'https://image.tmdb.org/t/p/w45' . $episode->anime->poster }}"
                        alt="{{ $episode->anime->name }}">
                    <div class="details">
                        <div class="info">
                            <h1>{{ $episode->anime->name }}</h1>
                            <div class="currentEp">
                                Episodio {{ $episode->number }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="actions">
                    @if ($episode->previousEpisode)
                        <a href="{{ route('web.episode', [$episode->anime->slug, $episode->previousEpisode->number]) }}"
                            class="button">
                            <svg viewBox="0 0 24 24">
                                <path d="M15.41,16.58L10.83,12L15.41,7.41L14,6L8,12L14,18L15.41,16.58Z"></path>
                            </svg>
                            <span>Ep. Anterior</span>
                        </a>
                    @endif

                    <a class="button" href="{{ route('web.anime', [$episode->anime->slug]) }}">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M7,13H21V11H7M7,19H21V17H7M7,7H21V5H7M2,11H3.8L2,13.1V14H5V13H3.2L5,10.9V10H2M3,8H4V4H2V5H3M2,17H4V17.5H3V18.5H4V19H2V20H5V16H2V17Z">
                            </path>
                        </svg>
                    </a>

                    @if ($episode->nextEpisode)
                        <a href="{{ route('web.episode', [$episode->anime->slug, $episode->nextEpisode->number]) }}"
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

        const players = {!! json_encode($episode->dataPlayers) !!};

        const selectServer = document.getElementById('selectServer');
        const selectLanguage = document.getElementById('selectLanguage');
        const videoIframe = document.getElementById('videoIframe');
        const message = document.getElementById('message');

        updateServerOptions(selectLanguage.value);

        updateIframe(selectServer.value);

        selectLanguage.addEventListener('change', (event) => {
            const selectedLanguage = event.target.value;
            updateServerOptions(selectedLanguage);
        });

        selectServer.addEventListener('change', (event) => {
            const selectedServer = event.target.value;
            updateIframe(selectedServer);
        });

        function updateServerOptions(selectedLanguage) {
            selectServer.innerHTML = '';
            const playersByLanguage = players[selectedLanguage];
            playersByLanguage.forEach(player => {
                const serverTitle = player.server.title;
                const playerId = player.id;
                const option = document.createElement('option');
                option.value = playerId;
                option.textContent = serverTitle;
                selectServer.appendChild(option);
            });
            updateIframe(playersByLanguage[0].id);
        }

        function updateIframe(playerId) {
            const url = videoNewUrl.replace(':id', playerId);
            videoIframe.src = url;
            message.style.display = 'flex';
        }

        videoIframe.addEventListener('load', () => {
            message.style.display = 'none';
        });
    </script>

@endsection
