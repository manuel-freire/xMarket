<?php
    require_once __DIR__.'/controller/UsuarioV.php';
    require_once('comun/config.php');
    require_once (RAIZ . 'comun/config.php');
    

    
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


  <h2><?php if(isset($_SESSION['esAdmin'])!=true){echo 'Bienvenido a tu perfil '. $usuario->getNombre();}else{
                            echo'Bienvenido Admin a tu perfil';};
                        
                            
                        ?></h2>
    
    <img src="<?php echo  $usuario->getImagen()?>"  height="100" width="100"><br>          
    <p><?php echo  $usuario->getNombre()?></p>
    <p>Cuenta de correo: <?php echo  $usuario->getEmail()?></p>
    <p>Direccion: <?php echo  $usuario->getDireccion()?></p>
    <a  href="editPerfil.php"><img src="img/edit_perfil.svg" height="20" width="20"/></a>
    <h2>Credito: <?php if(isset($_SESSION['esAdmin'])!=true){ echo $usuario->getCredito();}?></h2>
    <p> ¿Quieres añadir mas credito? pincha  <a href=aportarCredito.php>aquí</a></p>
                                                           
    <a href="productos.php?estado=2">Mis compras</a>
                     



                 
             </div>

    </body>
    
</html>