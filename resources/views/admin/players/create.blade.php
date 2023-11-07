@extends('admin.layout')

@section('styles')
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Agregar nuevo Reproductor
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li><a href="{{ route('admin.animes.index') }}"><i class="fa fa-th"></i> Animes</a></li>
                <li><a href="{{ route('admin.animes.episodes.index', ['anime_id' => $anime->id]) }}"><i
                            class="fa fa-list"></i> {{ $anime->name }}</a></li>
                <li><a
                        href="{{ route('admin.animes.episodes.players.index', ['anime_id' => $anime->id, 'episode_id' => $episode->id]) }}"><i
                            class="fa fa-play"></i> {{ 'Eps. ' . $episode->number }}</a></li>
                <li class="active">Nuevo Player</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Agregar nuevo Player</h3>
                        </div>
                        <form role="form" method="POST"
                            action="{{ route('admin.animes.episodes.players.store', ['anime_id' => $anime->id, 'episode_id' => $episode->id]) }}">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="server_id">Servidor</label>
                                    <select class="form-control" id="server_id" name="server_id">
                                        @foreach ($servers as $server)
                                            <option value="{{ $server->id }}">{{ $server->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="code">Código</label>
                                    <input type="text" class="form-control" id="code" name="code"
                                        placeholder="Ingresa el código del player" required>
                                </div>
                                <div class="form-group">
                                    <label for="languaje">Idioma</label>
                                    <select class="form-control" id="languaje" name="languaje">
                                        <option value="0">Subtitulado</option>
                                        <option value="1">Latino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">
                                    Agregar Player
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
@endsection
