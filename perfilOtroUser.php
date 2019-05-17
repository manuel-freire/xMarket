<?php
    require_once __DIR__.'/controller/UsuarioV.php';
    require_once('comun/config.php');
    require_once (RAIZ . 'comun/config.php');


    $id=-1;

    if(isset($_SESSION['esAdmin'])==true||isset($_SESSION['login'])==true){
       
        
             $id=$_GET['id'];

             if($id!=-1){
                $usuario=UsuarioV::selectUsuarioByID($id);
            }else{
                echo "<script>
                window.location.href='/Aw2019/productos.php'; 
            </script>";
            }
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

        <footer id="footer">
                <div class="inner">

                    <header class="align-center">
                        <h2><?php echo  $usuario->getNombre();
                        
                            
                        ?></h2>
                        <p>Credito disponible: <?php if(isset($_SESSION['esAdmin'])==true){ echo $usuario->getCredito();}?></p>
                        <p>Para añadir crédito, pulse <a href=aportarCredito.php>aquí</a></p>
                        <p>Consulta tu historial de productos comprados, vendidos, comentarios...</p>
                    </header>
                    <div class="table-wrapper">
                        <table>
                            <tbody>
                                <tr>
                                    <th>Consultas sobre tu perfil</th>
                                    <th>Cantidad</th>                                                    
                                </tr>
                                <tr>
                                    <td>Productos vendidos</td>
                                    <td>-</td>                                                    
                                </tr>
                                <tr>
                                    <td>Productos comprados</td>
                                    <td>-</td>                                                    
                                </tr>
                                <tr>
                                    <td>Comentarios míos</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Comentarios sobre mí</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Productos favoritos</td>
                                    <td>-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>                    

                </div>
            </footer>
    </body>
</html>