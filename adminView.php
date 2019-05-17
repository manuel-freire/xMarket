<?php

// SCRIPT DE LA VISTA DEL CATALOGO DE RUTAS DE LA APLICACION.
require_once('comun/config.php');
require_once(RAIZ . 'comun/config.php');
require_once (RAIZ."controller/ModeradorV.php");
require_once(RAIZ ."negocio/Transfers/moderador.php");
require_once (RAIZ."controller/UsuarioV.php");
require_once(RAIZ ."negocio/Transfers/usuario.php");
/*require_once(RAIZ ."controller/ventasV.php");
require_once (RAIZ."controller/ProductoV.php");
require_once(RAIZ ."negocio/Transfers/moderador.php");
require_once (RAIZ."controller/ModeradorV.php");
*/
$idP = null;
     $moderador = new ModeradorV();
     $usuario = new UsuarioV();
     $moderadores = $moderador->cargarModeradores();
	   $mejorValorados = $usuario->selectUsuariosByValoracion();
?>

<!DOCTYPE html>
<html>
<head>
	
	 <title>xmarket: </title>

    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css"  href="assets/css/main.css"> 

</head>

<body>

  <?php require("comun/navAdmin.php");?>
  <section id="banner">
    <div class="inner">
    <header>

      <h1>Panel de Administración</h1>

      <div class="box">
                    <p>Desde está vista tendrá la posibilidad de hacer un seguimiento completo de la página web:</p>
                    <p>Gestionar alta/baja moderadores</p>
                    <p>Ver resumen de ventas</p>
                    <p>Acceder al buzón de sugerencias/quejas de usuarios</p>
                  </div>
      
      
    </header>
    
        <div class="flex ">
  </div>
</section>



<div class="inner">          


  <h2>Usuarios mejor valorados</h2>
                  <div class="table-wrapper">
                    <table>
                      <thead>
                        <tr>
                          <th>Usuario</th>
                          <th>Elegir Categoria</th>
                          <th>Añadir moderador</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php

                        foreach($mejorValorados as $clav => $value){
        $idusuario = $mejorValorados[$clav]->getId();
        $nameUsuario = $mejorValorados[$clav]->getNombre();
        ?>
                        <tr>
                          <td><?php echo  $idusuario .  ' '.$nameUsuario;?></td>
                          <td><form id="admin_mode" action="controller/procesarModerador.php" method="POST">
        
       
        <?php echo "<input type='hidden' name='moderador' value='$idusuario'> "?>
             <select class="formProducto" name = "categoria" required>
           <option style="display:none" value = "nada">Elige una categoría</option>
           <option value="libros">Libros</option>
           <option value="juguetes">Juguetes</option>
           <option value="ropa">Ropa</option>
       </select>
       </td>
        
                          <td><input type="submit" name="operacion" value="Añadir moderador">
      </td>
                        </tr>
        </form></td>
                        <?php
                      }
                      ?>
                      </tbody>
                    </table>
                  </div>




                  <h2>Lista de Moderadores</h2>
                  <div class="table-wrapper">
                    <table>
                      <thead>
                        <tr>
                          <th>Categoria</th>
                          <th>Moderador</th>
                          <th>Agregar Moderador</th>
                        </tr>
                      </thead>


                      <tbody>
                        <?php
      
   
     foreach($moderadores as $clave => $valor){
  
       /*echo "<div class='admin_prod'>";
             echo '<img src="data:image/jpeg;base64,'.base64_encode($imagen).'" width="200" height="200"/>';
           
      */
             
      $idP = $moderadores[$clave]->getId();
               $usuarioT= $usuario->selectUsuarioByID($idP);
?>
                        <tr>
                          <td><?php echo $moderadores[$clave]->getCategoria()?></td>
                          <td><?php echo $usuarioT->getNombre() ?><a href="perfilOtroUser.php?id=<?php echo $idP; ?>".> (perfil) </a></td>
                          <td><form id="admin_form" action="controller/procesarModerador.php" method="POST">
        
                      <input type="submit" name="operacion" value="eliminar">
                         <?php echo "<input type='hidden' name='usuario' value='$idP'> "?>
                        
                      </form></td>
                        </tr>

                        <?php
                      }

                      ?>
                        
                    </table>
                  </div>
             </div>

	 
</body>
</html>