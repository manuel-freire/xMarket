<?php
require_once('comun/config.php');
require_once(RAIZ ."negocio/DAOs/DAOUsuario.php");
require_once(RAIZ ."negocio/DAOs/DAOProducto.php");
require_once(RAIZ ."negocio/DAOs/DAOComentario.php");
require_once(RAIZ."negocio/Transfers/producto.php");
require_once(RAIZ ."negocio/Transfers/usuario.php");
require_once(RAIZ ."negocio/Transfers/comentario.php");



class ComentarioV{   
   
    public static function insertComentario($comentario){
        
         
            $actualiza = DAOComentario:: insertComentario($comentario);
             if($actualiza == '1') return true;
        else return false;
       
    }
	
	public static function selectComentariosAUsuario($user){
     $comentarios = DAOComentario::SelectComentarios();
       $lista = array();
     if($comentarios != null){
        
        foreach ($comentarios as $clave => $valor)
        {

           $producto = DAOProducto:: selectProductosById($valor->getProducto());
           $id_usuario = $producto->getPropietario();
           if($id_usuario == $user) array_push($lista, $valor);
            
        }
     }
            return $lista; // devuelve un array de comentarios
    }

    public static function deleteComentario($id_comentario) {
        $select = DAOComentario::deleteComentario($id_comentario);
        if($select == '1') return true;
        else return false;
    }
 
    public static function SelectQuejas() { //devuelve los comentarios de un producto
        
        
            $select = DAOComentario::SelectQuejas();
            return $select;
    }
    
    public static function estaComentado($id_producto, $id_usuario){

        $select = DAOComentario::estaComentado($id_producto, $id_usuario);
            return $select;

    }
    
}
?>