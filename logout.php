<?php

session_start();
session_destroy();

setcookie("usuarioLogueado", null, -1);

header("location:index.php");exit;

?>
