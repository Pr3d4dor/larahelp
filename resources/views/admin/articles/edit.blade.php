@extends('adminlte::page')

@section('title', 'Editar Artigo')

@section('content_header')
    <div class="p-2">
        <h2>Editar Artigo</h2>
    </div>
@stop

@section('content')
    <div class="card card-primary">
        @include('admin.articles._form', ['article' => $article])
    </div>
@stop

@section('js')
@endsection
