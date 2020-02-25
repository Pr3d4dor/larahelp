@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
    <div class="p-2">
        <div class="float-left">
            <h2>Categorias</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-xs btn-primary btn-" href="{{ route('admin.categories.create') }}">Criar Categoria</a>
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
                @foreach ($categories as $category)
                    <tr class="text-center">
                        <td>{{ $category->getKey() }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.categories.show', $category->id) }}">
                                Visualizar
                            </a>
                            <a class="btn btn-xs btn-warning" href="{{ route('admin.categories.edit', $category->id) }}">
                                Editar
                            </a>
                            <button type="button" class="btn btn-xs btn-danger category-destroy" data-id="{{ $category->id }}">
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

            $('.category-destroy').on('click', function () {
                var categoryId = $(this).data('id');
                Swal.fire({
                    title: 'Confirma a exclusão da categoria?',
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
                            url: '{{ route('admin.categories.destroy', '_category') }}'.replace('_category', categoryId),
                            method: 'DELETE',
                            success: function (xhr) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Categoria deletada com sucesso!',
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
                                    title: 'Falha ao deletar categoria!',
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
