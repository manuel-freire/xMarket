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
        <h4>¿Quiénes somos?</h4>
            <p>
                <span class="image left"><img src="img/pic02.jpg" alt="" /></span>Somos el grupo 2 de la asignatura AW de la facultad de
             Ingenieria informática de Universidad Comlutense de Madrid
            </p>
            <p>Este proyecto es un "placemarket" donde los usuarios se pueden registrar para comprar y vender ropa, libros y juguetes.</p>

    

        
    </body>
</html>