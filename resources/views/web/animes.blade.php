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


@section('content')
    <div class="contenedor">

        <h1 class="title">
            <span>{{ $title }}</span>
            <small>{{ $subtitle }}</small>
        </h1>

        @if ($filter)
            @include('web.inc.filter')
        @endif
        <div class="list-animes">
            @forelse ($animes as $anime)
                @include('web.components.animeCard')
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
