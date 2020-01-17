@extends('layouts.app')

@section('title', 'LaraHelp - Artigos')

@section('promo')
    <section class="duik-promo bg-primary">
        <div class="container duik-promo-container">
            <div class="d-flex position-relative mh-25rem pt-11 py-6">
                <div class="align-self-center">
                    <h1 class="text-white font-weight-light mb-3">Artigos</h1>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-light">
                            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Artigos</li>
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
                    <form method="GET" action="{{ route('articles.index') }}" class="mb-3">
                        <div class="form-group input-group">
                            <input name="search" class="form-control border-0 bg-light" type="search" placeholder="Buscar" value="{{ request()->query('search') ?? '' }}">
                            <span class="input-group-append p-0">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>

                        <div class="form-group input-group d-flex justify-content-between">
                            <div class="w-45">
                                <label for="category_id">
                                    Categoria:
                                </label>
                                <select class="form-control select2" name="category_id" id="category_id">
                                    <option value=""></option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->getKey() }}" {{ request()->get('category_id') == $category->getKey() ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="w-45">
                                <label for="tags">
                                    Tags:
                                </label>
                                <select class="form-control select2" name="tags[]" id="tags" multiple>
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->getKey() }}" {{ in_array($tag->getKey(), request()->get('tags') ?? []) ? 'selected' : '' }}>{{ $tag->name }}</option>
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
