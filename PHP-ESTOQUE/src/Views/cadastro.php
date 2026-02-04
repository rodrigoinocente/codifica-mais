<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/css/login.css">
  <title>Cadastro</title>
</head>

<body>
  <main>
    <?php require __DIR__ . '/partials/mensagens.php'; ?>

    <form id="form_content" action="<?= $this->router->generate('cadastrar') ?>" method="POST">
      <h1>Cadastro</h1>

      <div class="item_form">
        <label for="nome">Nome</label>
        <input required type="text" name="nome" id="nome">
      </div>

      <div class="item_form">
        <label for="email">E-mail</label>
        <input required type="email" name="email" id="email">
      </div>

      <div class="item_form">
        <label for="senha">Senha</label>
        <input required type="password" name="senha" id="senha">
      </div>

      <div class="item_form">
        <label for="confirmar">Confirmar Senha</label>
        <input required type="password" name="confirmarSenha" id="confirmar">
      </div>

      <button type="submit">Cadastrar</button>

      <a href="<?= $this->router->generate('login') ?>"
        class="block text-center font-bold tracking-wider text-white hover:scale-140 transition">
        Voltar
      </a>
    </form>
  </main>
</body>

</html>