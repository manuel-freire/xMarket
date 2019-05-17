<?php
    
    require_once __DIR__.'/controller/UsuarioV.php';
    require_once('comun/config.php');
    require_once(RAIZ . 'comun/config.php');
    require_once __DIR__.'/controller/FormularioEditarPerfil.php';

    $form = new FormularioEditar(); $a = $form->gestiona();
         $usuario = UsuarioV::selectUsuarioByNick($_SESSION['nombre']);
                if(!isset($_SESSION['login'])) {
                     echo "<script>
                         window.location.href='/Aw2019/loginForm.php'; // usuario o contraseña incorrectos
                        </script>";
    

                    }
   

?>
<!DOCTYPE HTML>
<html>
    <head>
        <link rel="stylesheet" href="assets/css/main.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>XMarket</title>
    </head>

    <body>
        

        <?php
                if(isset($_SESSION['login'])  && isset($_SESSION["esAdmin"]) && ($_SESSION["login"]===true)) {
                    require ('comun/navAdmin.php');
            
                    
            
                } else {
                    require ('comun/nav.php');
            
                    
            
                }
            ?>

        <!-- menu de categorias -->
        <?php require ('comun/selectCategories.php'); ?>

        <div class="inner">  
<br>        
<img src="<?php echo  $usuario->getImagen()?>"  height="100" width="100"><br> 
<p>Si dejas un campo en blanco, este, no se modificara</p>
    <!--
    <form action="controller/procesarEditarPerfil.php" method="post">
        <p>Nombre de usuario: (introduce el nuevo) <input type="text" name="nombre"  ></p>
        <p>Email:(introduce el nuevo) <input type="text" name="email" ></p>
        <p>Direccion:(introduce el nuevo) <input type="text" name="direc" ></p>
        <p>Nueva contraseña: (introduce el nuevo)<input type="text" name="contraseña" ></p>
        <p>Repite contraseña: (introduce el nuevo)<input type="text" name="new_contraseña" ></p>
        <input type="submit" value="Enviar">
    </form>
    -->
    <?php echo $a;?>
 </div>

    </body>
    
</html>