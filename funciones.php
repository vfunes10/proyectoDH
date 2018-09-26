<?php
function validarUsuario($datos) {
  $datosFinales = [];
  $errores = [];

  foreach ($datos as $posicion => $dato) {
    $datosFinales[$posicion] = trim($dato);
  }

  if (strlen($datosFinales["user"]) == 0) {
    $errores["user"] = "Ey, dejaste el nombre de usuario vacío";
  }
  else if (ctype_alpha($datosFinales["user"]) == false)  {
    $errores["user"] = "Ey, el nombre de usuario tienen que ser sólo letras";
  }

  if (strlen($datosFinales["email"]) == 0 ){
    $errores["email"] = "Dejaste el email vacío";
  }
  else if (filter_var($datosFinales["email"], FILTER_VALIDATE_EMAIL) == false) {
    $errores["email"] = "El email es incorrecto";
  } else if (buscarPorEmail ($datosFinales["email"]) != NULL) {
    $errores ["email"] = "El email ya está en uso, usá otro email";
  }


  if (strlen($datosFinales["password"]) <= 8) {
    $errores["password"] = "La contraseña debe tener al menos 8 caracteres";
  }
  if  (!isset($datosFinales["genero"])) {
    $errores["genero"] = "Completá el genero, no es algo que nos importe, pero sino el formulario no avanza";
  }
  if  ($datosFinales["Dia"]<1) {
    $errores["Dia"] = "Completá tu día de nacimiento";
  }
  if  ($datosFinales["Mes"]<1) {
    $errores["Mes"] = "Completá tu mes de nacimiento";
  }
  if  ($datosFinales["Año"]<1) {
    $errores["Año"] = "Completá tu año de nacimiento";
  }
  return $errores;
}

function armarUsuario() {
  $genero="";
if ($_POST["genero"] == "m") {
$genero="masculino"; }
elseif ($_POST["genero"] == "f") {
    $genero="femenino";}
     else { $genero="prefiero no decirlo";
   }

  return [
    "user" => $_POST["user"],
    "email" => $_POST["email"],
    "password" => password_hash($_POST["password"], PASSWORD_DEFAULT),
    "genero" =>  $genero,
    "fecha_De_Nacimiento" => $_POST["Dia"]. "/". $_POST["Mes"]. "/". $_POST["Año"],
  ];
}

function crearUsuario($usuario) {


  $usuarios = file_get_contents("usuarios.json");
    $usuarios= json_decode($usuarios, true);

    if($usuarios === NULL) {
      $usuarios = [];
    }

    $usuarios [] = $usuario;
    $usuarios = json_encode($usuarios);
    file_put_contents("usuarios.json",$usuarios);

}

function traerUsuarios() {
  $usuarios = file_get_contents("usuarios.json");
  $usuarios = json_decode($usuarios, true);
  return $usuarios;


}

function buscarPorEmail($email) {
  $usuarios = file_get_contents("usuarios.json");
  $usuariosArray = json_decode ($usuarios, true);
  foreach ($usuariosArray as $usuario) {
    if ($usuario["email"] == $email) {
      return $usuarios;

    }
  }
  return NULL;
}
?>
