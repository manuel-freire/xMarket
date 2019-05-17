<?php
    require_once __DIR__ . "/comun/Definitions.php";
    require_once (RAIZ . 'negocio/Transfers/usuario.php');
    require_once (RAI> . 'controller/UsuarioV.php');
    $usuario = new Usuario();
    $nombre = $_GET['nombre'];
    $usuario = UsuarioV::selectUsuarioByNick($nombre);
 
    if($restaurante != NULL) echo "existe";
    else echo "disponible";

?>