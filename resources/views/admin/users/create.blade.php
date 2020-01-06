@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="p-2">
        <h2>Criar Usuário</h2>
    </div>
@stop

@section('content')
    <div class="card card-primary">
        @include('admin.users._form', ['user' => $user])
    </div>
@stop

@section('js')
@endsection
