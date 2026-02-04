 <div id="cabecalho">

   <div id="menu" onclick="clicarMenu()">
     Menu
   </div>

   <div id="direita">
     <section>Olá,<b><?php echo $_SESSION['usuario']['nome']; ?></b>!</section>
     <a href="<?= $this->router->generate('logout') ?>">
       Sair
     </a>
   </div>
 </div>

 <script src="/assets/js/index.js"></script>