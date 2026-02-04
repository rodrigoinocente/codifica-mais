<aside id="aside">
  <section id="home">
    <a href="<?= $this->router->generate('dashboard') ?>">
      PRODUTOS
    </a>
  </section>

  <section>
    <a id="adicionar_produto" href="<?= $this->router->generate('dashboard') ?>">
      Produtos
    </a>
  </section>

  <section>
    <a id="adicionar_produto" href="<?= $this->router->generate('cadastro-produto') ?>">
      Adicionar
    </a>
  </section>

  <section>
    <a id="adicionar_produto" href="<?= $this->router->generate('cadastro-propriedade') ?>">
      Propriedades
    </a>
  </section>

  <section>
    <a id="adicionar_produto" href="<?= $this->router->generate('produtos-excluidos') ?>">
      Excluídos
    </a>
  </section>
</aside>