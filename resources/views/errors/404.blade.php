@extends('layouts.app')

@section('title', 'LaraHelp - Página não encontrada')

@section('content')
    <section class="h-100 vh-100">
        <header class="container h-100">
            <div class="d-flex align-items-center justify-content-center h-100">
                <div class="d-flex flex-column">
                    <h1 class="text align-self-center p-2">Oops!</h1>
                    <h4 class="text align-self-center p-2">404 - Página não encontrada!</h4>
                    <p>Desculpe, ocorreu um erro. Página solicitada não encontrada!</p>
                    <a href="{{ route('home.index') }}" class="btn btn-danger align-self-center p-2">
                        <i class="fa fas fa-home"></i> Home
                    </a>
                </div>
            </div>
        </header>
    </section>
@endsection
