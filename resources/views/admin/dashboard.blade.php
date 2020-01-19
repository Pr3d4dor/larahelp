@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-fw fa-newspaper "></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Artigos</span>
                    <span class="info-box-number">{{ $articleCount }}</span>
                </div>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-tag"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Categorias</span>
                    <span class="info-box-number">{{ $categoryCount }}</span>
                </div>
            </div>
        </div>

        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-tag"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Tags</span>
                    <span class="info-box-number">{{ $tagCount }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Artigos Populares</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body p-0" style="display: block;">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Artigo</th>
                                <th class="text-center">Visualizações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($popularArticles as $article)
                                <tr>
                                    <td class="text-center"><a href="{{ route('admin.articles.show', $article->getKey()) }}">{{ $article->getKey() }}</a></td>
                                    <td class="text-center">{{ $article->title }}</td>
                                    <td class="text-center">{{ $article->view_count }}</td>
                                </tr>
                            @empty
                                <p>Nenhum artigo.</p>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Categorias Populares</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0" style="display: block;">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Categoria</th>
                                <th class="text-center">Total de Visualizações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($popularCategories as $category)
                                <tr>
                                    <td class="text-center"><a href="{{ route('admin.categories.show', $category->getKey()) }}">{{ $category->getKey() }}</a></td>
                                    <td class="text-center">{{ $category->name }}</td>
                                    <td class="text-center">{{ $category->total }}</td>
                                </tr>
                            @empty
                                <p>Nenhum categoria.</p>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Tags Populares</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0" style="display: block;">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Tag</th>
                                    <th class="text-center">Total de Visualizações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($popularTags as $tag)
                                    <tr>
                                        <td><a href="{{ route('admin.tags.show', $tag->getKey()) }}">{{ $tag->getKey() }}</a></td>
                                        <td>{{ $tag->name }}</td>
                                        <td>{{ $tag->total }}</td>
                                    </tr>
                                @empty
                                    <p>Nenhuma tag.</p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@stop
