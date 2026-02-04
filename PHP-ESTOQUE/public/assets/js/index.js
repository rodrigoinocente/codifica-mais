const clicarMenu = () => {
  aside = document.getElementById('aside')
  if (aside.style.display === "none") {
    aside.style.display = "block";
  } else {
    aside.style.display = "none";
  }
}

const abrirModal = (idModal) => {
  const modal = document.getElementById(idModal);
  if (modal) {
    modal.style.display = 'flex';
  }
}

const fecharModal = (idModal) => {
  const modal = document.getElementById(idModal);
  if (modal) {
    modal.style.display = 'none';
  }
}

