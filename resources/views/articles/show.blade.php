@extends('layouts.app')

@section('promo')
    <section class="duik-promo bg-primary">
        <div class="container duik-promo-container">
            <div class="d-flex position-relative mh-25rem pt-11 py-6">
                <div class="align-self-center">
                    <h1 class="text-white font-weight-light mb-3">{{ $article->title }}</h1>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-light">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Artigos</a></li>
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
                <h2>Sumário</h2>
                {!! $article->summary !!}
                <h2 class="mt-4">Conteúdo</h2>
                {!! $article->content !!}
            </div>

            @include('partials.sidebar')
        </div>
    </div>
@endsection
