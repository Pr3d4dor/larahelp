@extends('adminlte::page')

@section('title', 'Editar Categoria')

@section('content_header')
    <div class="p-2">
        <h2>Editar Categoria</h2>
    </div>
@stop

@section('content')
    <div class="card card-primary">
        @include('admin.categories._form', ['category' => $category])
    </div>
@stop

@section('js')
@endsection
