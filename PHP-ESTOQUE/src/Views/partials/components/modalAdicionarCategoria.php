<div class="modal_container">
  <button title="Adicionar Categoria" class="button_modal" onclick="abrirModal('modalCategoria')">+</button>
  <div class="modal" id="modalCategoria" onclick="fecharModal('modalCategoria')">
    <div class="modal-content" onclick="event.stopPropagation()">
      <span class="close" onclick="fecharModal('modalCategoria')">&times;</span>
      <h2 class="titulo_modal">Cadastro de Categoria</h2>
      <form class="form_modal" action="<?= $this->router->generate('cadastrar-categoria') ?>" method="POST">
        <label for="inputCategoria">Categoria:</label>
        <input type="text" placeholder="Ex: Chinelo" name="nome" id="inputCategoria" required />
        <button type="submit">Salvar</button>
      </form>
    </div>
  </div>
</div>