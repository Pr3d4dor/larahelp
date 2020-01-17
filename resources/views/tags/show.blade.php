@extends('layouts.app')

@section('title', 'LaraHelp - ' . $tag->name)

@section('promo')
    <section class="duik-promo bg-primary">
        <div class="container duik-promo-container">
            <div class="d-flex position-relative mh-25rem pt-11 py-6">
                <div class="align-self-center">
                    <h1 class="text-white font-weight-light mb-3">Artigos com a Tag: {{ $tag->name }}</h1>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-light">
                            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                            <li class="breadcrumb-item">Tags</li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $tag->name }}</li>
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
            <div class="col-lg-8 pr-lg-6">
                <div>
                    <form method="GET" action="{{ route('tags.show', $tag->slug) }}" class="mb-3">
                        <div class="form-group input-group">
                            <input name="search" class="form-control border-0 bg-light" type="search" placeholder="Buscar" value="{{ request()->query('search') ?? '' }}">
                            <span class="input-group-append p-0">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>

                        <div class="form-group input-group">
                            <div class="col-6">
                                <select class="form-control select2 mr-4" name="category_id" id="category_id">
                                    <option value="">Selecione uma categoria</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->getKey() }}" {{ request()->get('category_id') == $category->getKey() ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-xs btn-primary">Buscar</button>
                    </form>
                </div>

                @forelse($articles as $article)
                    @include('partials.article', $article)
                @empty
                    <p>Nenhum artigo encontrado.</p>
                @endforelse

                <div class="d-flex justify-content-center text-center">
                    {{ $articles->appends(request()->query())->links() }}
                </div>
            </div>

            @include('partials.sidebar')
        </div>
    </div>
@endsection
