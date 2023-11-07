@extends('admin.layout')

@section('styles')
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Generos
                <small>Editar género</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li><a href="{{ route('admin.genres.index') }}"><i class="fa fa-th"></i> Generos</a></li>
                <li class="active">Editar</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Editar género</h3>
                        </div>
                        <form role="form" method="POST" action="{{ route('admin.genres.update', $genre->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="title">Titulo del género</label>
                                    <input type="text" class="form-control" id="title"
                                        placeholder="Ingresa titulo del género" required name="title"
                                        value="{{ $genre->title }}">
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">
                                        Actualizar
                                    </button>
                                </div>
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
