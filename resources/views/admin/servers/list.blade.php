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
                Servidores
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li class="active">Servidores</li>
            </ol>
        </section>
        <section class="content">
            @include('admin.inc.flash-message')
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Listado de servidores</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('admin.servers.create') }}" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> Nuevo
                                </a>
                            </div>
                        </div>
                        <div class="box-body">
                            <table id="dataTable" class="table-bordered table-hover table">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Embed</th>
                                        <th>Estado</th>
                                        <th>Tipo</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($servers as $server)
                                        <tr>
                                            <td>{{ $server->title }}</td>
                                            <td>{{ $server->embed }}</td>
                                            <td>
                                                @php
                                                    $statusLabels = [
                                                        1 => ['class' => 'btn btn-success', 'label' => 'En línea'],
                                                        0 => ['class' => 'btn btn-danger', 'label' => 'Fuera de línea'],
                                                        2 => ['class' => 'btn btn-primary', 'label' => 'Solo Web'],
                                                        3 => ['class' => 'btn btn-info', 'label' => 'Solo App'],
                                                    ];
                                                @endphp

                                                @if (isset($statusLabels[$server->status]))
                                                    <button class="{{ $statusLabels[$server->status]['class'] }}">
                                                        {{ $statusLabels[$server->status]['label'] }}
                                                    </button>
                                                @endif
                                            </td>
                                            <td> @php
                                                $typeLabels = [
                                                    0 => ['class' => 'btn btn-primary', 'label' => 'Link Directo'],
                                                    1 => ['class' => 'btn btn-info', 'label' => 'Iframe'],
                                                    2 => ['class' => 'btn btn-success', 'label' => 'Generado'],
                                                ];
                                            @endphp

                                                @if (isset($typeLabels[$server->type]))
                                                    <button class="{{ $typeLabels[$server->type]['class'] }}">
                                                        {{ $typeLabels[$server->type]['label'] }}
                                                    </button>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.servers.edit', [$server->id]) }}"
                                                    class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger"
                                                    onclick="event.preventDefault();
                                                document.getElementById('delete_{{ $server->id }}').submit();"><i
                                                        class="fa fa-trash"></i></a>
                                                <form id="delete_{{ $server->id }}"
                                                    action="{{ route('admin.servers.destroy', [$server->id]) }}"
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
