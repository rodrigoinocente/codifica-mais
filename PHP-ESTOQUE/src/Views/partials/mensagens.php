
<div id="toast-container">
  <?php if (isset($erro) && $erro): ?>
    <div class="mostrar erro">
      <section onclick="fecharAlerta()" class="fecharAlerta">X</section>
      <p>
        <?= $erro ?>
      </p>
    </div>
  <?php endif; ?>

  <?php if ($mensagem): ?>
    <div class="mostrar mensagem">
      <section onclick="fecharAlerta()" class="fecharAlerta">X</section>
      <p>
        <?= $mensagem ?>
      </p>
    </div>
  <?php endif; ?>
</div>

<style>
  .mostrar {
    display: block;
    padding: .5rem 2rem;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    border-radius: 8px;
    font-size: 1.2rem;
    max-width: 30vw;
    position: absolute;
    top: 3.7rem;
    right: 20px;
    z-index: 9999;
    font-size: 1.5rem;
    text-align: center;
    font-weight: bold;
  }

  .erro {
    background-color: #ef2424fe;
    color: white;
  }

  .mensagem {
    background-color: #d4ebc7;
  }

  .fecharAlerta {
    position: absolute;
    right: 7px;
    top: 4px;
    cursor: pointer;
  }
</style>

<script>
  const fecharAlerta = () => {
    const modalAlerta = document.querySelector('.mostrar')
    modalAlerta.style.display = "none";
  }

  const fecharAlertaAuto = () => {
    const modalAlerta = document.querySelector('.mostrar')
    if (modalAlerta) {

      setTimeout(() => {
        modalAlerta.style.display = "none"
      }, 3000);
    }
  }

  fecharAlertaAuto()
</script>