@extends('adminlte::page')

@section('title', 'Perguntas Frequentes')

@section('content_header')
    <div class="p-2">
        <div class="float-left">
            <h2>Perguntas Frequentes</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-xs btn-primary btn-" href="{{ route('admin.faq_questions.create') }}">Cadastrar Pergunta Frequente</a>
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
                    <th class="text-center">Pergunta</th>
                    <th class="text-center">Resposta</th>
                    <th class="text-center">Categoria</th>
                    <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($faqQuestions as $faqQuestion)
                    <tr class="text-center">
                        <td>{{ $faqQuestion->getKey() }}</td>
                        <td>{{ $faqQuestion->content }}</td>
                        <td>{{ $faqQuestion->answer }}</td>
                        <td>{{ $faqQuestion->faqCategory->name }}</td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.faq_questions.show', $faqQuestion->id) }}">
                                Visualizar
                            </a>
                            <a class="btn btn-xs btn-warning" href="{{ route('admin.faq_questions.edit', $faqQuestion->id) }}">
                                Editar
                            </a>
                            <button type="button" class="btn btn-xs btn-danger faq-question-destroy" data-id="{{ $faqQuestion->id }}">
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
            $('.table').DataTable({});

            $('.faq-question-destroy').on('click', function () {
                var faqQuestionId = $(this).data('id');
                Swal.fire({
                    title: 'Confirma a exclusão da pergunta?',
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
                            url: '{{ route('admin.faq_questions.destroy', '_faq_category') }}'.replace('_faq_category', faqQuestionId),
                            method: 'DELETE',
                            success: function (xhr) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Pergunta deletada com sucesso!',
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
                                    title: 'Falha ao deletar pergunta!',
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
