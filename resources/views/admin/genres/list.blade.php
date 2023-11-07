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
                Generos
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li class="active">Generos</li>
            </ol>
        </section>
        <section class="content">
            @include('admin.inc.flash-message')
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Listado de generos</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('admin.genres.create') }}" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> Nuevo
                                </a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="dataTable" class="table-bordered table-hover table">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($genres as $genre)
                                        <tr>
                                            <td>{{ $genre->title }}</td>
                                            <td>
                                                <a href="{{ route('admin.genres.edit', [$genre->id]) }}"
                                                    class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger"
                                                    onclick="event.preventDefault();
                                                document.getElementById('delete_{{ $genre->id }}').submit();"><i
                                                        class="fa fa-trash"></i></a>
                                                <form id="delete_{{ $genre->id }}"
                                                    action="{{ route('admin.genres.destroy', [$genre->id]) }}"
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
