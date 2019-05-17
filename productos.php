<?php
    require_once __DIR__ . '/controller/ProductoV.php';
    require_once __DIR__ . '/controller/ComentarioV.php';
    require_once('comun/config.php');
    require_once (RAIZ . 'comun/config.php');
   //estado = 0 --> productos disponibles, estado = 1--> productos pendientes, estado = 2 mis compras, estado = 3,4,5 libros,juguetes etc
    $estado = $_GET['estado'];
    $productos = array();
    if ($estado == '2'){
        $usuario = $_SESSION['id'];
        $productos = ProductoV::selectComprador($usuario);
    }
    else if($estado == '0' || $estado == '1')  $productos = ProductoV::cargarProductos($estado); // cambiar
    else if ($estado == '3') {
        $categoria = "libros";
         $productos = ProductoV::cargarProductosByCategoria($categoria);
    }

    else if ($estado =='4') {
        $categoria = "juguetes";
         $productos = ProductoV::cargarProductosByCategoria($categoria);
    }
    else{

        $categoria = "ropa";
       
        $productos = ProductoV::cargarProductosByCategoria($categoria);
         }

        
    
    
     
    
?>
<!DOCTYPE HTML>
<html>
    <head>
        <!--<link rel="stylesheet" type="text/css" href="estilo.css" /> -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>XMarket</title>
        <link rel="stylesheet" href="assets/css/main.css" />
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

        <!-- mostrar productos -->
        <?php if(empty($productos)) {
        ?>
            <h2> No hay productos! </h2>

            <p> Ahora mismo la aplicación no tiene ningún producto subido. Intentelo más tarde. </p>
        <?php 
        } else if($estado == '0' || $estado == '3'|| $estado == '4'|| $estado == '5'){
        ?>
        <section id="three" class="wrapper align-center">
                <div class="inner">
                    <div class="flex flex-2">
                        <?php
                    foreach($productos as $valor) {
                    ?> 
                        <article>
                            <div class="image round">
                                <img alt="Pic 01" src=<?php echo $valor->getImagen1();?>>
                            </div>
                            <header>
                                <h3><?php echo $valor->getNombre(); ?></h3>
                            </header>
                            <p><?php echo $valor->getPrecio();?> €</p>
                            <footer>
                                <a href="productoConcreto.php?id=<?php echo $valor->getId();?>" class="button">Más información</a>
                            </footer>
                        </article>
                    <?php
                    }
                    ?>
                        
                    </div>
                </div>
            
        <?php
        }else if ($estado == '1'){
        ?>
        ?>
        <section id="three" class="wrapper align-center">
                <div class="inner">
                    <div class="flex flex-2">
                        <?php
                    foreach($productos as $valor) {
                       
                        if($valor->getCategoria() == $_SESSION['categoria']){
                    ?> 
                        <article>
                            <div class="image round">
                                <img alt="Pic 01" src=<?php echo $valor->getImagen1();?>>
                            </div>
                            <header>
                                <h3><?php echo $valor->getNombre(); ?></h3>
                            </header>
                            <p><?php echo $valor->getPrecio();?> €</p>
                            <footer>

                                <a href="productoConcreto.php?id=<?php echo $valor->getId();?>" class="button">Más información</a>

                                <form  action="controller/procesarPendiente.php" method="POST">
        
                                  <input type="submit" name="operacion" value="eliminar">
                                  <input type="submit" name="operacion" value="aceptar">

                                <?php $pend = $valor->getId(); echo "<input type='hidden' name='id_prod' value='$pend'> "?>
                        
                      </form>
                            </footer>

                        </article>
                        <?php
        }
    }
        ?>
                        
                    </div>
                </div>
            
        <?php
        }
        else {
        ?>
        <section id="three" class="wrapper align-center">
                <div class="inner">
                    <div class="flex flex-2">
                        <?php
                    foreach($productos as $valor) {
                    ?> 
                        <article>
                            <div class="image round">
                                <img alt="Pic 01" src=<?php echo $valor->getImagen1();?>>
                            </div>
                            <header>
                                <h3><?php echo $valor->getNombre(); ?></h3>
                            </header>
                            <p><?php echo $valor->getPrecio();?> €</p>
                            <footer>
                                <a href="productoConcreto.php?id=<?php echo $valor->getId();?>" class="button">Más información</a>

                                <?php
                                    if(ComentarioV::estaComentado($valor->getId(), $_SESSION['id'])) {
                                ?>
                                 <a href="valorarComentarUser.php?id=<?php echo $valor->getId();?>" class="button">¿Quieres valorar a este usuario?</a>
                                <?php
                                }
                                ?>
                                  

                                <?php $pend = $valor->getId(); echo "<input type='hidden' name='id_prod' value='$pend'> "?>
                        
                     
                            </footer>
                        </article>
                    <?php
                    }
                    ?>
                        
                    </div>
                </div>
            
        <?php
        }
        ?>
    </body>
</html>