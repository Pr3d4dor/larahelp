@extends('layouts.app')

@section('title', 'LaraHelp - Tags')

@section('promo')
    <section class="duik-promo bg-primary">
        <div class="container duik-promo-container">
            <div class="d-flex position-relative mh-25rem pt-11 py-6">
                <div class="align-self-center">
                    <h1 class="text-white font-weight-light mb-3">Tags</h1>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-light">
                            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tags</li>
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
                <div class="w-md-75 w-lg-50 mx-auto text-center mb-5">
                    <h2 class="h3 text-center">Tags de Artigos</h2>
                </div>

                <div class="row">
                    @forelse($tags as $tag)
                        <div class="col-md-6 mb-5">
                            <div class="media h-100 shadow rounded p-4">
                                <i class="far fa-fw fa-dot-circle fa-3x text-primary mr-4 mt-1"></i>

                                <div class="media-body">
                                    <h5 class="mb-1"><a class="link-dark" href="{{ route('categories.show', $tag->slug) }}">{{ $tag->name }}</a></h5>
                                    <p class="mb-0">{{ $tag->articles_count }} artigo(s).</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>Nenhuma tag de artigo cadastrada.</p>
                    @endforelse
                </div>

                <div class="row d-flex justify-content-center">
                    {{ $tags->links() }}
                </div>
            </div>

            @include('partials.sidebar')
        </div>
    </div>
@endsection
