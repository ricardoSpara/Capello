@extends('adminlte::page')

@section('title', 'Cursos')

@section('content_header')
    <h1>Cursos</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-body">
            @include('helpers.errors')
            @include('helpers.success')
            @if(count($courses) > 0)
                <table class="table table-bordered table-hover" id="coursesTable">
                    <thead>
                        <th>Nome</th>
                        @can('isTeacherHigher')
                        <th>Ações</th>
                        @endcan
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                            <tr>
                                <td>{{$course->name}}</td>
                                @can('isTeacherHigher')
                                    <td>
                                        <a class="btn-primary btn btn-sm" href="{{route('courses.edit', ['id' => $course->id])}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <button class="btn-danger btn btn-sm" onclick="mdApprove(`{{route('courses.delete', ['id' => $course->id])}}`, '#deleteCourse')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach   
                    </tbody>
                </table>
            @else
            <h1 class="text-center">Não há cursos cadastrados! <i class="fa fa-thumbs-down" aria-hidden="true"></i></h1>
            @endif
        </div>
    </div>

    <div class="modal modal-danger fade" id="deleteCourse">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Excluir curso</h4>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deseja excluir esse curso?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Fechar</button>
                        <a href="" id="linkRoute"><button type="button" class="btn btn-outline">Excluir</button></a>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
@stop

@section('js')
<script src="{{asset('js/auth.js')}}"></script>
<script src="{{asset('js/jquery.mask.js')}}"></script>
<script src="{{asset('js/masks.js')}}"></script>
<script src="{{asset('js/functions.js')}}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#coursesTable').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
            },
            "columns": [
                null,
                { "orderable": false },
            ]
        });
    });
</script>
@stop