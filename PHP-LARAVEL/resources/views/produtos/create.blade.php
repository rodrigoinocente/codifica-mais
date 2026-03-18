@extends('layout')

@section('title', 'Cadastrar Produtos')

@section('content')
    <h1>Cadastrar Produto</h1>
    <a href="{{ route('produtos.index') }}">Voltar</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('produtos.store') }}" method="POST">
        @csrf
        <div>
            <label for="nome">Nome</label>
            <input id="nome" name="nome" value="{{ old('nome') }}" required />
        </div>

        <div>
            <label for="descricao">Descrição</label>
            <textarea id="descricao" name="descricao" rows="3">{{ old('descricao') }}</textarea>
        </div>

        <div>
            <label for="preco">Preço</label>
            <input type="number" name="preco" id="preco" value="{{ old('preco') }}">
        </div>

        <button type="submit">Cadastrar</button>
    </form>


    <style>
        form {
            display: flex;
            flex-direction: column;
            margin: 0 auto;
            width: 90%;
            margin-top: 1rem;
            gap: 1rem;
        }

        form div {
            align-items: center;
        }

        label {
            font-weight: bold;
        }

        input,
        textarea {
            width: 90%;
            padding: 0.4rem;
        }

        a {
            color: #2563eb;
            text-decoration: none;
        }

        button {
            margin-top: 1rem;
            width: fit-content;
            align-self: center;
            padding: 0.4rem 1rem;
            cursor: pointer;
        }
    </style>

@endsection
