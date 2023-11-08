<div class="filters">
    <div class="filter">
        <label for="sel_type">Tipo</label>
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
        <label for="sel_status">Estado</label>
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
        <label for="sel_genre">Género</label>
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
        <label for="sel_year">Año</label>
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
            url.searchParams.delete("q");

            window.location.href = url.toString();
        }
    </script>
@endsection
