<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/css/dashboard.css">
  <link rel="stylesheet" href="/assets/css/reset.css">

  <title>Dashboard</title>
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
      <h1 id="titulo">Produtos</h1>
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

        <?php if (empty($produtos)): ?>
            <div style="text-align: center; font-size: 2rem; font-weight: bold; margin-top: 2rem">
                <p> Não há produtos registrados. </p>
            </div>
        <?php endif; ?>


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

            <div class="card_acao">
              <section class="tresPontos" onclick="toggleModal(this)">...</section>

              <div class="mini_modal">
                <section onclick="fecharMiniModal(this)">X</section>
                <a href="<?= $this->router->generate('atualizar-produtoForm', ['produtoId' => $produto['id']]) ?>">
                  Atualizar
                </a>
                <a href="<?= $this->router->generate('deletar-produto', ['produtoId' => $produto['id']]) ?>">
                  Deletar
                </a>
              </div>
            </div>
          </div>

        <?php endforeach; ?>
      </section>

    </main>
  </div>

</body>

</html>
<script>
  function toggleModal(elemento) {
    event.stopPropagation();
    const card = elemento.parentElement
    const miniModal = card.querySelector('.mini_modal')

    miniModal.classList.toggle('ativar_mini_modal')
  }

  const fecharMiniModal = (elemento) => {
    const card = elemento.parentElement
    const miniModal = card.querySelector('.mini_modal')

    miniModal.classList.remove('ativar_mini_modal')
  }

  window.addEventListener('click', function() {
    document.querySelectorAll('.mini_modal').forEach(m => {
      m.classList.remove('ativar_mini_modal');
    });
  });
</script>