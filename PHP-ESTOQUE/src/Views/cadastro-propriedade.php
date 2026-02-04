<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/css/cadastro_propriedade.css">
  <link rel="stylesheet" href="/assets/css/modal.css">
  <link rel="stylesheet" href="/assets/css/reset.css">

  <title>Cadastro Produto</title>
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

    <div id="ajuste">
      <h1>Propriedades</h1>
      <main id="principal">
        <div class="propriedade">
          <?php require __DIR__ . '/partials/components/modalAdicionarCategoria.php'; ?>
          <h2 class="propiedade_nome">Categorias</h2>
          <div class="card_conteudo">

            <div class="ativados_card">
              <h3 class="ativados">Ativados</h3>
              <?php foreach ($categorias as $categoria): ?>
                <?php if (empty($categoria['deletado_em'])): ?>
                  <div class="card_status">
                    <section><?= $categoria['nome'] ?></section>
                    <?php if (!empty($categoria['usuario_id'])): ?>
                      <a class="excluir"
                        href="<?= $this->router->generate("excluir-categoria", ["categoriaId" => $categoria['id']]) ?>">
                        Excluir
                      </a>
                    <?php else: ?>
                      <p title="Não é possível alterar dados  do sistema" class="sistema">sistema</p>
                    <?php endif; ?>
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>

            <div class="excluidos_card">
              <h3 class="excluidos">Excluídos</h3>
              <?php foreach ($categorias as $categoria): ?>
                <?php if (!empty($categoria['deletado_em'])): ?>
                  <div class="card_status">
                    <h3><?= $categoria['nome'] ?></h3>
                    <a class="excluir"
                      href="<?= $this->router->generate("recuperar-categoria", ["categoriaId" => $categoria['id']]) ?>">
                      Recuperar
                    </a>
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>

              <?php
              $categoriaExcluida = array_filter($categorias, function ($categoria) {
                return $categoria['deletado_em'] !== null;
              });
              if (empty($categoriaExcluida)): ?>
                <p class="mensagem_vazia">Não há categorias excluidas</p>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="propriedade">
          <?php require __DIR__ . '/partials/components/modalAdicionarMarca.php'; ?>
          <h2 class="propiedade_nome">Marcas</h2>
          <div class="card_conteudo">

            <div class="ativados_card">
              <h3 class="ativados">Ativados</h3>
              <?php foreach ($marcas as $marca): ?>
                <?php if (empty($marca['deletado_em'])): ?>
                  <div class="card_status">
                    <h3><?= $marca['nome'] ?></h3>
                    <?php if (!empty($marca['usuario_id'])): ?>
                      <a class="excluir"
                        href="<?= $this->router->generate("excluir-marca", ["marcaId" => $marca['id']]) ?>">
                        Excluir
                      </a>
                    <?php else: ?>
                      <p title="Não é possível alterar dados  do sistema" class="sistema">sistema</p>
                    <?php endif; ?>
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>

            <div class="excluidos_card">
              <h3 class="excluidos">Excluídos</h3>
              <?php foreach ($marcas as $marca): ?>
                <?php if (!empty($marca['deletado_em'])): ?>
                  <div class="card_status">
                    <h3><?= $marca['nome'] ?></h3>
                    <a class="excluir"
                      href="<?= $this->router->generate("recuperar-marca", ["marcaId" => $marca['id']]) ?>">
                      Recuperar
                    </a>
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>

              <?php
              $marcaExcluida = array_filter($marcas, function ($marca) {
                return $marca['deletado_em'] !== null;
              });
              if (empty($marcaExcluida)): ?>
                <p class="mensagem_vazia">Não há marcas excluidas</p>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="propriedade">
          <?php require __DIR__ . '/partials/components/modalAdicionarGenero.php'; ?>
          <h2 class="propiedade_nome">Gênero</h2>
          <div class="card_conteudo">

            <div class="ativados_card">
              <h3 class="ativados">Ativados</h3>
              <?php foreach ($generos as $genero): ?>
                <?php if (empty($genero['deletado_em'])): ?>
                  <div class="card_status">
                    <h3><?= $genero['nome'] ?></h3>
                    <?php if (!empty($genero['usuario_id'])): ?>
                      <a class="excluir"
                        href="<?= $this->router->generate("excluir-genero", ["generoId" => $genero['id']]) ?>">
                        Excluir
                      </a>
                    <?php else: ?>
                      <p title="Não é possível alterar dados  do sistema" class="sistema">sistema</p>
                    <?php endif; ?>
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>

            <div class="excluidos_card">
              <h3 class="excluidos">Excluídos</h3>
              <?php foreach ($generos as $genero): ?>
                <?php if (!empty($genero['deletado_em'])): ?>
                  <div class="card_status">
                    <h3><?= $genero['nome'] ?></h3>
                    <a class="excluir"
                      href="<?= $this->router->generate("recuperar-genero", ["generoId" => $genero['id']]) ?>">
                      Recuperar
                    </a>
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>

              <?php
              $generoExcluida = array_filter($generos, function ($genero) {
                return $genero['deletado_em'] !== null;
              });
              if (empty($generoExcluida)): ?>
                <p class="mensagem_vazia">Não há generos excluidos</p>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="propriedade">
          <?php require __DIR__ . '/partials/components/modalAdicionarTamanho.php'; ?>
          <h2 class="propiedade_nome">Tamanhos</h2>
          <div class="card_conteudo">

            <div class="ativados_card">
              <h3 class="ativados">Ativados</h3>
              <?php foreach ($tamanhos as $tamanho): ?>
                <?php if (empty($tamanho['deletado_em'])): ?>
                  <div class="card_status">
                    <h3><?= $tamanho['nome'] ?></h3>
                    <?php if (!empty($tamanho['usuario_id'])): ?>
                      <a class="excluir"
                        href="<?= $this->router->generate("excluir-tamanho", ["tamanhoId" => $tamanho['id']]) ?>">
                        Excluir
                      </a>
                    <?php else: ?>
                      <p title="Não é possível alterar dados  do sistema" class="sistema">sistema</p>
                    <?php endif; ?>
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>

            <div class="excluidos_card">
              <h3 class="excluidos">Excluídos</h3>
              <?php foreach ($tamanhos as $tamanho): ?>
                <?php if (!empty($tamanho['deletado_em'])): ?>
                  <div class="card_status">
                    <h3><?= $tamanho['nome'] ?></h3>
                    <a class="excluir"
                      href="<?= $this->router->generate("recuperar-tamanho", ["tamanhoId" => $tamanho['id']]) ?>">
                      Recuperar
                    </a>
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>

              <?php
              $tamanhoExcluida = array_filter($tamanhos, function ($tamanho) {
                return $tamanho['deletado_em'] !== null;
              });
              if (empty($tamanhoExcluida)): ?>
                <p class="mensagem_vazia">Não há tamanhos excluidos</p>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="propriedade">
          <?php require __DIR__ . '/partials/components/modalAdicionarSegmento.php'; ?>
          <h2 class="propiedade_nome">Segmentos</h2>
          <div class="card_conteudo">

            <div class="ativados_card">
              <h3 class="ativados">Ativados</h3>
              <?php foreach ($segmentos as $segmento): ?>
                <?php if (empty($segmento['deletado_em'])): ?>
                  <div class="card_status">
                    <h3><?= $segmento['nome'] ?></h3>
                    <?php if (!empty($segmento['usuario_id'])): ?>
                      <a class="excluir"
                        href="<?= $this->router->generate("excluir-segmento", ["segmentoId" => $segmento['id']]) ?>">
                        Excluir
                      </a>
                    <?php else: ?>
                      <p title="Não é possível alterar dados  do sistema" class="sistema">sistema</p>
                    <?php endif; ?>
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>

            <div class="excluidos_card">
              <h3 class="excluidos">Excluídos</h3>
              <?php foreach ($segmentos as $segmento): ?>
                <?php if (!empty($segmento['deletado_em'])): ?>
                  <div class="card_status">
                    <h3><?= $segmento['nome'] ?></h3>
                    <a class="excluir"
                      href="<?= $this->router->generate("recuperar-segmento", ["segmentoId" => $segmento['id']]) ?>">
                      Recuperar
                    </a>
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>

              <?php
              $segmentoExcluida = array_filter($segmentos, function ($segmento) {
                return $segmento['deletado_em'] !== null;
              });
              if (empty($segmentoExcluida)): ?>
                <p class="mensagem_vazia">Não há segmentos excluidos</p>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="propriedade">
          <?php require __DIR__ . '/partials/components/modalAdicionarCor.php'; ?>
          <h2 class="propiedade_nome">Cores</h2>
          <div class="card_conteudo">

            <div class="ativados_card">
              <h3 class="ativados">Ativados</h3>
              <?php foreach ($cores as $cor): ?>
                <?php if (empty($cor['deletado_em'])): ?>
                  <div class="card_status">
                    <h3><?= $cor['nome'] ?></h3>
                    <?php if (!empty($cor['usuario_id'])): ?>
                      <a class="excluir"
                        href="<?= $this->router->generate("excluir-cor", ["corId" => $cor['id']]) ?>">
                        Excluir
                      </a>
                    <?php else: ?>
                      <p title="Não é possível alterar dados  do sistema" class="sistema">sistema</p>
                    <?php endif; ?>
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>

            <div class="excluidos_card">
              <h3 class="excluidos">Excluídos</h3>
              <?php foreach ($cores as $cor): ?>
                <?php if (!empty($cor['deletado_em'])): ?>
                  <div class="card_status">
                    <h3><?= $cor['nome'] ?></h3>
                    <a class="excluir"
                      href="<?= $this->router->generate("recuperar-cor", ["corId" => $cor['id']]) ?>">
                      Recuperar
                    </a>
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>

              <?php
              $corExcluida = array_filter($cores, function ($cor) {
                return $cor['deletado_em'] !== null;
              });
              if (empty($corExcluida)): ?>
                <p class="mensagem_vazia">Não há cores excluidas</p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

</body>

</html>