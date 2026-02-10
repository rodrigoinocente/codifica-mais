<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/css/dashboard.css">
  <link rel="stylesheet" href="/assets/css/reset.css">

  <title>Produtos Excluídos</title>
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
      <h1 id="titulo">Produtos Excluídos</h1>
      <div id="tabela_header">
        <span>Nome</span>
        <span>Quantidade</span>
        <span>Marca</span>
        <span>Cor</span>
        <span>Tamanho</span>
        <span>Categoria</span>
        <span>Gênero</span>
        <span>Segmento</span>
      </div>

      <section id="card_content">
        <?php foreach ($produtos as $produto): ?>
          <div class="card">
            <div class="card_item" id="nome" title="<?= $produto['nome'] ?>">
              <p id="nome"><?= $produto['nome'] ?></p>
            </div>

            <div class="card_item">
              <p><?= number_format($produto['quantidade'], 0, ',', ' ') ?></p>
            </div>

            <div class="card_item">
              <p><?= $produto['marca'] ?></p>
            </div>

            <div class="card_item">
              <p><?= $produto['cor'] ?></p>
            </div>

            <div class="card_item">
              <p><?= $produto['tamanho'] ?></p>
            </div>

            <div class="card_item">
              <p><?= $produto['categoria'] ?></p>
            </div>

            <div class="card_item">
              <p><?= $produto['genero'] ?></p>
            </div>

            <div class="card_item">
              <p><?= $produto['segmento'] ?></p>
            </div>
            
            <a class="recuperar" href="<?= $this->router->generate("recuperar-produto", ["produtoId" => $produto['id']]) ?>"> Recuperar</a>
          </div>

        <?php endforeach; ?>
      </section>

    </main>
  </div>



</body>


</html>