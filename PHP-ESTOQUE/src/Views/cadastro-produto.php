<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/css/produto_form.css">
  <link rel="stylesheet" href="/assets/css/reset.css">

  <title>Cadastrar Produto</title>
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

      <h1 id="titulo">Cadastrar Produto</h1>

      <form action="<?= $this->router->generate('cadastrar-produto') ?>" method="POST">
        <div class="form_item">
          <label for="nome">Nome</label>
          <input required type="text" name="nome" id="nome">
        </div>

        <div class="form_item">
          <label for="categoria_id">Categoria</label>
          <select name="categoria_id" id="categoria_id" required>
            <option value=null>Selecione uma Categoria</option>
            <?php foreach ($categorias as $categoria): ?>
              <option value="<?= $categoria['id'] ?>"><?= $categoria['nome'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form_item">
          <label for="marca_id">Marca</label>
          <select name="marca_id" id="marca_id" required>
            <option value=null>Selecione uma Marca</option>
            <?php foreach ($marcas as $marca): ?>
              <option value="<?= $marca['id'] ?>"><?= $marca['nome'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form_item">
          <label for="segmento_id">Segmento</label>
          <select name="segmento_id" id="segmento_id" required>
            <option value=null>Selecione um Segmento</option>
            <?php foreach ($segmentos as $segmento): ?>
              <option value="<?= $segmento['id'] ?>"> <?= $segmento['nome'] ?> </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form_item">
          <label for="tamanho_id">Tamanho</label>
          <select name="tamanho_id" id="tamanho_id" required>
            <option value="">Selecione um Tamanho</option>

            <optgroup label="Letras">
              <?php foreach ($tamanhosLetras as $tamanhoLetra): ?>
                <option value="<?= $tamanhoLetra['id'] ?>"><?= $tamanhoLetra['nome'] ?></option>
              <?php endforeach; ?>
            </optgroup>

            <optgroup label="Numerações">
              <?php foreach ($tamanhosNumericos as $tamanhoNumerico): ?>
                <option value="<?= $tamanhoNumerico['id'] ?>"><?= $tamanhoNumerico['nome'] ?></option>
              <?php endforeach; ?>
            </optgroup>
          </select>
        </div>

        <div class="form_item">
          <label for="genero_id">Gênero</label>
          <select name="genero_id" id="genero_id" required>
            <option value=null>Selecione um Gênero</option>
            <?php foreach ($generos as $genero): ?>
              <option value="<?= $genero['id'] ?>"><?= $genero['nome'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form_item">
          <label for="cor_id">Cor</label>
          <select name="cor_id" id="cor_id" required>
            <option value=null>Selecione uma Cor</option>
            <?php foreach ($cores as $cor): ?>
              <option value="<?= $cor['id'] ?>"><?= $cor['nome'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form_item">
          <label for="quantidade">Quantidade</label>
          <input type="number" name="quantidade" id="quantidade">
        </div>

        <div class="form_item">
          <label for="descricao">Descrição</label>
          <textarea name="descricao" id="descricao"></textarea>
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
