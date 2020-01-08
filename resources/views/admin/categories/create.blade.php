@extends('adminlte::page')

@section('title', 'Criar Categoria')

@section('content_header')
    <div class="p-2">
        <h2>Criar Categoria</h2>
    </div>
@stop

@section('content')
    <div class="card card-primary">
        @include('admin.categories._form', ['category' => $category])
    </div>
@stop

@section('js')
@endsection
