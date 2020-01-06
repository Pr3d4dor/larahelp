@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="p-2">
        <div class="float-left">
            <h2>Usuários</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-xs btn-primary btn-" href="{{ route('admin.users.create') }}">Cadastrar usuário</a>
        </div>
    </div>
@stop

@section('content')
    <div class="box p-2">
        <!-- /.box-header -->
        <div class="box-body mt-4">
            <table class="table table-bordered table-condensed">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Nome</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr class="text-center">
                        <td>{{ $user->getKey() }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.users.show', $user->id) }}">
                                Visualizar
                            </a>
                            <a class="btn btn-xs btn-warning" href="{{ route('admin.users.edit', $user->id) }}">
                                Editar
                            </a>
                            <a class="btn btn-xs btn-danger user-destroy" data-id="{{ $user->id }}">
                                Excluir
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
{{--        <div class="box-footer">--}}
{{--            <div class="row align-items-center justify-content-center">--}}
{{--                {{ $users->links() }}--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
@stop

@section('js')
 <script>
     $(function() {
         $('.table').DataTable({
             "language": {
                 "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese.json"
             },
             "columns": [
                 { "orderable": true },
                 { "orderable": true },
                 { "orderable": true },
                 { "orderable": false },
             ]
         });
     });
 </script>
@endsection
