<?php
  include_once("funciones.php");

  $email = $_GET["email"];

  $usuario = buscarEmail($email);

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
      <h1 class="title">Bienvenido al perfil de <?=$usuario["email"]?></h1>
      <ul>
        <li>ID: <?=$usuario["id"]?></li>
        <li>Usuario: <?=$usuario["user"]?></li>
        <li>Fecha de Nacimiento: <?=$usuario["fecha_De_Nacimiento"]?></li>
        <li>Email: <?=$usuario["email"]?></li>
        <li>Género: <?=$usuario["genero"]?></li>
      </ul>

    </div>
  </div>
</body>
</html>
