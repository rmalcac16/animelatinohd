<a class="episodeContainer" href="{{ route('web.episode', [$anime->slug, $episode->number]) }}">
    <div class="episodeImageContainer">
        <img alt="{{ $anime->name . ' Capítulo ' . $episode->number }}"
            src="{{ 'https://image.tmdb.org/t/p/w300' . $anime->banner }}" layout="responsive" loading="lazy" />
        <div class="overlay"></div>
    </div>
    <div class="episodeInfoContainer">
        <div class="animeTitle">{{ $anime->name }}</div>
        <span class="episodeNumber">{{ 'Ep. ' . $episode->number }}</span>
    </div>
</a>
