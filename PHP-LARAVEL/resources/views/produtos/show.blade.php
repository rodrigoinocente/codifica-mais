<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto: {{ $produto->nome }}</title>

<body>
    <div id="container">
        <h1>Detalhes do Produto</h1>

        <a id="voltar" href="{{ route('produtos.index') }}">Voltar</a>

        <div class="card">
            <div>
                <div class="propriedade">Nome</div>
                <div class="valor">{{ $produto->nome }}</div>
            </div>

            <div>
                <div class="propriedade">Descrição</div>
                <div class="valor">{{ $produto->descricao ?? '' }}</div>
            </div>

            <div>
                <div class="propriedade">Preço</div>
                <div class="valor">R$ {{ number_format($produto->preco, 2, ',', '.') ?? '0,00' }}</div>
            </div>

            <div>
                <div class="propriedade">Criado em</div>
                <div class="valor">{{ $produto->created_at->format('d/m/Y H:i') ?? '' }}</div>
            </div>

            <div class="acoes">
                <a class="button" href="{{ route('produtos.edit', $produto) }}">Editar</a>
            </div>
        </div>
    </div>
</body>

</html>

<style>
    body {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-top: 4rem;
    }

    #container {
        width: 30%;
        display: flex;
        flex-direction: column;
        justify-content: center;

    }

    #voltar {
        align-self: flex-start;
        margin-bottom: 20px;
    }


    .card {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        width: 500px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 1rem;
    }

    .propriedade {
        font-weight: 600;
        color: #919191;
    }

    .valor {
        margin-top: 0.25rem;
        font-size: 1.3rem;
    }

    a {
        color: #2563eb;
        text-decoration: none;
    }

    .acoes {
        display: flex;
        gap: 1rem;
        justify-content: center
    }

    .button {
        padding: 0.4rem 0.75rem;
        border-radius: 0.25rem;
        text-decoration: none;
        background: #3b82f6;
        color: #fff;
    }
</style>
