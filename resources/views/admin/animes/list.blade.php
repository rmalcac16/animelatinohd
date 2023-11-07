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
                Animes
                <small>Listado de todos los animes</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li class="active">Animes</li>
            </ol>
        </section>
        <section class="content">
            @include('admin.inc.flash-message')
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Listado de animes</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('admin.animes.create') }}" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> Nuevo
                                </a>
                            </div>
                        </div>
                        <div class="box-body">
                            <table id="dataTable" class="table-bordered table-hover table">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Otros</th>
                                        <th>Estreno</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection


@section('aditionals')
    <!-- DataTables -->
    <script src="/assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script>
        $(function() {
            $("#dataTable").DataTable({
                serverSide: true,
                paging: true,
                searching: true,
                ordering: false,
                sortable: false,
                language: {
                    "url": "/assets/bower_components/datatables.net/Spanish.json"
                },
                ajax: '{!! route('admin.animes.datatable.list') !!}',
                columns: [{
                        data: 'name',
                        render: function(data, type, row) {
                            var animeId = row.id;
                            var animeLink = '{!! route('admin.animes.episodes.index', ['anime_id' => ':animeId']) !!}';
                            animeLink = animeLink.replace(':animeId', animeId);
                            return '<a class="truncate" style="max-width: 350px" href="' +
                                animeLink + '">' + data +
                                '</a>';
                        }
                    },
                    {
                        data: 'name_alternative',
                        render: function(data, type, row) {
                            return '<span class="truncate" style="max-width: 350px">' + data +
                                '</span>';
                        }
                    },
                    {
                        data: 'aired',
                    },
                    {
                        data: 'status',
                        render: function(data, type, row) {
                            var statusButton;

                            if (data == 1) {
                                statusButton =
                                    '<button class="btn btn-success">En emisión</button>';
                            } else if (data == 0) {
                                statusButton = '<button class="btn btn-danger">Finalizado</button>';
                            } else {
                                statusButton = '';
                            }

                            return statusButton;
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row) {
                            // Botón de Editar
                            var editButton = '<a href="' +
                                '{{ route('admin.animes.edit', ['anime' => ':id']) }}'.replace(
                                    ':id', row.id) +
                                '" class="btn btn-success"><i class="fa fa-edit"></i></a>';

                            // Botón de Eliminar
                            var deleteButton =
                                '<a class="btn btn-danger" onclick="event.preventDefault(); document.getElementById(\'delete_' +
                                row.id + '\').submit();"><i class="fa fa-trash"></i></a>';

                            // Formulario de Eliminar
                            var deleteForm = '<form id="delete_' + row.id + '" action="' +
                                '{{ route('admin.animes.destroy', ['anime' => ':id']) }}'.replace(
                                    ':id', row.id) +
                                '" method="POST" style="display: none;">@method('DELETE') @csrf</form>';

                            return editButton + ' ' + deleteButton + ' ' + deleteForm;
                        }
                    }

                ],
            });
        });
    </script>
@endsection
