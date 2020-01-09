@extends('adminlte::page')

@section('title', 'Tags')

@section('content_header')
    <div class="p-2">
        <div class="float-left">
            <h2>Tags</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-xs btn-primary btn-" href="{{ route('admin.tags.create') }}">Cadastrar Tag</a>
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
                    <th class="text-center">Slug</th>
                    <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($tags as $tag)
                    <tr class="text-center">
                        <td>{{ $tag->getKey() }}</td>
                        <td>{{ $tag->name }}</td>
                        <td>{{ $tag->slug }}</td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.tags.show', $tag->id) }}">
                                Visualizar
                            </a>
                            <a class="btn btn-xs btn-warning" href="{{ route('admin.tags.edit', $tag->id) }}">
                                Editar
                            </a>
                            <button type="button" class="btn btn-xs btn-danger tag-destroy" data-id="{{ $tag->id }}">
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

            $('.tag-destroy').on('click', function () {
                var tagId = $(this).data('id');
                Swal.fire({
                    title: 'Confirma a exclusão da tag?',
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
                            url: '{{ route('admin.tags.destroy', '_tag') }}'.replace('_tag', tagId),
                            method: 'DELETE',
                            success: function (xhr) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Tag deletada com sucesso!',
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
                                    title: 'Falha ao deletar tag!',
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
