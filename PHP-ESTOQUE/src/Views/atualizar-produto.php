<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/css/produto_form.css">
  <link rel="stylesheet" href="/assets/css/reset.css">

  <title>Atualizar Produto</title>
</head>

<body>
  <?php require __DIR__ . '/partials/mensagens.php'; ?>

  <!-- Header -->
  <?php require __DIR__ . '/partials/header.php' ?>
  <!--        -->

  <div id="layout">

    <!-- Menu  -->
    <?php require __DIR__ . '/partials/aside.php'; ?>
    <!--       -->

    <main id="principal">

      <h1 id="titulo">Atualizar Produto</h1>

      <form action="<?= $this->router->generate('atualizar-produto') ?>" method="POST">
        <input type="hidden" name="id" value="<?= $produto['id'] ?>">
        <div class="form_item">
          <label for="nome">Nome</label>
          <input required type="text" value="<?= $produto['nome'] ?>" name="nome" id="nome">
        </div>

        <div class="form_item">
          <label for="categoria_id">Categoria</label>
          <select name="categoria_id" id="categoria_id" required>
            <?php foreach ($categorias as $categoria): ?>
              <option value="<?= $categoria['id'] ?>"
                <?= $categoria['id'] == $produto['categoria_id'] ? 'selected' : '' ?>>
                <?= $categoria['nome'] ?>
              <?php endforeach; ?>
          </select>
        </div>

        <div class="form_item">
          <label for="marca_id">Marca</label>
          <select name="marca_id" id="marca_id" required>
            <?php foreach ($marcas as $marca): ?>
              <option value="<?= $marca['id'] ?>"
                <?= $marca['id'] == $produto['marca_id'] ? 'selected' : '' ?>>
                <?= $marca['nome'] ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form_item">
          <label for="segmento_id">Segmento</label>
          <select name="segmento_id" id="segmento_id" required>
            <?php foreach ($segmentos as $segmento): ?>
              <option value="<?= $segmento['id'] ?>"
                <?= $segmento['id'] == $produto['segmento_id'] ? 'selected' : '' ?>>
                <?= $segmento['nome'] ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form_item">
          <label for="tamanho_id">Tamanho</label>
          <select name="tamanho_id" id="tamanho_id" required>
            <option value="">Selecione um Tamanho</option>

            <optgroup label="Letras">
              <?php foreach ($tamanhosLetras as $tamanhoLetra): ?>
                <option value="<?= $tamanhoLetra['id'] ?>" <?= ($tamanhoLetra['id'] == $produto['tamanho_id']) ? 'selected' : '' ?>>
                  <?= $tamanhoLetra['nome'] ?>
                </option>
              <?php endforeach; ?>
            </optgroup>

            <optgroup label="Numerações">
              <?php foreach ($tamanhosNumericos as $tamanhoNumerico): ?>
                <option value="<?= $tamanhoNumerico['id'] ?>" <?= ($tamanhoNumerico['id'] == $produto['tamanho_id']) ? 'selected' : '' ?>>
                  <?= $tamanhoNumerico['nome'] ?>
                </option>
              <?php endforeach; ?>
            </optgroup>
          </select>
        </div>

        <div class="form_item">
          <label for="genero_id">Gênero</label>
          <select name="genero_id" id="genero_id" required>
            <?php foreach ($generos as $genero): ?>
              <option value="<?= $genero['id'] ?>"
                <?= $genero['id'] == $produto['genero_id'] ? 'selected' : '' ?>>
                <?= $genero['nome'] ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

       <div class="form_item">
          <label for="cor_id">Cor</label>
          <select name="cor_id" id="cor_id" required>
            <?php foreach ($cores as $cor): ?>
              <option value="<?= $cor['id'] ?>"
                <?= $cor['id'] == $produto['cor_id'] ? 'selected' : '' ?>>
                <?= $cor['nome'] ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form_item">
          <label for="quantidade">Quantidade</label>
          <input type="number" name="quantidade" id="quantidade" value="<?= $produto['quantidade'] ?>">
        </div>

        <div class="form_item">
          <label for="descricao">Descrição</label>
          <textarea name="descricao" id="descricao" value="<?= $produto['descricao'] ?>">
        <?= $produto['descricao'] ?>
        </textarea>
        </div>
        
        <div id="footer_form">
          <a href="<?= $this->router->generate('dashboard') ?>">
            Voltar
          </a>
          <button type="submit">Salvar</button>
        </div>
      </form>

    </main>
  </div>
</body>


</html>