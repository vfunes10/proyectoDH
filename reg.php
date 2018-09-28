<?php
include_once("funciones.php");

/*$paises = [
  "ar" => "Argentina",
  "co" => "Colombia",
  "uy" => "Uruguay"
];*/

$errores = [];
$usernameDefault = "";
$emailDefault= "";
$diaDefault= "";
$mesDefault= "";
$añoDefault= "";



if ($_POST) {
// Validar al  usuario
  $errores = validarUsuario($_POST);

  $usernameDefault = $_POST["user"];
  $emailDefault= $_POST["email"];
  $diaDefault= $_POST["Dia"];
  $mesDefault= $_POST["Mes"];
  $añoDefault= $_POST["Año"];

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
    <title>Registracion</title>
    <link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet">
    <link rel="stylesheet" href="css/challenge.css">
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
                <a href="index.html">Home</a>
                <a href="#">Acerca</a>
                <a href="#">Challenge</a>
                <a href="reg.html">Registrate</a>
                <p>  |  </p>
                <a href="login2.html">Inciar sesión</a>
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
  <h5> o registrate con tu E-mail </h5>
  <div class="principal">
   <form class="registro" action="reg.php" method="post"><br>

  <br>

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
    <input type="text" id= "user" name="user" value="<?=$emailDefault?>" placeholder="Usuario" >
  <?php endif; ?>



  <?php if (isset($_POST["password"])) : ?>
    <?php if (isset($errores["password"])) : ?>
      <input type="password" class="errorFormControl" id= "password" name="password" value="" placeholder="Contraseña" ><br><br>
      <p class="mensaje-error">
        <?=$errores["password"]?>
      </p>
    <?php else : ?>
      <input type="password" id= "user" name="password" value="" placeholder="Contraseña" >
    <?php endif; ?>
  <?php else : ?>
    <input type="password" id= "user" name="password" value="" placeholder="Contraseña" >
  <?php endif; ?>

   <br>
     <label for="nacimiento"><span class="strong">Fecha de Nacimiento</span>
      </label>
   <p></p>


   <?php if ((isset($_POST["Dia"]))||(isset($_POST["Mes"]))||(isset($_POST["Año"])))  : ?>
       <?php if (!isset($errores["Dia"])&&!isset($errores["Mes"])&&!isset($errores["Año"])) : ?>
         <div>
           <input class="nacimiento" type="text" id= "text" name="Dia" value="<?=$diaDefault?>" placeholder="Día" >
           <input class="nacimiento" type="text" id= "text" name="Mes" value="<?=$mesDefault?>" placeholder="Mes" >
           <input class="nacimiento" type="text" id= "text" name="Año" value="<?=$añoDefault?>" placeholder="Año" >
         </div>
      <?php else : ?>
         <div class="errorFormControl">
           <input class="nacimiento" type="text" id= "text" name="Dia" value="<?=$diaDefault?>" placeholder="Día" >
           <input class="nacimiento" type="text" id= "text" name="Mes" value="<?=$mesDefault?>" placeholder="Mes" >
           <input class="nacimiento" type="text" id= "text" name="Año" value="<?=$añoDefault?>" placeholder="Año" >
         </div>

         <?php if (isset($errores["Dia"])) : ?>
            <p class="mensaje-error">
              <?=$errores["Dia"]?>
            </p>
         <?php endif; ?>
         <?php if (isset($errores["Mes"])) : ?>
            <p class="mensaje-error">
              <?=$errores["Mes"]?>
            </p>
         <?php endif; ?>
         <?php if (isset($errores["Año"])) : ?>
            <p class="mensaje-error">
              <?=$errores["Año"]?>
            </p>
          <?php endif; ?>
      <?php endif; ?>
    <?php else : ?>
      <div>
        <input class="nacimiento" type="text" id= "text" name="Dia" value="<?=$diaDefault?>" placeholder="Día" >
        <input class="nacimiento" type="text" id= "text" name="Mes" value="<?=$mesDefault?>" placeholder="Mes" >
        <input class="nacimiento" type="text" id= "text" name="Año" value="<?=$añoDefault?>" placeholder="Año" >
      </div>
  <?php endif; ?>



          <?php if (isset($_POST["genero"]) && $_POST["genero"] == "m") : ?>
            <input id="genero" type="radio" name="genero" value="m" checked>
          <?php else : ?>
            <input id="genero" type="radio" name="genero" value="m">
          <?php endif; ?>
          <span class="genero">Masculino</span>

          <?php if (isset($_POST["genero"]) && $_POST["genero"] == "f") : ?>
            <input id="genero" type="radio" name="genero" value="f" checked>
          <?php else : ?>
            <input id="genero" type="radio" name="genero" value="f">
          <?php endif; ?>
          <span class="genero">Femenino</span>

          <?php if (isset($_POST["genero"]) && $_POST["genero"] == "n") : ?>
            <input id="genero" type="radio" name="genero" value="n" checked>
          <?php else : ?>
            <input id="genero" type="radio" name="genero" value="n">
          <?php endif; ?>
          <span class="genero">Prefiero no decirlo</span>

          <?php if (isset($errores["genero"])) : ?>
            <p class="mensaje-error">
              <?=$errores["genero"]?>
            </p>
           <?php endif; ?>
    </p>

  <p></p>
<p></p>
  <p class="fin">Al hacer clic en Registrarse, acepta los <strong><a class="fin" href="#">Términos y Condiciones</a></strong> de Uso de Challenge.</p>
  <p class="fin">Para obtener más información sobre cómo Challenge recopila, utiliza, comparte y protege sus datos personales, lea la <strong><a class="fin" href="#">Política de Privacidad</a></strong> de Challenge.</p>
<p></p>
<div class="botones">
  <p class="botones">
      <button class="button" type="submit" name="button"> REGISTRATE
        </button>
  </p>
</div>
</form>

</div>
<div class="fin">
  <h5>¿Ya tenes una cuenta? <strong><a class="fin" href="login2.html">Iniciar sesión</a></strong></h5>
</div>

</div>
</section>
    </div>
  </body>
</html>
