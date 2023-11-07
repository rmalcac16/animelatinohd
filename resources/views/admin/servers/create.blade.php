@extends('admin.layout')

@section('styles')
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Servidores
                <small>Crear nuevo servidor</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li><a href="{{ route('admin.servers.index') }}"><i class="fa fa-th"></i> Servidores</a></li>
                <li class="active">Crear</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Nuevo servidor</h3>
                        </div>
                        <form role="form" method="POST" action="{{ route('admin.servers.store') }}">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="title">Título</label>
                                    <input type="text" class="form-control" id="title"
                                        placeholder="Ingresa título del servidor" required name="title" />
                                </div>
                                <div class="form-group">
                                    <label for="embed">Embed</label>
                                    <input type="text" class="form-control" id="embed" placeholder="Ingresa embed"
                                        name="embed" />
                                </div>
                                <div class="form-group">
                                    <label for="type">Tipo</label>
                                    <select class="form-control" id="type" name="type">
                                        <option value="0">Link Directo</option>
                                        <option value="1">Iframe</option>
                                        <option value="2">Generado</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Estado</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="1">En línea</option>
                                        <option value="0">Fuera de línea</option>
                                        <option value="2">Solo Web</option>
                                        <option value="3">Solo App</option>
                                    </select>
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
@endsection
