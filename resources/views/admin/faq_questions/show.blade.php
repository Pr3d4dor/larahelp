@extends('adminlte::page')

@section('title', 'Visualizar Pergunta')

@section('content_header')
    <div class="p-2">
        <h2>Visualizar Pergunta</h2>
    </div>
@stop

@section('content')
    <div class="card card-primary p-4">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <td class="w-50">Pergunta</td>
                    <td class="w-50"> {{ $faqQuestion->content }}</td>
                </tr>
                <tr>
                    <td class="w-50">Resposta</td>
                    <td class="w-50">{{ $faqQuestion->answer }}</td>
                </tr>
                <tr>
                    <td class="w-50">Categoria</td>
                    <td class="w-50">{{ $faqQuestion->faqCategory->name }}</td>
                </tr>
                <tr>
                    <td class="w-50">Criado em</td>
                    <td class="w-50">@formatDate($faqQuestion->created_at)</td>
                </tr>
                <tr>
                    <td class="w-50">Última edição</td>
                    <td class="w-50">@formatDate($faqQuestion->updated_at)</td>
                </tr>
            </tbody>
        </table>

        <div class="mt-3">
            <a href="{{ route('admin.faq_questions.index') }}" class="btn btn-primary">Voltar</a>
        </div>
    </div>
@stop

@section('js')
@endsection
