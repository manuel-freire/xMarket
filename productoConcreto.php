<?php
    
    require_once __DIR__ . "/comun/Definitions.php";
    require_once (RAIZ . 'comun/config.php');
    require_once (RAIZ . "negocio/Transfers/producto.php");
    require_once (RAIZ . "controller/ProductoV.php");

    require_once (RAIZ . "negocio/Transfers/usuario.php");
    require_once (RAIZ . "controller/UsuarioV.php");

    require_once (RAIZ . "negocio/Transfers/subasta.php");
    require_once (RAIZ . "controller/SubastaV.php");

    $id = $_GET['id'];
    $producto = ProductoV::selectProductosByID($id);
    if($producto == null) {
        echo "<script>
                
                window.location.href='/Aw2019/index.php'; //Producto no encontrado. Intentelo más tarde.
              </script>";
    }

    $idPropietario = $producto->getPropietario();
    $usuario = UsuarioV::selectUsuarioByID($idPropietario);
    $subasta = SubastaV::selectSubastaByIDProducto($producto->getId());

?>
<!DOCTYPE HTML>
<html>
    <head>
        <!--<link rel="stylesheet" type="text/css" href="estilo.css" /> -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="assets/css/main.css" />
        <!-- <link rel="stylesheet" href="assets/css/main.css" /> -->
		<title>XMarket</title>
    </head>

    <body>
        <!-- menú de navegación -->
        <?php require ('comun/nav.php'); ?>
        <?php require ('comun/selectCategories.php'); ?>


        <div class="inner">
        <div class="box">
            <h2><?php echo $producto->getNombre();?></h2>
                        <div class="box alt">
                            <div class="row 50% uniform">
                                <div class="4u"><span class="image fit"><img src="<?php echo $producto->getImagen1();?>" alt="" /></span></div>
                                
                            </div>
                        </div>

                        <h4>Detalles</h4>



            <div class="6u 12u$(small)">

                                            
                                            <ul>
                                                <li>Vendedor/a:  <?php echo $usuario->getNombre(); ?><a href="perfilOtroUser.php?id=<?php echo $idPropietario; ?>".>(Perfil) </a></li>
                                                <li>Descripción del producto: <?php echo $producto->getDescripcion();?></li>
                                                <?php



                                                if(isset($_SESSION['esModerador'])  && ($_SESSION["esModerador"]===true)||isset($_SESSION['login'])  && ($_SESSION["login"]===true)){

                                                        if($producto->getVendido() != '1'){
                                                          if($subasta == null ) { //es una venta
                                                    ?>
                                                    Precio : <?php echo $producto->getPrecio(); ?>
                <!-- comprar un producto -->    
                                                
                                                    <button type="submit" id="submit" 
                                                     onclick="window.location.href='controller/comprarProducto.php?id=<?php echo $producto->getID();?>'">Comprar</button>

                                                               <?php
                                                                              } else { //es una subasta
                                                                                     ?>  <form action="controller/procesarSubasta.php" method="post">
                                                                                           Última puja: <?php echo $subasta->getUltimaPuja(); ?> €
                                                                                        Realiza tu puja (€): <input type="number" name="euros" >
                                                                                       <input type="hidden" name="id_producto" value="<?php echo $producto->getID();?>">
                                                                                       <input type="hidden" name="id_puja" value="<?php echo $subasta->getId();?>">
                                                                                       <input type="hidden" name="ult_puja" value="<?php echo $subasta->getUltimaPuja();?>">
                                                                                        <button type="submit" id="submit"  onclick="">Pujar</button>
                                                                                         </form>
        <?php
            }
        }
        }
        ?>
                                            </ul>


        </div>

        

        
        

         <?php if($producto->getImagen2() != null) {
        ?>
            <img src= <?php echo $producto->getImagen1();?> alt="Imagen2" >
        <?php
        }
        ?>
        <!-- Imagen 3 -->
        <?php if($producto->getImagen2() != null) {
        ?>
            <img src= <?php echo $producto->getImagen1();?> alt="Imagen3">
        <?php
        }
        ?> 
        </div>





        </div>
        
        
        
        <!-- Imagen 2 -->
        

       
    </body>
</html>