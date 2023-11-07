@extends('admin.layout')

@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" />
    <style>
        .truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            display: inline-block;
            white-space: nowrap;
            max-width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Episodios -
                <small>{{ $anime->name }}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li><a href="{{ route('admin.animes.index') }}"><i class="fa fa-th"></i> Animes</a></li>
                <li class="active">{{ $anime->name }}</li>
            </ol>
        </section>
        <section class="content">
            @include('admin.inc.flash-message')
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Listado de episodios</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('admin.animes.episodes.create', [$anime->id]) }}" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> Nuevo
                                </a>
                            </div>
                        </div>
                        <div class="box-body">
                            <table id="dataTable" class="table-bordered table-hover table">
                                <thead>
                                    <tr>
                                        <th>Numero</th>
                                        <th>Fecha de estreno</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($episodes as $episode)
                                        <tr>
                                            <td><a
                                                    href="{{ route('admin.animes.episodes.players.index', ['anime_id' => $anime->id, 'episode_id' => $episode->id]) }}">{{ $anime->name . ' ' . $episode->number }}</a>
                                            </td>
                                            <td>{{ $episode->created_at }}</td>
                                            <td>
                                                <a href="{{ route('admin.animes.episodes.edit', ['anime_id' => $anime->id, 'episode' => $episode->id]) }}"
                                                    class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger"
                                                    onclick="event.preventDefault();
                                                document.getElementById('delete_{{ $episode->id }}').submit();"><i
                                                        class="fa fa-trash"></i></a>
                                                <form id="delete_{{ $episode->id }}"
                                                    action="{{ route('admin.animes.episodes.destroy', ['anime_id' => $anime->id, 'episode' => $episode->id]) }}"
                                                    method="POST" style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" style="text-align: center; padding: 20px;">
                                                <strong>No hay datos</strong>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection


@section('aditionals')
    <!-- DataTables -->
    <script src="/assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script>
        $(function() {
            $("#dataTable").DataTable({
                paging: true,
                searching: true,
                ordering: false,
                sortable: false,
                language: {
                    "url": "/assets/bower_components/datatables.net/Spanish.json"
                },
            });
        });
    </script>
@endsection
