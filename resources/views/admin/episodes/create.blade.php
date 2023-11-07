@extends('admin.layout')

@section('styles')
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Agregar nuevo episodio -
                <small>{{ $anime->name }}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li><a href="{{ route('admin.animes.index') }}"><i class="fa fa-th"></i> Animes</a></li>
                <li><a href="{{ route('admin.animes.episodes.index', ['anime_id' => $anime->id]) }}"><i
                            class="fa fa-list"></i> {{ $anime->name }}</a></li>
                <li><a href=""><i class="fa fa-plus"></i> Agregar episodio</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Agregar episodio</h3>
                        </div>
                        <form role="form" method="POST"
                            action="{{ route('admin.animes.episodes.store', ['anime_id' => $anime->id]) }}">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="number">Número del episodio</label>
                                    <input type="number" min="0" class="form-control" id="number"
                                        placeholder="Ingresa número del episodio" required name="number"
                                        value="{{ old('number') }}">
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">
                                        Agregar
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
