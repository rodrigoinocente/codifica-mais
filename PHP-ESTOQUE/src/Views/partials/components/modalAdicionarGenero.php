<div class="modal_container">
  <button title="Adicionar Gênero" class="button_modal" class="button_modal" type="button" onclick="abrirModal('modalGenero')">+</button>
  <div class="modal" id="modalGenero" onclick="fecharModal('modalGenero')">
    <div class="modal-content" onclick="event.stopPropagation()">
      <span class="close" onclick="fecharModal('modalGenero')">&times;</span>
      <h2 class="titulo_modal">Cadastro de Gênero</h2>
      <form class="form_modal" action="<?= $this->router->generate('cadastrar-genero') ?>" method="POST">
        <label for="inputGenero">Gênero:</label>
        <input type="text" placeholder="" name="nome" id="inputGenero" required />
        <button type="submit">Salvar</button>
      </form>
    </div>
  </div>

</div>
