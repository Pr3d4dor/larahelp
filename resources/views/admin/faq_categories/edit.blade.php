@extends('adminlte::page')

@section('title', 'Editar Categoria de Perguntas Frequentes')

@section('content_header')
    <div class="p-2">
        <h2>Editar Categoria de Perguntas Frequentes</h2>
    </div>
@stop

@section('content')
    <div class="card card-primary">
        @include('admin.faq_categories._form', ['faq_category' => $faqCategory])
    </div>
@stop

@section('js')
@endsection
