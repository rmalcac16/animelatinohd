@extends('web.layout')

@section('title', 'Ver ' . $anime->name . ' Online Sub Español Latino')

@php
    use Illuminate\Support\Str;
@endphp

@section('meta')
    <meta name="description" content="{{ Str::limit($anime->overview, 165, '...') }}" />
    <meta name="og:title" content="{{ 'Ver ' . $anime->name . ' Online Sub Español Latino • ' . config('app.name') }}" />
    <meta name="og:description" content="{{ Str::limit($anime->overview, 165, '...') }}" />
    <meta name="og:locale" content="es_LA" />
    <meta name="og:type" content="website" />
    <meta name="og:image" content="{{ 'https://image.tmdb.org/t/p/w500' . $anime->poster }}" />
    <meta property="og:image:width" content="310" />
    <meta property="og:image:height" content="440" />
    <meta itemProp="image" content="{{ 'https://image.tmdb.org/t/p/w500' . $anime->poster }}" />
@endsection

@section('content')
    <div class="animePage">
        <div class="banner" style="background-image: url({{ 'https://image.tmdb.org/t/p/w780' . $anime->banner }})">
            <div class="overlay"></div>
            <div class="contentBanner">
                <div class="column">
                    <h1>{{ $anime->name }}</h1>

                    <div class="genres">
                        @foreach (explode(',', $anime->genres) as $genre)
                            <a class="genre" title="{{ $genre }}"
                                href="/animes?genre={{ $genre }}">{{ $genre }}</a>
                        @endforeach
                        <a class="genre" title="accion" href="/animes?genre=accion">accion</a>
                        <a class="genre" title="fantasia" href="/animes?genre=fantasia">fantasia</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="info">
                <div class="cover">
                    <img class="poster" alt="{{ $anime->name }}" height="auto" width="auto" layout="responsive"
                        loading="lazy" src="{{ 'https://image.tmdb.org/t/p/w300' . $anime->poster }}" quality="95">
                </div>
                <div class="detailed">
                    <div class="item top">
                        <div class="total">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9M12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17M12,4.5C7,4.5 2.73,7.61 1,12C2.73,16.39 7,19.5 12,19.5C17,19.5 21.27,16.39 23,12C21.27,7.61 17,4.5 12,4.5Z">
                                </path>
                            </svg> {{ $anime->views }}
                        </div>
                        <div class="votes">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M20,12A8,8 0 0,1 12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4C12.76,4 13.5,4.11 14.2,4.31L15.77,2.74C14.61,2.26 13.34,2 12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12M7.91,10.08L6.5,11.5L11,16L21,6L19.59,4.58L11,13.17L7.91,10.08Z">
                                </path>
                            </svg> {{ $anime->popularity }}
                        </div>
                    </div>
                    <div class="item">
                        <small>Avg. Score</small>
                        <span>
                            <svg viewBox="0 0 24 24" class="Anime_gold__hk6jJ">
                                <path
                                    d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z">
                                </path>
                            </svg>{{ $anime->vote_average . '/10' }}
                        </span>
                    </div>
                    <div class="item">
                        <small>Estado</small>
                        <span>{{ $anime->status == 0 ? 'Finalizado' : 'En emisíon' }}</span>
                    </div>
                    <div class="item">
                        <small>Clasificación</small>
                        <span>{{ $anime->rating }}</span>
                    </div>
                    <div class="item">
                        <small>Estreno</small>
                        <span>{{ \Carbon\Carbon::parse($anime->aired)->format('d-M-Y') }}</span>
                    </div>
                    <div class="item">
                        <small>Titulos Alternativos</small>
                        <span>{{ \Illuminate\Support\Str::limit($anime->name_alternative, 20, '...') }}</span>
                    </div>
                </div>
            </div>
            <div class="data">
                <div class="overview">
                    <p>
                        {{ $anime->overview }}
                    </p>
                </div>
                <div class="listEpisodes">
                    @forelse ($episodes as $episode)
                        <a class="episodeContainer" href="{{ route('web.episode', [$anime->slug, $episode->number]) }}">
                            <div class="episodeImageContainer">
                                <img alt="{{ $anime->title . ' ' . $episode->number }}"
                                    src="{{ 'https://image.tmdb.org/t/p/w300' . $anime->banner }}" />
                                <div class="overlay"></div>
                            </div>
                            <div class="episodeInfoContainer">
                                <div class="animeTitle">{{ $anime->name }}</div>
                                <span class="episodeNumber">{{ 'Ep. ' . $episode->number }}</span>
                            </div>
                        </a>
                    @empty
                        {{ 'Aun no hay episodios' }}
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@section('aditionals')


@endsection
