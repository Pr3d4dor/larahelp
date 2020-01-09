@extends('adminlte::page')

@section('title', 'Usuários')

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
                            <button type="button" class="btn btn-xs btn-danger user-destroy" data-id="{{ $user->id }}">
                                Excluir
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
 <script>
     $(function() {
         $('.table').DataTable({
             "columns": [
                 { "orderable": true },
                 { "orderable": true },
                 { "orderable": true },
                 { "orderable": false },
             ]
         });

         $('.user-destroy').on('click', function () {
             var userId = $(this).data('id');
             Swal.fire({
                 title: 'Confirma a exclusão do usuário?',
                 confirmButtonText: 'Confirmar',
                 cancelButtonText: 'Cancelar',
                 showCancelButton: true,
                 showCloseButton: true
             })
             .then((confirm) => {
                 if (!confirm.value) {
                     return;
                 }

                 $.ajax({
                     url: '{{ route('admin.users.destroy', '_user') }}'.replace('_user', userId),
                     method: 'DELETE',
                     success: function (xhr) {
                         Swal.fire({
                             icon: 'success',
                             title: 'Usuário deletado com sucesso!',
                             showConfirmButton: false,
                             timer: 1500
                         })
                         .then(() => {
                             window.location.reload();
                         });
                     },
                     error: function (xhr) {
                         Swal.fire({
                             icon: 'error',
                             title: 'Falha ao deletar usuario!',
                             showConfirmButton: true,
                             timer: 1500
                         });
                     }
                 });
             });
         })
     });
 </script>
@endsection
