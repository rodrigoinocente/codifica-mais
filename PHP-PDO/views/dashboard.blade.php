@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center w-screen absolute">
        <div class="mt-[15rem] text-center">
            <h1 class="text-2xl mb-4 text-green-700">Página exclusiva para membros cadastrados</h1>
            <section class="text-2xl">Boas Vindas, <strong>{{ $usuario['nome'] }}</strong>!</section>
            <section class="mb-4">{{ $usuario['email'] }}</section>

            <a href="{{ $router->generate('logout') }}"
                class="px-4 py-2 bg-red-700 text-white font-bold rounded hover:bg-red-800 transition duration-200 shadow-md inline-block">
                Sair
            </a>

        </div>
    </div>
@endsection
