@extends('adminlte::page')

@section('title', 'Visualizar Usuário')

@section('content_header')
    <div class="p-2">
        <h2>Visualizar Usuário</h2>
    </div>
@stop

@section('content')
    <div class="card card-primary p-4">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <td class="w-50">Nome</td>
                    <td class="w-50"> {{ $user->name }}</td>
                </tr>
                <tr>
                    <td class="w-50">Email</td>
                    <td class="w-50">{{ $user->email }}</td>
                </tr>
                <tr>
                    <td class="w-50">Criado em</td>
                    <td class="w-50">@formatDate($user->created_at)</td>
                </tr>
                <tr>
                    <td class="w-50">Última edição</td>
                    <td class="w-50">@formatDate($user->updated_at)</td>
                </tr>
            </tbody>
        </table>

        <div class="mt-3">
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Voltar</a>
        </div>
    </div>
@stop

@section('js')
@endsection
