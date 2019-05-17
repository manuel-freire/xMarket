<?php
    require_once __DIR__.'/controller/UsuarioV.php';
    require_once __DIR__.'/controller/ProductoV.php';
    require_once __DIR__.'/negocio/Transfers/producto.php';
    require_once('comun/config.php');


    $id=$_GET['id'];
    $producto =  ProductoV::selectProductosByID($id);
    $id_propietario = $producto->getPropietario();
    $usuario=UsuarioV::selectUsuarioByID($id_propietario);
         
    
   

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

        <section id="three" class="wrapper align-center">
                <div class="inner">
                    <div class="flex flex-2">
                       
                        <article>
                            <div class="image round">
                            	<?php $idP =  $producto->getId(); ?>
                            	<h3>Valora tu expeiencia tras la compra de este producto</h3>
                            	<header>

                                <h3><?php echo $producto->getNombre(); ?></h3>
                            </header>
                                
                            </div>
                            
                            
                            <footer>
                            	<img alt="Pic 01" src=<?php echo $producto->getImagen1();?>>
                            </footer>

                        </article>
                    
                        
                    </div>

                    <form action="controller/procesarComentario.php" method="POST">

    				<span  id ="Estrellas" > </span>

					<br> <textarea name="comentarios"  placeholder="Escirba su comentario o queja a este usuario "></textarea> 

					
                     <?php echo "<input type='hidden' name='producto' value='$idP'> "?>

                     <input type="submit" name="operacion" value="Enviar como queja">
		            <input type="submit" name="operacion" value="Enviar comentario">
					
					</form>
                </div>
                <script>
                    $('#Estrellas').starrr({
   	                change :function(e,valor){
   		            $valoracion =  valor;
   	                }
                    });
                </script>

        <footer id="footer">
                <div class="inner">
                	<h3> Vendedor </h3>
                    <header class="align-center">
                        <img src="<?php echo  $usuario->getImagen()?>"  height="100" width="100"><br>          
                        <p><?php echo  $usuario->getNombre()?></p>
                        <p>Cuenta de correo: <?php echo  $usuario->getEmail()?></p>
                    </header>
                                   

                </div>
            </footer>
    </body>
</html>