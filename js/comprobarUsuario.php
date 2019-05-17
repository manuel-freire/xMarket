<?php
    require_once('comun/config.php');
    require_once (RAIZ . 'negocio/Transfers/usuario.php');
    require_once (RAIZ . 'controller/UsuarioV.php');
    $usuario = new Usuario();
    $nombre = $_GET['nombre'];
    $usuario = UsuarioV::selectUsuarioByNick($nombre);
 
    if($restaurante != NULL) echo "existe";
    else echo "disponible";

?>