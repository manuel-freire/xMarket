<?php
    require_once('comun/config.php');
    require_once (RAIZ . 'controller/FormularioProducto.php');
    require_once (RAIZ . 'comun/config.php');
    $form = new FormularioProducto(); $a = $form->gestiona();
    if(!isset($_SESSION['login'])) {
        echo "<script>
                window.location.href='/Aw2019/loginForm.php'; // usuario o contraseña incorrectos
            </script>";
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="estilo.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>XMarket</title>
        <link rel="stylesheet" href="assets/css/main.css" />
    </head>

    <body>
        <!-- MENÚ DE NAVEGACIÓN -->
        <?php
                if(isset($_SESSION['login'])  && isset($_SESSION["esAdmin"]) && ($_SESSION["login"]===true)) {
                    require ('comun/navAdmin.php');            
                } else {
                    require ('comun/nav.php');
                }
            ?>

        <!-- menu de categorias -->
        <?php require ('comun/selectCategories.php'); ?>

        <footer id="footer">
                <div class="inner">

                    <h3>¡Sube lo que quieras vender!</h3>
        
                    <?php  echo $a;?>
                </div>
        </footer>

    </body>
</html>