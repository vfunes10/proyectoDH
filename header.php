<?php
include_once("funciones.php");
?>
<header>
  <div class="container">
    <nav>
      <a href="#">
        <img class="logo" src="img/logo.png" alt="logotipo">
      </a>
      <a href="#">
        <img class="menu" src="img/barrita.png" alt="barrita">
      </a>
      <nav class="desktop">
        <a href="index.php">Home</a>
        <a href="#">Acerca</a>
        <a href="#">Challenge</a>

        <?php if (estaLogueado()) : ?>
          <p>Hola <?php echo $_SESSION["usuarioLogueado"] ?></p>
          <p>  |  </p>
          <a href="logout.php">Cerrar sesión</a>
        <?php else: ?>
          <a href="reg.php">Registrate</a>
          <p>  |  </p>
          <a href="login.php">Iniciar sesión</a>
        <?php endif; ?>

      </nav>
    </nav>
  </div>
</header>
