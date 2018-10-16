<?php
include_once("funciones.php");

$errores = [];
$usernameDefault = "";
$emailDefault= "";


if (estaLogueado()) {
  echo "está logueado";exit;
  header("location:index.php");exit;
}

//Vine por POST?
if ($_POST) {
	// VALIDAR
  
  $errores = validarLogin($_POST);
  $emailDefault=$_POST["email"];
  	if ( empty($errores) ) {
		loguear($_POST["email"]);
		// REDIRIGIRLO

    header("Location:index.php");
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
    </head>

    <body>
      <div class="">
          <?php include_once("header.php") ?>
        <section>
          <div class="botones-facebook">
            <p class="botones">
                <button class="button-facebook" type="button" name="button">INICIAR SESIÓN CON FACEBOOK
                </button>
            </p>
            <div class= principal>
                <h5> o iniciar con E-mail </h5>
                <div class="principal">
                   <form class="registro" action="login.php" method="post">

                      <?php if (isset($_POST["email"])) : ?>
                        <?php if (!isset($errores["email"])) : ?>
                          <input type="email" id= "email" name="email" value="<?=$emailDefault?>" placeholder="E-mail" >
                        <?php else : ?>
                          <input type="email" class="errorFormControl" id= "email" name="email" value="<?=$emailDefault?>" placeholder="E-mail" >
                          <p class="mensaje-error">
                            <?=$errores["email"]?>
                          </p>
                        <?php endif; ?>
                      <?php else : ?>
                        <input type="text" id= "email" name="email" value="<?=$emailDefault?>" placeholder="E-mail" >
                      <?php endif; ?>

                     <?php if (isset($_POST["password"])) : ?>
                       <?php if (isset($errores["password"])) : ?>
                         <input type="password" class="errorFormControl" id= "password" name="password" value="" placeholder="Contraseña" >
                         <p class="mensaje-error">
                           <?=$errores["password"]?>
                         </p>
                       <?php else : ?>
                         <input type="password" id= "password" name="password" value="" placeholder="Contraseña" >
                       <?php endif; ?>
                     <?php else : ?>
                       <input type="password" id= "password" name="password" value="" placeholder="Contraseña" >
                     <?php endif; ?>

                     <div class="botones">
                       <p class="botones">
                         <button class="button" type="submit" name="button"> INICIAR SESION
                         </button>
                       </p>
                     </div>
                     <h5><strong><a href="#">¿Olvidaste el nombre de usuario y contraseña?</a></strong></h5>
                     <h5>¿No tenes cuenta?
                       <strong>
                         <a href="reg.php">Registrate</a>
                       </strong>
                     </h5>
                   </form>
                </div>
              <div class="fin">
                <p class="fin"> Si haces clic en <a class="fin" href="#">“Acceder con Facebook”</a> y no eres usuario de Challenge, quedarás registrado y aceptaras los <strong><a class="fin" href="#">Términos y Condiciones</a></strong> y la <strong><a class="fin" href="#">Política de Privacidad de Challenge</a></strong>.
                </p>
              </div>
            </div>
          </div>
        </section>
    </body>
</html>
