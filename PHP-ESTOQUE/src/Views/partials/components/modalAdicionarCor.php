<div class="modal_container">
  <button title="Adicionar Cor" class="button_modal" type="button" onclick="abrirModal('modalCor')">+</button>
  <div class="modal" id="modalCor" onclick="fecharModal('modalCor')">
    <div class="modal-content" onclick="event.stopPropagation()">
      <span class="close" onclick="fecharModal('modalCor')">&times;</span>
      <h2 class="titulo_modal">Cadastro de Cor</h2>
      <form class="form_modal" action="<?= $this->router->generate('cadastrar-cor') ?>" method="POST">
        <label for="inputCor">Cor:</label>
        <input type="text" placeholder="Ex: Amarelo" name="nome" id="inputCor" required />
        <button type="submit">Salvar</button>
      </form>
    </div>
  </div>
</div>