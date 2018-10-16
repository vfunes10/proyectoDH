<?php
  include_once("funciones.php");
  $usuarios = traerUsuarios();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Inicio</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/challenge.css">

</head>
<body>
  <div class="contenedor">
    <?php include("header.php") ?>
    <div class="principal">
      <h1 class="title">Mis usuarios</h1>
      <ul>
        <?php foreach ($usuarios as $usuario) : ?>
          <li>
            <a href="detalleUsuario.php?email=<?=$usuario["email"]?>">
              <?php echo $usuario["email"]; ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</body>
</html>
