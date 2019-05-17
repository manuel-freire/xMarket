<?php 

require_once('comun/config.php');
require_once(RAIZ ."negocio/DAOs/DAOSubasta.php");
require_once(RAIZ ."negocio/Transfers/subasta.php");
require_once(RAIZ ."controller/SubastaV.php");
require_once(RAIZ ."controller/UsuarioV.php");
require_once(RAIZ ."controller/ProductoV.php");

	
  
$id_puja = htmlspecialchars(trim(strip_tags($_POST['id_puja']))); 
$ult_puja =  htmlspecialchars(trim(strip_tags($_POST['ult_puja']))); 
$id_producto = htmlspecialchars(trim(strip_tags($_POST['id_producto'])));


//datos de la subasta
$subasta = SubastaV::selectSubastaById($id_puja);

$id_anterior_pujador = $subasta->getIDUsuario();

//datos del usuario logueado
$id_usuario = $_SESSION['id'];
$user_logged = UsuarioV::selectUsuarioByID($id_usuario);


//datos del usuario vendedor
$id_producto = $subasta->getIDProducto();
$producto = ProductoV::selectProductosByID($id_producto);
$id_vendedor = $producto->getPropietario();

$contErrores = 0;



//+*************************************** COMPROBACIONES **********************************************
if($id_usuario == $id_anterior_pujador)$contErrores++;//un usuario no uede pujar sobre su puja

if($id_usuario == $id_vendedor)$contErrores++; // un usuario no puede pujar si ha creado la subasta

if(!isset($_POST['euros'])|| is_null($_POST['euros'])||empty($_POST['euros'])){
  $contErrores++;
  
}
else{
  $dinero = htmlspecialchars(trim(strip_tags($_POST['euros'])));
  $dif = $dinero - $ult_puja;
  if($dif < 2){
    echo "No puedes pujar menos de dos euros";
    $contErrores++;
   
    }

}
//COMPROBAR CREDITO USUARIO

$credito = $user_logged->getCredito();
if($credito < $dinero){
   echo "No tienes suficiente credito, añade fondos";
   $contErrores++;
   
}
 echo $id_usuario . "-----" . $id_vendedor;
//********************************************** ACTUALIZACIÓN ***********************************************
if($contErrores != 0){
  if($id_usuario == $id_anterior_pujador){//un usuario no uede pujar sobre su puja
    $contErrores++;
    echo "<script>
    alert('No puedes pujar sobre tu propia puja');
       window.location.href='/Aw2019/productoConcreto.php?id=" . $id_producto . "'; 
       </script>";
  }
  else if($id_usuario == $id_vendedor){
    echo "<script>
    alert('No puedes pujar sobre tu propio producto');
       window.location.href='/Aw2019/productoConcreto.php?id=" . $id_producto . "'; 
       </script>";
  }
  else{
   
  echo "<script>
    alert('No tienes fondos o tu puja ha sido menor de 2€');
       window.location.href='/Aw2019/productoConcreto.php?id=" . $id_producto . "'; 
       </script>";
   }    
}
else{

  $credito_actual = $credito - $dinero;
  $user_logged->setCredito($credito_actual);//actualozamos el credito del usuario loggeado
  if (UsuarioV::actualiza($user_logged)){//si se actualiza correctamente...
    //cogemos la utlima puja que habia y le devolvemos el credito al usuario que corresponda
    
    $user_anterior_pujador = UsuarioV::selectUsuarioByID($id_anterior_pujador);//seleccionamos al usuario que fue el anterior pujador
    $nuevo_credito = $user_anterior_pujador->getCredito() + $ult_puja; // aumentamos su credito ya que han pujado más alto 
    $user_anterior_pujador->setCredito($nuevo_credito);
    if(UsuarioV::actualiza($user_anterior_pujador)){// si se actualiza correctamente
      //procedemos a actualizar el usuario que realizo la puja y el dinero nuevo de la subasta
      //actualizar campo de ultima puja y actualizar id del usuario
      SubastaV::updateUltimaPuja($dinero,$id_usuario,$id_puja);
      echo "<script>
      alert('La subasta ha sido actualizada');
       window.location.href='/Aw2019/productoConcreto.php?id=" . $id_producto . "'; 
       </script>";

    }
  }

  
 
}
  ?>
