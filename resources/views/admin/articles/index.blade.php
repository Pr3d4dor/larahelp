@extends('adminlte::page')

@section('title', 'Artigos')

@section('content_header')
    <div class="p-2">
        <div class="float-left">
            <h2>Artigos</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-xs btn-primary btn-" href="{{ route('admin.articles.create') }}">Cadastrar Artigo</a>
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
                    <th class="text-center">Título</th>
                    <th class="text-center">Slug</th>
                    <th class="text-center">Sumário</th>
                    <th class="text-center">Categoria</th>
                    <th class="text-center">Tags</th>
                    <th class="text-center">Visualizações</th>
                    <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($articles as $article)
                    <tr class="text-center">
                        <td>{{ $article->getKey() }}</td>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->slug }}
                        <td>{!! $article->summary !!}</td>
                        <td>
                            <span class="badge badge-secondary">{{ $article->category->name }}</span>
                        </td>
                        <td>
                            @forelse($article->tags as $tag)
                                <span class="badge badge-secondary">{{ $tag->name }}</span>
                            @empty
                                <span>Nenhuma</span>
                            @endforelse
                        </td>
                        <td>{{ $article->view_count }}</td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.articles.show', $article->id) }}">
                                Visualizar
                            </a>
                            <a class="btn btn-xs btn-warning" href="{{ route('admin.articles.edit', $article->id) }}">
                                Editar
                            </a>
                            <button type="button" class="btn btn-xs btn-danger article-destroy" data-id="{{ $article->id }}">
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
            $('.table').DataTable();

            $('.article-destroy').on('click', function () {
                var articleId = $(this).data('id');
                Swal.fire({
                    title: 'Confirma a exclusão do artigo?',
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
                            url: '{{ route('admin.articles.destroy', '_article') }}'.replace('_article', articleId),
                            method: 'DELETE',
                            success: function (xhr) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Artigo deletado com sucesso!',
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
                                    title: 'Falha ao deletar artigo!',
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
