<?php
include_once("funciones.php");


$errores = [];
$usernameDefault = "";
$emailDefault= "";



if ($_POST) {
// Validar al  usuario
  $errores = validarUsuario($_POST);

  $usernameDefault = $_POST["user"];
  $emailDefault= $_POST["email"];

 if (empty($errores)) {
$usuario = armarUsuario();

$usuario = crearUsuario($usuario);

   // Redirigir a la home
   header("location:index.php");exit;
 }
}

?>



<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet">
    <link rel="stylesheet" href="css/challenge.css">
    <link rel="shortcut icon" type="image/png" href="img/barrita.png">
    </head>

    <body>
      <div class="">
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
                <a href="reg.php">Registrate</a>
                <p>  |  </p>
                <a href="login2.php">Inciar sesión</a>
              </nav>
            </nav>
          </div>
        </header>
<section>
  <div class="botones-facebook">
    <p class="botones">
        <button class="button-facebook" type="button" name="button">INICIAR SESIÓN CON FACEBOOK
          </button>

<div class= principal>
  <h5> o iniciar con Nombre de Usuario </h5>
  <div class="principal">
   <form class="registro" action="index.php" method="post"><br><br>
  <br>
  <?php if (isset($_POST["user"])) : ?>
    <?php if (!isset($errores["user"])) : ?>
      <input type="text" id= "user" name="user" value="<?=$usernameDefault?>" placeholder="Usuario" >
    <?php else : ?>
      <input type="text" class="errorFormControl" id= "user" name="user" value="<?=$usernameDefault?>" placeholder="Usuario" >
      <p class="mensaje-error">
        <?=$errores["user"]?>
      </p>
    <?php endif; ?>
  <?php else : ?>
    <input type="text" id= "user" name="user" value="<?=$usernameDefault?>" placeholder="Usuario" >
  <?php endif; ?>

   <br><br><br>
   <input type="password" id="password" name="password" value="" placeholder="Contraseña"><br><br>

  <p></p>

  <h5><strong>¿Olvidaste el nombre de usuario y contraseña?</strong></h5>
  <h5>¿No tenes cuenta? <strong><a class="fin" href="reg.php">Registrate</a></strong></h5>

<div class="botones">
  <p class="botones">
      <button class="button" type="submit" name="button"> REGISTRATE
        </button>
  </p>
</div>
</form>

</div>
<div class="fin">
<p class="fin"> Si haces clic en <a class="fin" href="http://www.facebook.com">“Acceder con Facebook”</a> y no eres usuario de Challenge, quedarás registrado y aceptaras los <strong><a class="fin" href="#">Términos y Condiciones</a></strong> y la <strong><a class="fin" href="#">Política de Privacidad de Challenge</a></strong>.
</p>
</div>
  </div>
  </section>
  </div>
  </body>
</html>
