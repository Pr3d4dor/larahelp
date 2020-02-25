@extends('adminlte::page')

@section('title', 'Categorias de Perguntas Frequentes')

@section('content_header')
    <div class="p-2">
        <div class="float-left">
            <h2>Categorias de Perguntas Frequentes</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-xs btn-primary btn-" href="{{ route('admin.faq_categories.create') }}">Criar Categoria</a>
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
                    <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($faqCategories as $faqCategory)
                    <tr class="text-center">
                        <td>{{ $faqCategory->getKey() }}</td>
                        <td>{{ $faqCategory->name }}</td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.faq_categories.show', $faqCategory->id) }}">
                                Visualizar
                            </a>
                            <a class="btn btn-xs btn-warning" href="{{ route('admin.faq_categories.edit', $faqCategory->id) }}">
                                Editar
                            </a>
                            <button type="button" class="btn btn-xs btn-danger faq-category-destroy" data-id="{{ $faqCategory->id }}">
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
                    { "orderable": false },
                ]
            });

            $('.faq-category-destroy').on('click', function () {
                var faqCategoryId = $(this).data('id');
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
                            url: '{{ route('admin.faq_categories.destroy', '_faq_category') }}'.replace('_faq_category', faqCategoryId),
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
