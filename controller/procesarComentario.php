<?php 

require_once('comun/config.php');
require_once(RAIZ . "negocio/Transfers/comentario.php");
require_once(RAIZ. "negocio/DAOs/DAOComentario.php");




if(!isset($_POST['comentarios'])|| is_null($_POST['comentarios'])||empty($_POST['comentarios'])){
	header("Location: ../index.php");
	
}
else{
$texto =htmlspecialchars(trim(strip_tags($_POST['comentarios'])));
$id_prod = htmlspecialchars(trim(strip_tags($_POST['producto'])));
$operacion= isset($_POST['operacion']) ? $_POST['operacion'] : null;
$id = $_SESSION['id']; // usuario que comenta
//$valoracion =$_POST['estrellas'];

 $comentario = new Comentario();
if($operacion == "Enviar como queja") $comentario->setTipo('1'); // se trata de una queja
else $comentario->setTipo('0');

$comentario->setUsuario($id);
$comentario->setProducto($id_prod);
$comentario->setComentario($texto);



$a = DAOComentario::insertComentario($comentario); 
}
header("Location: ../index.php");



?>