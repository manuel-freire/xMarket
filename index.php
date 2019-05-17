<?php

require_once('comun/config.php');

?>
<!DOCTYPE HTML>
<html>
    <head>
        <!--<link rel="stylesheet" type="text/css" href="estilo.css" /> -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="assets/css/main.css" />
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
            ?>

        <!-- menu de categorias -->
        <?php require ('comun/selectCategories.php'); ?>

    </body>
</html>