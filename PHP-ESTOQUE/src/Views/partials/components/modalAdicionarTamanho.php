<div class="modal_container">
  <button title="Adicionar Tamanho" class="button_modal" type="button" onclick="abrirModal('modalTamanho')">+</button>
  <div class="modal" id="modalTamanho" onclick="fecharModal('modalTamanho')">
    <div class="modal-content" onclick="event.stopPropagation()">
      <span class="close" onclick="fecharModal('modalTamanho')">&times;</span>
      <h2 class="titulo_modal">Cadastro de Tamanho</h2>
      <form class="form_modal" action="<?= $this->router->generate('cadastrar-tamanho') ?>" method="POST">
        <label for="inputTamanho">Tamanho</label>
        <input type="text" placeholder="Ex: XG" name="nome" id="inputTamanho" required />
        <button type="submit">Salvar</button>
      </form>
    </div>
  </div>

</div>