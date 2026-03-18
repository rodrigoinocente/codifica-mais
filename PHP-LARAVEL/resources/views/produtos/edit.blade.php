@extends('layout')

@section('title', 'Editar Produto')

@section('content')
    <h1>Editar Produto</h1>
    <a id="voltar" href="{{ route('produtos.index') }}">Voltar</a>

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

    <form action="{{ route('produtos.update', $produto) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="nome">Nome</label>
            <input id="nome" name="nome" value="{{ old('nome', $produto->nome) }}" required autofocus />
        </div>

        <div>
            <label for="descricao">Descrição</label>
            <textarea id="descricao" name="descricao" rows="3">{{ old('descricao', $produto->descricao) }}</textarea>
        </div>

        <div>
            <label for="preco">Preço</label>
            <input id="preco" name="preco" type="number" step="0.01" value="{{ old('preco', $produto->preco) }}"
                required />
        </div>

        <button type="submit">Salvar</button>
    </form>
    </div>
    </body>

    </html>

    <style>
        #voltar {
            align-self: flex-start;
            margin-bottom: 1rem;
        }

        form {
            display: flex;
            flex-direction: column;
            margin: 0 auto;
            margin-top: 1rem;
            gap: 1rem;
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
