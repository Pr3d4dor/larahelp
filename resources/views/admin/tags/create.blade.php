@extends('adminlte::page')

@section('title', 'Criar Tag')

@section('content_header')
    <div class="p-2">
        <h2>Criar Tag</h2>
    </div>
@stop

@section('content')
    <div class="card card-primary">
        @include('admin.tags._form', ['tag' => $tag])
    </div>
@stop

@section('js')
@endsection
