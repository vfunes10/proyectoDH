
<?php
include_once("funciones.php");
$usuarios = traerUsuarios();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1> Mis usuarios </h1>
    <ul>
    <?php foreach ($usuarios as $usuario): ?>
      <li>
        <?php echo $usuario["user"] . " " . $usuario["email"] . " " . $usuario["genero"] . " " . $usuario["fecha_De_Nacimiento"]; ?>
      </li>
    <?php endforeach; ?>

    </ul>
  </body>
</html>
