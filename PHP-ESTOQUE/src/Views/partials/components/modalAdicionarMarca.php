<div class="modal_container">
  <button title="Adicionar Marca" class="button_modal" type="button" onclick="abrirModal('modalMarca')">+</button>
  <div class="modal" id="modalMarca" onclick="fecharModal('modalMarca')">
    <div class="modal-content" onclick="event.stopPropagation()">
      <span class="close" onclick="fecharModal('modalMarca')">&times;</span>
      <h2 class="titulo_modal">Cadastro de Marca</h2>
      <form class="form_modal" action="<?= $this->router->generate('cadastrar-marca') ?>" method="POST">
        <label for="inputMarca">Marca</label>
        <input type="text" placeholder="Ex: Nike" name="nome" id="inputMarca" required />
        <button type="submit">Salvar</button>
      </form>
    </div>
  </div>

</div>
