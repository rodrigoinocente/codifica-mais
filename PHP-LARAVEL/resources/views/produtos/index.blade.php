<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
</head>

<body>
    <div id="container">

        <h1>Produtos</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <a class="button" id="cadastrar" href="{{ route('produtos.create') }}">Cadastrar</a>
        @if ($produtos->isempty())
            <p>Nenhum produto encontrado.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Criado em</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produtos as $produto)
                        <tr onclick="window.location='{{ route('produtos.show', $produto) }}'">
                            <td>{{ $produto->nome }}</td>
                            <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                            <td>{{ $produto->created_at?->format('d/m/Y') }}</td>

                            <td class="acoes" onclick="event.stopPropagation();">
                                <a class="button" href="{{ route('produtos.edit', $produto) }}">Editar</a>

                                <form action="{{ route('produtos.destroy', $produto) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="button danger" type="submit"
                                        onclick="return confirm('Deseja remover este produto?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

</body>

</html>

<style>
    body {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 2rem;
    }

    h1 {
        text-align: center;
    }

    #container {
        width: 80%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    #cadastrar {
        align-self: flex-start;
    }


    table {
        border-collapse: collapse;
        margin-top: 1rem;
    }

    thead tr th {
        text-align: center
    }

    th,
    td:not(:first-child) {
        padding: 0.5rem 0.75rem;
        border: 1px solid #e5e7eb;
        text-align: left;
        cursor: pointer;
        text-align: center;
    }

    th,
    td:first-child {
        margin-left: 1rem;
        padding-left: 20px;
    }

    th {
        background: #f3f4f6;
    }

    .acoes {
        display: flex;
        flex-direction: row;
        justify-content: center;
        margin-left: auto;
        gap: .5rem;
    }

    .button {
        display: inline-block;
        padding: 0.4rem 0.75rem;
        border-radius: 0.25rem;
        text-decoration: none;
        background: #3b82f6;
        color: #fff;
    }

    .button.danger {
        background: #ef4444;
    }

    .alert {
        padding: 0.75rem 1rem;
        border-radius: 0.25rem;
        margin-bottom: 1rem;
    }

    .alert-success {
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        color: #065f46;
    }

    .alert-error {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #991b1b;
    }

    table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    table tr:hover {
        background-color: #ddd;
    }
</style>
