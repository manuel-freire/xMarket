<?php
    require_once __DIR__.'/controller/UsuarioV.php';
    require_once __DIR__.'/controller/FormularioCredito.php';
    require_once __DIR__ . "/comun/Definitions.php";
     require_once (RAIZ . 'comun/config.php');
     $form = new FormularioCredito(); $a = $form->gestiona();
    $usuario = UsuarioV::selectUsuarioByNick($_SESSION['nombre']);
    if($usuario == null) {
        echo "<script>
                
                window.location.href='/Aw2019/loginForm.php';
              </script>";
    }
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

        <h2>Añadir crédito a mi cuenta</h2>

        <p>Crédito disponible: <?php echo $usuario->getCredito(); ?> </p>
            <?php  echo $a;?>

    </body>
</html>