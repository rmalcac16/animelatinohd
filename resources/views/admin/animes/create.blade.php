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
                <small>Crear nuevo anime</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li><a href="{{ route('admin.animes.index') }}"><i class="fa fa-th"></i> Animes</a></li>
                <li class="active">Crear</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Nuevo anime</h3>
                        </div>
                        <form role="form" method="POST" action="{{ route('admin.animes.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" class="form-control" id="name"
                                        placeholder="Ingresa nombre del anime" required name="name" />
                                </div>
                                <div class="form-group">
                                    <label for="name_alternative">Nombre Alternativo</label>
                                    <input type="text" class="form-control" id="name_alternative"
                                        placeholder="Ingresa nombre alternativo del anime" name="name_alternative" />
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="type">Tipo</label>
                                            <select class="form-control" id="type" name="type">
                                                <option value="TV">Anime</option>
                                                <option value="Movie">Película</option>
                                                <option value="Special">Especial</option>
                                                <option value="Ova">Ova</option>
                                                <option value="Ona">Ona</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="status">Estado</label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="1">En Emisión</option>
                                                <option value="0">Finalizado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="aired">Estreno</label>
                                            <input type="date" class="form-control" id="aired"
                                                placeholder="Ingresa fecha de estreno" name="aired" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="broadcast">Día</label>
                                            <select class="form-control" id="broadcast" name="broadcast">
                                                <option value="1">Lunes</option>
                                                <option value="2">Martes</option>
                                                <option value="3">Miércoles</option>
                                                <option value="4">Jueves</option>
                                                <option value="5">Viernes</option>
                                                <option value="6">Sábado</option>
                                                <option value="7">Domingo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="banner">Fondo</label>
                                    <input type="text" class="form-control" id="banner" name="banner"
                                        placeholder="Ingresa la URL de fondo del anime" />
                                </div>
                                <div class="form-group">
                                    <label for="poster">Poster</label>
                                    <input type="text" class="form-control" id="poster" name="poster"
                                        placeholder="Ingresa la URL de poster del anime" />
                                </div>
                                <div class="form-group">
                                    <label for="overview">Sinopsis</label>
                                    <textarea class="form-control" id="overview" name="overview" rows="4"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="premiered">Temporada</label>
                                    <input type="text" class="form-control" id="premiered"
                                        placeholder="Ingresa temporada" name="premiered" />
                                </div>

                                <div class="form-group">
                                    <label for="genres">Generos</label>
                                    <select class="form-control select2" multiple="multiple"
                                        data-placeholder="Selecciona los generos" id="genres" name="genres[]">
                                        @foreach ($genres as $genre)
                                            <option value="{{ $genre->slug }}">{{ $genre->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="rating">Clasificación</label>
                                    <input type="text" class="form-control" id="rating" name="rating"
                                        placeholder="Clasificación del anime">
                                </div>
                                <div class="form-group">
                                    <label for="popularity">Popularidad</label>
                                    <input min="0" type="number" class="form-control" id="popularity"
                                        name="popularity" placeholder="Popularidad del anime">
                                </div>
                                <div class="form-group">
                                    <label for="vote_average">Promedio de votos</label>
                                    <input min="0" max="10" step="0.01" type="number"
                                        class="form-control" id="vote_average" name="vote_average"
                                        placeholder="Promedio de votos del anime">
                                </div>
                                <div class="form-group">
                                    <label for="trailer">Trailer</label>
                                    <input type="text" class="form-control" id="trailer" name="trailer"
                                        placeholder="Trailer del anime">
                                </div>
                                <div class="form-group">
                                    <label for="slug_flv">Slug AnimeFLV</label>
                                    <input type="text" class="form-control" id="slug_flv" name="slug_flv"
                                        placeholder="Slug AnimeFLV" value="">
                                </div>
                                <div class="form-group">
                                    <label for="slug_tio">Slug TioAnime</label>
                                    <input type="text" class="form-control" id="slug_tio" name="slug_tio"
                                        placeholder="Slug TioAnime" value="">
                                </div>
                                <div class="form-group">
                                    <label for="slug_jk">Slug JkAnime</label>
                                    <input type="text" class="form-control" id="slug_jk" name="slug_jk"
                                        placeholder="Slug JkAnime" value="">
                                </div>
                                <div class="form-group">
                                    <label for="slug_monos">Slug MonosChinos</label>
                                    <input type="text" class="form-control" id="slug_monos" name="slug_monos"
                                        placeholder="Slug MonosChinos" value="">
                                </div>
                                <div class="form-group">
                                    <label for="slug_fenix">Slug AnimeFenix</label>
                                    <input type="text" class="form-control" id="slug_fenix" name="slug_fenix"
                                        placeholder="Slug AnimeFenix" value="">
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">
                                    Agregar
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
