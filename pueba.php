<?php

require_once($_SERVER['DOCUMENT_ROOT']. "/Aw2019/comun/Definitions.php");
require_once(RAIZ . 'comun/config.php');
?>
<!DOCTYPE HTML>
<html>
    <head>
        <!--<link rel="stylesheet" type="text/css" href="estilo.css" /> -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="assets/css/main.css" />
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/validar.js"></script>
		<title>XMarket</title>
    </head>

    <body>
        <!-- menú de navegación -->

        <?php
                if(isset($_SESSION['login'])  && isset($_SESSION["esAdmin"]) && ($_SESSION["login"]===true)) {
                    require ('comun/navAdmin.php');                   
            
                } else {
                    require ('comun/nav.php');
            
                }

                require ('comun/selectCategories.php');
            ?>

        <input type="text" name="prueba" id="prueba">
        <input type="text" name="nombre" id="nombre">

    </body>
</html>