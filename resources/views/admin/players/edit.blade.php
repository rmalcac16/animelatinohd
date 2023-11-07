@extends('admin.layout')

@section('styles')
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Editar Player
                <small>{{ $anime->name . ' ' . $episode->number }}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li><a href="{{ route('admin.animes.index') }}"><i class="fa fa-th"></i> Animes</a></li>
                <li><a href="{{ route('admin.animes.episodes.index', ['anime_id' => $anime->id]) }}"><i
                            class="fa fa-list"></i> {{ $anime->name }}</a></li>
                <li><a
                        href="{{ route('admin.animes.episodes.players.index', ['anime_id' => $anime->id, 'episode_id' => $episode->id]) }}"><i
                            class="fa fa-play"></i> {{ 'Eps. ' . $episode->number }}</a></li>
                <li class="active">Editar Player</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Editar Player</h3>
                        </div>
                        <form role="form" method="POST"
                            action="{{ route('admin.animes.episodes.players.update', ['anime_id' => $anime->id, 'episode_id' => $episode->id, 'player' => $player->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="server_id">Servidor</label>
                                    <select class="form-control" id="server_id" name="server_id">
                                        @foreach ($servers as $server)
                                            <option value="{{ $server->id }}"
                                                {{ $server->id == $player->server_id ? 'selected' : '' }}>
                                                {{ $server->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="code">Código</label>
                                    <input type="text" class="form-control" id="code" name="code"
                                        placeholder="Ingresa el código del player" required value="{{ $player->code }}">
                                </div>
                                <div class="form-group">
                                    <label for="languaje">Idioma</label>
                                    <select class="form-control" id="languaje" name="languaje">
                                        <option value="0" {{ $player->languaje == 0 ? 'selected' : '' }}>Subtitulado
                                        </option>
                                        <option value="1" {{ $player->languaje == 1 ? 'selected' : '' }}>Latino
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">
                                    Actualizar Player
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
