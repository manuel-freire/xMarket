<?php
require_once('comun/config.php');
require_once(RAIZ . 'comun/config.php');
//Doble seguridad: unset + destroy
unset($_SESSION["login"]);
unset($_SESSION["id"]);
unset($_SESSION["nombre"]);
if(isset($_SESSION['esAdmin'])) unset($_SESSION["esAdmin"]);
if(isset($_SESSION['esModerador'])) unset($_SESSION["esModerador"]);

session_destroy();

header('Location: /Aw2019/index.php');
?>