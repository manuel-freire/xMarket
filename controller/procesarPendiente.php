<?php
require_once('comun/config.php');
require_once(RAIZ ."negocio/DAOS/DAOProducto.php");
require_once(RAIZ ."negocio/Transfers/producto.php");
require_once(RAIZ ."negocio/Transfers/subasta.php");
require_once(RAIZ ."controller/SubastaV.php");
//Inicio del procesamiento

$operacion= isset($_POST['operacion']) ? $_POST['operacion'] : null;

$id= $_POST['id_prod'];
	if($operacion == "eliminar"){
            DAOProducto::deleteProducto($id);
            echo "<script>
                  alert('El producto ha sido eliminado de la lista ');  
                  window.location.href= '../productos.php?estado=1'; 
                  </script>";
      }
      else{ 
            DAOProducto::actualizaPendiente($id);
            $prod = DAOProducto::selectProductosById($id);
            if($prod->getSubasta() == '1'){
                  $subasta = new Subasta();
                  $subasta->setIDUsuario($_SESSION['id']);
                  
            
                  $subasta->setIDProducto($prod->getId());

                  $subasta->setPrecioOriginal($prod->getPrecio());
                  $subasta->setUltimaPuja($prod->getPrecio());

                  //falta tocar las fechas, que cuadren bien
                  date_default_timezone_set('Europe/Madrid');
                  $d = date('d'); $d = $d+7;
                  $m = date('m');
                  $y = date('y');
                  $subasta->setFechaVencimiento($y . '-' . $m . '-' . $d);
                  //aquí no se muy bien si poner un if con un alert en caso de que falle el insertarSubasta
                  //o borrar el producto de la tabla productos ya que se supone que es una subasta y no está en la tabla
                  //en un principio, no debería haber ningún problema.
                  SubastaV::insertaSubasta($subasta);
            }
            echo "<script>
                  alert('El producto ha sido añadido a ventas ');  
                  window.location.href= '../productos.php?estado=1'; 
                  </script>";
      }

     
       







?>