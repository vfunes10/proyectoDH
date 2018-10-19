<?php
include "pdo.php";

session_start();
if (isset($_COOKIE["usuarioLogueado"]) && isset($_SESSION["usuarioLogueado"]) == false) {
  $_SESSION["usuarioLogueado"] = $_COOKIE["usuarioLogueado"];
}

function validarUsuario($datos) {
  $datosFinales = [];
  $errores = [];

  foreach ($datos as $posicion => $dato) {
    $datosFinales[$posicion] = trim($dato);
  }
  if ($_FILES["file"]["error"] != 0) {
    $errores["file"] = "Hubo un error en la carga";
    echo $errores["file"];
  } else{
      $ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
      if ($ext != "jpg" && $ext != "png" && $ext != "jpeg") {
        $errores["file"] = "Solo podes subir fotos jpg, jpeg o png";
        echo $errores["file"];
      }
    }
  if (strlen($datosFinales["user"]) == 0) {
    $errores["user"] = "Ey, dejaste el nombre de usuario vacío";
  }
  else if (ctype_alpha($datosFinales["user"]) == false)  {
    $errores["user"] = "Ey, el nombre de usuario tienen que ser solo letras";
  }

  if (strlen($datosFinales["email"]) == 0 ){
    $errores["email"] = "Dejaste el email vacío";
  }
  else if (filter_var($datosFinales["email"], FILTER_VALIDATE_EMAIL) == false) {
    $errores["email"] = "El email es incorrecto";
  }
  elseif (buscarEmail($datosFinales["email"])) {
    $errores["email"] = "El email informado ya existe";
  }
  if (strlen($datosFinales["password"]) < 8) {
    $errores["password"] = "La contraseña debe tener al menos 8 caracteres";
  }
  if ($datosFinales["passConfirm"]!= $datosFinales["password"]) {
    $errores["passConfirm"] = "Las contraseñas no coinciden";
  }
  if  (!isset($datosFinales["genero"])) {
    $errores["genero"] = "Completa el genero, no es algo que nos importe pero si no el formulario no avanza";
  }
  if  ($datosFinales["Dia"]<1||$datosFinales["Dia"]>31) {
    $errores["Dia"] = "Completa tu día de nacimiento";
  }
  if  ($datosFinales["Mes"]<1||$datosFinales["Mes"]>12) {
    $errores["Mes"] = "Completa tu mes de nacimiento";
  }
  if  ($datosFinales["Año"]<1900||$datosFinales["Año"]>2010) {
    $errores["Año"] = "Completa tu año de nacimiento";
  }
//echo"<pre>";var_dump($datosFinales);var_dump($errores);
  return $errores;
}


function armarUsuario(){
  if ($_POST["genero"]=="m") {
    $genero="masculino";
  }
    if ($_POST["genero"]=="f") {
    $genero="femenino";
  }
  if ($_POST["genero"]=="n") {
    $genero="Prefiero no decirlo";
  }
  return[
    "email" => trim($_POST["email"]),
    "user" => trim($_POST["user"]),
    "password" => password_hash($_POST["password"],PASSWORD_DEFAULT),
    "genero" => $genero,
    "fecha_De_Nacimiento" => $_POST["Dia"]. "/". $_POST["Mes"]. "/". $_POST["Año"],
    //"file" => $_FILE["file"]
  ];
}

function crearUsuario($usuario){
  global $dbUsuarios;

  $consulta = $dbUsuarios->prepare("INSERT into usuarios values (default, :email, :user, :password, :genero, :nacimiento, :created, :updated)");

  $now = date("Y-m-d h:i:s");

  $consulta->bindValue(":email", $usuario["email"]);
  $consulta->bindValue(":user", $usuario["user"]);
  $consulta->bindValue(":password", $usuario["password"]);
  $consulta->bindValue(":genero", $usuario["genero"]);
  $consulta->bindValue(":nacimiento", $usuario["fecha_De_Nacimiento"]);
  $consulta->bindValue(":created", $now);
  $consulta->bindValue(":updated", $now);
  $consulta->execute();
}

function traerUsuarios(){

  global $dbUsuarios;
  $consulta = $dbUsuarios->prepare("SELECT * FROM usuarios");

  $consulta->excecute();

  return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

function buscarEmail($email){
  global $dbUsuarios;
  $consulta = $dbUsuarios->prepare("SELECT * FROM usuarios where email = :email");

  $consulta->bindValue(":email", $email);

  $consulta->execute();

  return $consulta->fetch(PDO::FETCH_ASSOC);
}

function validarLogin() {
  $errores = [];
  $usuario = null;

  if ($_POST["email"] == "") {
    $errores["email"] = "Dejaste el email vacio";
  }
  else if ( filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) == false) {
    $errores["email"] = "El email no es un email";
  } else {
    $usuario = buscarEmail($_POST["email"]);

    if ($usuario == NULL) {
      $errores["email"] = "No existe usuario con ese email";
    }
  }

  if ($_POST["password"] == "") {
    $errores["password"] = "Dejaste la contraseña vacia";
  }

  if ($usuario != null && $_POST["password"] != "") {
    // VALIDAR QUE LA CONTRASENIA ESTE BIEN
    if (password_verify($_POST["password"], $usuario["password"]) == false) {
      $errores["password"] = "La contraseña no verifica";
    }

  }

  return $errores;
}

function loguear($email) {
  $_SESSION["usuarioLogueado"] = $email;
}

function estaLogueado() {
  return isset($_SESSION["usuarioLogueado"]);
}


?>
