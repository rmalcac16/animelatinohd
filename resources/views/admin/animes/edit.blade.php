@extends('admin.layout')

@section('styles')
    <link rel="stylesheet" href="/assets/bower_components/select2/dist/css/select2.min.css">
    <style>
        .select2-container {
            width: 100% !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #3c8dbc !important;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Animes
                <small>Editar anime</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li><a href="{{ route('admin.animes.index') }}"><i class="fa fa-th"></i> Animes</a></li>
                <li><a href="#"><i class="fa fa-list"></i> {{ $anime->name }}</a></li>
                <li class="active">Editar</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Editar anime</h3>
                        </div>
                        <form role="form" method="POST" action="{{ route('admin.animes.update', $anime->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" class="form-control" id="name"
                                        placeholder="Ingresa nombre del anime" required name="name"
                                        value="{{ $anime->name }}" />
                                </div>
                                <div class="form-group">
                                    <label for="name_alternative">Nombre Alternativo</label>
                                    <input type="text" class="form-control" id="name_alternative"
                                        placeholder="Ingresa nombre alternativo del anime" name="name_alternative"
                                        value="{{ $anime->name_alternative }}" />
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="type">Tipo</label>
                                            <select class="form-control" id="type" name="type">
                                                <option value="TV" {{ $anime->type === 'TV' ? 'selected' : '' }}>Anime
                                                </option>
                                                <option value="Movie" {{ $anime->type === 'Movie' ? 'selected' : '' }}>
                                                    Película</option>
                                                <option value="Special" {{ $anime->type === 'Special' ? 'selected' : '' }}>
                                                    Especial</option>
                                                <option value="Ova" {{ $anime->type === 'Ova' ? 'selected' : '' }}>Ova
                                                </option>
                                                <option value="Ona" {{ $anime->type === 'Ona' ? 'selected' : '' }}>Ona
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="status">Estado</label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="1" {{ $anime->status == 1 ? 'selected' : '' }}>En
                                                    Emisión</option>
                                                <option value="0" {{ $anime->status == 0 ? 'selected' : '' }}>
                                                    Finalizado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="aired">Estreno</label>
                                            <input type="date" class="form-control" id="aired"
                                                placeholder="Ingresa fecha de estreno" name="aired"
                                                value="{{ $anime->aired }}" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="broadcast">Día</label>
                                            <select class="form-control" id="broadcast" name="broadcast">
                                                <option value="1" {{ $anime->broadcast == 1 ? 'selected' : '' }}>
                                                    Lunes</option>
                                                <option value="2" {{ $anime->broadcast == 2 ? 'selected' : '' }}>
                                                    Martes</option>
                                                <option value="3" {{ $anime->broadcast == 3 ? 'selected' : '' }}>
                                                    Miércoles</option>
                                                <option value="4" {{ $anime->broadcast == 4 ? 'selected' : '' }}>
                                                    Jueves</option>
                                                <option value="5" {{ $anime->broadcast == 5 ? 'selected' : '' }}>
                                                    Viernes</option>
                                                <option value="6" {{ $anime->broadcast == 6 ? 'selected' : '' }}>
                                                    Sábado</option>
                                                <option value="7" {{ $anime->broadcast == 7 ? 'selected' : '' }}>
                                                    Domingo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="banner">Fondo</label>
                                    <input type="text" class="form-control" id="banner" name="banner"
                                        placeholder="Ingresa la URL de fondo del anime" value="{{ $anime->banner }}" />
                                </div>
                                <div class="form-group">
                                    <label for="poster">Poster</label>
                                    <input type="text" class="form-control" id="poster" name="poster"
                                        placeholder="Ingresa la URL de poster del anime" value="{{ $anime->poster }}" />
                                </div>
                                <div class="form-group">
                                    <label for="overview">Sinopsis</label>
                                    <textarea class="form-control" id="overview" name="overview" rows="4">{{ $anime->overview }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="premiered">Temporada</label>
                                    <input type="text" class="form-control" id="premiered"
                                        placeholder="Ingresa temporada" name="premiered"
                                        value="{{ $anime->premiered }}" />
                                </div>

                                <div class="form-group">
                                    <label for="genres">Generos</label>
                                    <select class="form-control select2" multiple="multiple"
                                        data-placeholder="Selecciona los generos" id="genres" name="genres[]">
                                        @foreach ($genres as $genre)
                                            @php
                                                $genreSlugs = explode(',', $anime->genres);
                                            @endphp
                                            <option value="{{ $genre->slug }}"
                                                @if (in_array($genre->slug, $genreSlugs)) selected @endif>{{ $genre->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="rating">Clasificación</label>
                                    <input type="text" class="form-control" id="rating" name="rating"
                                        placeholder="Clasificación del anime" value="{{ $anime->rating }}">
                                </div>
                                <div class="form-group">
                                    <label for="popularity">Popularidad</label>
                                    <input min="0" type="number" class="form-control" id="popularity"
                                        name="popularity" placeholder="Popularidad del anime"
                                        value="{{ $anime->popularity }}">
                                </div>
                                <div class="form-group">
                                    <label for="vote_average">Promedio de votos</label>
                                    <input min="0" max="10" step="0.01" type="number"
                                        class="form-control" id="vote_average" name="vote_average"
                                        placeholder="Promedio de votos del anime" value="{{ $anime->vote_average }}">
                                </div>
                                <div class="form-group">
                                    <label for="trailer">Trailer</label>
                                    <input type="text" class="form-control" id="trailer" name="trailer"
                                        placeholder="Trailer del anime" value="{{ $anime->trailer }}">
                                </div>
                                <div class="form-group">
                                    <label for="slug_flv">Slug AnimeFLV</label>
                                    <input type="text" class="form-control" id="slug_flv" name="slug_flv"
                                        placeholder="Slug AnimeFLV" value="{{ $anime->slug_flv }}">
                                </div>
                                <div class="form-group">
                                    <label for="slug_tio">Slug TioAnime</label>
                                    <input type="text" class="form-control" id="slug_tio" name="slug_tio"
                                        placeholder="Slug TioAnime" value="{{ $anime->slug_tio }}">
                                </div>
                                <div class="form-group">
                                    <label for="slug_jk">Slug JkAnime</label>
                                    <input type="text" class="form-control" id="slug_jk" name="slug_jk"
                                        placeholder="Slug JkAnime" value="{{ $anime->slug_jk }}">
                                </div>
                                <div class="form-group">
                                    <label for="slug_monos">Slug MonosChinos</label>
                                    <input type="text" class="form-control" id="slug_monos" name="slug_monos"
                                        placeholder="Slug MonosChinos" value="{{ $anime->slug_monos }}">
                                </div>
                                <div class="form-group">
                                    <label for="slug_fenix">Slug AnimeFenix</label>
                                    <input type="text" class="form-control" id="slug_fenix" name="slug_fenix"
                                        placeholder="Slug AnimeFenix" value="{{ $anime->slug_fenix }}">
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">
                                    Actualizar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('aditionals')
    <script src="/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script>
        $('.select2').select2()
    </script>
@endsection
