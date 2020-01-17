@extends('adminlte::page')

@section('title', 'Visualizar Artigo')

@section('content_header')
    <div class="p-2">
        <h2>Visualizar Artigo</h2>
    </div>
@stop

@section('content')
    <div class="card card-primary p-4">
        <table class="table table-bordered table-striped">
            <tbody>
            <tr>
                <td class="w-50">Título</td>
                <td class="w-50"> {{ $article->title }}</td>
            </tr>
            <tr>
                <td class="w-50">Slug</td>
                <td class="w-50">{{ $article->slug }}</td>
            </tr>
            <tr>
                <td class="w-50">Sumário</td>
                <td class="w-50">{!! $article->summary !!}</td>
            </tr>
            <tr>
                <td class="w-50">Conteúdo</td>
                <td class="w-50">{!! $article->content !!}</td>
            </tr>
            <tr>
                <td class="w-50">Categoria</td>
                <td class="w-50">{{ $article->category->name }}</td>
            </tr>
            <tr>
                <td class="w-50">Tags</td>
                <td class="w-50">
                    @foreach($article->tags as $tag)
                        <span class="badge badge-secondary">{{ $tag->name }}</span>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td class="w-50">Visualizações</td>
                <td class="w-50">{{ $article->view_count }}</td>
            </tr>
            <tr>
                <td class="w-50">Criado em</td>
                <td class="w-50">@formatDate($article->created_at)</td>
            </tr>
            <tr>
                <td class="w-50">Última edição</td>
                <td class="w-50">@formatDate($article->updated_at)</td>
            </tr>
            </tbody>
        </table>

        <div class="mt-3">
            <a href="{{ route('admin.articles.index') }}" class="btn btn-primary">Voltar</a>
        </div>
    </div>
@stop

@section('js')
@endsection
