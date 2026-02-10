<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/css/login.css">
  <title>Login</title>
</head>

<body>
  <main>
    <?php require __DIR__ . '/partials/mensagens.php'; ?>

    <form id="form_content" action="<?= $this->router->generate('logar') ?>" method="POST">
      <h1 id="titulo">Login</h1>

      <div class="item_form">
        <label>E-mail</label>
        <input required type="email" name="email">
      </div>

      <div class="item_form">
        <label>Senha</label>
        <input required type="password" name="senha">
      </div>

      <button type="submit">Entrar</button>
      
      <a href="<?= $this->router->generate('cadastro') ?>">
        Criar conta
      </a>
    </form>
  </main>
</body>

</html>