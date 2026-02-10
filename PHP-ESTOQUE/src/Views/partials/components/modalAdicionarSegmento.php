<div class="modal_container">
  <button title="Adicionar Segmento" class="button_modal" type="button" onclick="abrirModal('modalSegmento')">+</button>
  <div class="modal" id="modalSegmento" onclick="fecharModal('modalSegmento')">
    <div class="modal-content" onclick="event.stopPropagation()">
      <span class="close" onclick="fecharModal('modalSegmento')">&times;</span>
      <h2 class="titulo_modal">Cadastro de Segmento</h2>
      <form class="form_modal" action="<?= $this->router->generate('cadastrar-segmento') ?>" method="POST">
        <label for="inputSegmento">Segmento</label>
        <input type="text" placeholder="" name="nome" id="inputSegmento" required />
        <button type="submit">Salvar</button>
      </form>
    </div>
  </div>
</div>