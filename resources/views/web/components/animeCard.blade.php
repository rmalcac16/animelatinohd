<div class="animeCard">
    <div class="cover">
        <a title="{{ $anime->name }}" alt="{{ $anime->name }}" href="{{ route('web.anime', [$anime->slug]) }}">
            <div class="image">
                <img alt="{{ $anime->name }}" src="{{ 'https://image.tmdb.org/t/p/w300/' . $anime->poster }}"
                    layout="responsive" loading="lazy">
            </div>
        </a>
        <span class="score">
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
        </span>
    </div>
    <div class="info">
        <h3>
            <a alt="{{ $anime->name }}" title="{{ $anime->name }}" href="{{ route('web.anime', [$anime->slug]) }}">
                <span>{{ $anime->name }}</span>
            </a>
        </h3>
        <p class="year">{{ $date = date_parse(date('Y-m-d', strtotime($anime->aired)))['year'] }}</p>
    </div>
</div>
