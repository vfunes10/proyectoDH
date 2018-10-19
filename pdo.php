<?php
$credenciales = file_get_contents("credenciales.json");

$credenciales = json_decode($credenciales, true);

$dsn = $credenciales["dsn"];
$usuario = $credenciales["usuario"];
$pass = $credenciales["password"];

try {
  $dbUsuarios = new PDO($dsn, $usuario, $pass);
  $dbUsuarios->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (\Exception $e) {
  echo "Error!";exit;
}
?>