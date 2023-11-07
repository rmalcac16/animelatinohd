@extends('web.layout')

@section('title', 'Ver Anime Online en HD Sub Español Latino Gratis')

@section('meta')
    <meta name="description"
        content="{{ 'Anime Online Gratis, mira los últimos capitulos de los animes del momento sin ninguna restriccion subtitulados al español latino en ' . config('app.name') }}" />
    <meta name="og:title" content="{{ 'Ver Anime Online en HD Sub Español Latino Gratis • ' . config('app.name') }}" />
    <meta name="og:description"
        content="{{ 'Anime Online Gratis, mira los últimos capitulos de los animes del momento sin ninguna restriccion subtitulados al español latino en ' . config('app.name') }}" />
    <meta name="og:locale" content="es_LA" />
    <meta name="og:type" content="website" />
    <meta name="og:image" content="https://i.imgur.com/Iof3uSm.jpg" />
    <meta property="og:image:width" content="265" />
    <meta property="og:image:height" content="265" />
    <meta itemProp="image" content="https://i.imgur.com/Iof3uSm.jpg" />
@endsection

@section('content')
    <div class="contenedor">
        <div class="title-container">
            <h1 class="title">
                <span>Episodios recientes</span>
            </h1>
        </div>

        <div class="list-items list-items-h">
            @forelse ($episodes as $episode)
                @include('web.components.episodeHome')
            @empty
                {{ 'No hay datos' }}
            @endforelse
        </div>
    </div>
@endsection


@section('aditionals')


@endsection
