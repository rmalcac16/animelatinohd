@php
    use Carbon\Carbon;
@endphp

<div class="episodeCardHome">
    <div class="holder">
        <div class="overlay">
            <span class="time">{{ Carbon::parse($episode->created_at)->diffForHumans() }}</span>
            <a class="play" alt="{{ $episode->name . ' ' . $episode->number }}"
                title="{{ $episode->name . ' ' . $episode->number }}"
                href="{{ route('web.episode', [$episode->slug, $episode->number]) }}">
                <svg viewBox="0 0 24 24">
                    <path d="M8,5.14V19.14L19,12.14L8,5.14Z"></path>
                </svg>
            </a>
            <a class="cover" alt="{{ $episode->name }}" title="{{ $episode->name }}"
                href="{{ route('web.anime', [$episode->slug]) }}">
                <img alt="{{ $episode->name }}" height="73" width="53"
                    src="{{ 'https://image.tmdb.org/t/p/w154' . $episode->poster }}" loading="lazy">
            </a>
            @if ($episode->languaje == 1)
                <span class="label">Español Latino</span>
            @endif
        </div>
        <img alt="{{ $episode->name . ' ' . $episode->number }}"
            src="{{ 'https://image.tmdb.org/t/p/w300' . $episode->banner }}" loading="lazy">
    </div>
    <div class="text">
        <a class="title" alt="{{ $episode->name . ' ' . $episode->number }}"
            title="{{ $episode->name . ' ' . $episode->number }}"
            href="{{ route('web.episode', [$episode->slug, $episode->number]) }}">
            <div class="limit">{{ $episode->name }}</div>
            <span class="episode">{{ 'Ep. ' . $episode->number }}</span>
        </a>
    </div>
</div>
