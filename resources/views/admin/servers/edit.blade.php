@extends('admin.layout')

@section('styles')
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Servidores
                <small>Editar servidor</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li><a href="{{ route('admin.servers.index') }}"><i class="fa fa-th"></i> Servidores</a></li>
                <li class="active">Editar</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Editar servidor</h3>
                        </div>
                        <form role="form" method="POST" action="{{ route('admin.servers.update', $server->id) }}">
                            @csrf
                            @method('PUT')
                            <!-- Método PUT para enviar el formulario como actualización -->
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="title">Título</label>
                                    <input type="text" class="form-control" id="title"
                                        placeholder="Ingresa título del servidor" required name="title"
                                        value="{{ $server->title }}" />
                                </div>
                                <div class="form-group">
                                    <label for="embed">Embed</label>
                                    <input type="text" class="form-control" id="embed" placeholder="Ingresa embed"
                                        name="embed" value="{{ $server->embed }}" />
                                </div>
                                <div class="form-group">
                                    <label for="type">Tipo</label>
                                    <select class="form-control" id="type" name="type">
                                        <option value="0" @if ($server->type === 0) selected @endif>Link
                                            Directo</option>
                                        <option value="1" @if ($server->type === 1) selected @endif>Iframe
                                        </option>
                                        <option value="2" @if ($server->type === 2) selected @endif>Genreado
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Estado</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="0" @if ($server->status === 0) selected @endif>Fuera de
                                            línea</option>
                                        <option value="1" @if ($server->status === 1) selected @endif>En línea
                                        </option>
                                        <option value="2" @if ($server->status === 2) selected @endif>Solo Web
                                        </option>
                                        <option value="3" @if ($server->status === 3) selected @endif>Solo App
                                        </option>
                                    </select>
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
@endsection
