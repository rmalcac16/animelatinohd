<div class="searchContainer">
    <svg id="searchIcon" viewBox="0 0 24 24">
        <path
            d="M13.262,14.868l2.479,2.478c-0.376,0.725-0.415,1.445-0.017,1.843l4.525,4.526 c0.571,0.571,1.812,0.257,2.768-0.7c0.956-0.955,1.269-2.195,0.697-2.766l-4.524-4.526c-0.399-0.398-1.119-0.36-1.842,0.016 l-2.48-2.478L13.262,14.868z M8.5,0C3.806,0,0,3.806,0,8.5C0,13.194,3.806,17,8.5,17S17,13.194,17,8.5C17,3.806,13.194,0,8.5,0z M8.5,15C4.91,15,2,12.09,2,8.5S4.91,2,8.5,2S15,4.91,15,8.5S12.09,15,8.5,15z">
        </path>
    </svg>
    <div id="search" class="search" style="display: none">
        <form method="GET" action="/animes" class="inputContainer">
            <input name="q" class="input" type="text" placeholder="Buscar..."><label
                for="search">Buscar</label>
        </form>
        <div id="close" class="close"><svg viewBox="0 0 24 24">
                <path
                    d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z">
                </path>
            </svg></div>
        <div class="results">
            {{-- <a class="result" alt="Tensei shitara Slime Datta Ken: Coleus no Yume"
                title="Tensei shitara Slime Datta Ken: Coleus no Yume"
                href="/anime/tensei-shitara-slime-datta-ken-coleus-no-yume">
                <div><img class="poster" alt="Tensei shitara Slime Datta Ken: Coleus no Yume" height="50"
                        width="40" loading="lazy"
                        src="{{ 'https://image.tmdb.org/t/p/w92/7DpYf5vE53kzHTpCfHHc1bmVxP0.jpg' }}"></div>
                <div class="content">
                    <p class="title">Tensei shitara Slime Datta Ken: Coleus no Yume</p>
                    <p class="type">OVA</p>
                </div>
            </a> --}}
            <div class="empty"></div>
        </div>
    </div>
</div>


<script>
    document.getElementById('searchIcon').addEventListener('click', function() {
        var searchContainer = document.getElementById('search');
        if (searchContainer.style.display === 'none') {
            searchContainer.style.display = 'flex';
        } else {
            searchContainer.style.display = 'none';
        }
    });

    document.getElementById('close').addEventListener('click', function() {
        var searchContainer = document.getElementById('search');
        searchContainer.style.display = 'none';
    });
</script>
