@extends('adminlte::page')

@section('title', 'Editar Pergunta Frequente')

@section('content_header')
    <div class="p-2">
        <h2>Editar Perguntas Frequente</h2>
    </div>
@stop

@section('content')
    <div class="card card-primary">
        @include('admin.faq_questions._form', ['faq_question' => $faqQuestion])
    </div>
@stop

@section('js')
@endsection
