 <?php
     require_once('comun/config.php');
     require_once (RAIZ . 'comun/config.php');
    require_once (RAIZ . 'controller/FormularioLogin.php');

    $form = new FormularioLogin(); $a = $form->gestiona();
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Xmarket</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>
 		<!-- menu de navegacion -->
 		<?php require ('comun/nav2.php'); ?>

		<footer id="footer">
                <div class="inner">

                    <h3>¡Inicia sesión!</h3>
                    <?php  echo $a; ?>
                    

                </div>
            </footer>
		<!--fin del contendor-->
	</body>
</html>

 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 

 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
