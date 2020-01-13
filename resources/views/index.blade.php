@extends('layouts.app')

@section('title', 'LaraHelp - Base de Conhecimento')

@section('promo')
    <section class="duik-promo gradient-primary text-center">
        <div class="container duik-promo-container">
            <div class="d-flex justify-content-center position-relative mh-35rem pt-11 py-6">
                <div class="w-md-75 w-lg-50 mt-10">
                    <h1 class="h2 text-white mb-3">Olá, como podemos ajudar?</h1>

                    <form class="input-group mb-3">
                        <input class="form-control border-0" type="search" placeholder="Buscar">
                        <span class="input-group-append p-0">
                            <button class="btn text-muted" type="submit"><i class="fas fa-search"></i></button>
                        </span>
                    </form>

                    @if(count($popularCategories) > 0)
                        <p class="font-weight-light small text-left">
                            <span class="mr-2">Categorias Populares:</span>
                        @foreach($popularCategories as $category)
                            @if($loop->last)
                                <a class="text-white mr-1" href="#">{{ $category->name }}</a>
                            @else
                                <a class="text-white mr-1" href="#">{{ $category->name }}</a>,
                            @endif
                        @endforeach
                        </p>
                    @endif
                </div>
            </div>
        </div>

        @include('partials.background')
        @include('partials.background-separator')
    </section>
@endsection

@section('content')
<section class="pt-5 pb-11">
    <div class="container">
        <div class="w-md-75 w-lg-50 mx-auto text-center mb-5">
            <h2 class="h3 text-center">Categorias de Artigos</h2>
        </div>

        <div class="row">
            @forelse($categories as $category)
                <div class="col-md-6 mb-5">
                    <div class="media h-100 shadow rounded p-4">
                        <i class="far fa-fw fa-dot-circle fa-3x text-secondary mr-4 mt-1"></i>

                        <div class="media-body">
                            <h5 class="mb-1"><a class="link-dark" href="article.html">{{ $category->name }}</a></h5>
                            <p class="mb-0">{{ $category->articles_count }} artigo(s).</p>
                        </div>
                    </div>
                </div>
            @empty
                <p>Nenhuma categoria de artigo cadastrada.</p>
            @endforelse
        </div>
    </div>
</section>

<section class="py-11 bg-light">
    <div class="container">
        <div class="w-md-75 w-lg-50 mx-auto text-center mb-5">
            <h2 class="h3 text-center">Artigos populares</h2>
            <p>Começe aqui para encontrar as melhores respostas possíveis de nossos especialistas.</p>
        </div>

        @forelse($articles as $article)
            <a class="row border rounded align-items-center justify-content-between py-4 px-3 link-dark link-hover-dark bg-hover-light mx-sm-0 mb-2" href="{{ route('articles.show', ['article' => $article->slug ]) }}">
                <div class="col-sm">
                    {{ $article->title }}
                </div>

                <div class="col-sm-2 text-sm-right text-muted small">
                    {{ date('d/m/Y', strtotime($article->created_at)) }}
                </div>
            </a>
        @empty
        @endforelse

        <div class="text-center mt-5">
            <a class="btn btn-sm btn-outline-primary" href="{{ route('articles.index') }}">Ver Todos os Artigos<i class="fas fa-angle-right ml-2"></i></a>
        </div>
    </div>
</section>
@endsection
