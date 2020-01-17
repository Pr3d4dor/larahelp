@extends('layouts.app')

@section('title', 'LaraHelp - ' . $article->title)

@section('promo')
    <section class="duik-promo bg-primary">
        <div class="container duik-promo-container">
            <div class="d-flex position-relative mh-25rem pt-11 py-6">
                <div class="align-self-center">
                    <h1 class="text-white font-weight-light mb-3">{{ $article->title }}</h1>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-light">
                            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">Artigos</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $article->title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @include('partials.background')
    </section>
@endsection

@section('content')
    <div class="container py-10">
        <div class="row">
            <div class="col-lg-8 mb-11 mb-lg-4 pr-lg-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3>{{ $article->title }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <span>
                                <i class="fa fa-folder mr-1"></i><strong>Categoria:</strong>
                                <a href="{{ route('categories.show', $article->category->slug) }}">
                                    {{ $article->category->name }}
                                </a>
                            </span>
                        </div>

                        <h2>Sumário</h2>
                        {!! $article->summary !!}
                        <h2 class="mt-4">Conteúdo</h2>
                        {!! $article->content !!}

                        <div class="mt-4">
                            <span>
                                <i class="fa fa-edit mr-1"></i><strong>Postado em:</strong> {{ date('d/m/Y H:s', strtotime($article->created_at)) }}
                            </span>
                            <span class="float-right">
                                <i class="fa fa-edit mr-1"></i><strong>Última atualização:</strong> {{ date('d/m/Y H:s', strtotime($article->updated_at)) }}
                            </span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div>
                            <i class="fa fa-tags mr-1"></i><span>Tags: </span>
                            @forelse($article->tags as $tag)
                                <a href="{{ route('tags.show', $tag->slug) }}" class="a-no-border">
                                    <span class="badge badge-secondary">{{ $tag->name }}</span>
                                </a>
                            @empty
                                <span>Nenhuma.</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            @include('partials.sidebar')
        </div>
    </div>
@endsection
