@extends('adminlte::page')

@section('title', 'Visualizar Categoria de Perguntas Frequentes')

@section('content_header')
    <div class="p-2">
        <h2>Visualizar Categoria de Perguntas Frequentes</h2>
    </div>
@stop

@section('content')
    <div class="card card-primary p-4">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <td class="w-50">Nome</td>
                    <td class="w-50"> {{ $faqCategory->name }}</td>
                </tr>
                <tr>
                    <td class="w-50">Criado em</td>
                    <td class="w-50">@formatDate($faqCategory->created_at)</td>
                </tr>
                <tr>
                    <td class="w-50">Última edição</td>
                    <td class="w-50">@formatDate($faqCategory->updated_at)</td>
                </tr>
            </tbody>
        </table>

        <div class="mt-3">
            <a href="{{ route('admin.faq_categories.index') }}" class="btn btn-primary">Voltar</a>
        </div>
    </div>
@stop

@section('js')
@endsection
