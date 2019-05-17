<?php
require_once($_SERVER['DOCUMENT_ROOT']. "/aw2019/comun/Definitions.php");
require_once(RAIZ ."negocio/DAOs/DAOProducto.php");
require_once(RAIZ ."negocio/DAOs/DAOVenta.php");
require_once(RAIZ ."negocio/Transfers/producto.php");




class ProductoV{

    public static function cargarProductos($estado){
        $recurso = array();
    
	    $recurso = DAOProducto::selectProductos($estado);
		
        return $recurso;
    }

    public static function cargarProductosByCategoria($categoria){
        $recurso = array();
    
        $recurso = DAOProducto::selectByCategoria($categoria);
        
        return $recurso;
    }
   
    public static function crear($producto) {
        $inserta = DAOProducto::insertProducto($producto);
        if($inserta == '1') return true;
        else return false;
    }

    public static function selectProductosByID($id) {
        $producto = DAOProducto::selectProductosByID($id);
        return $producto;
    }

    public static function actualiza($producto) {
        $actualiza = DAOProducto::actualiza($producto);
        if($actualiza == '1') return true;
        else return false;
    }

    public static function actualizaPendiente($producto) {
        $actualiza = DAOProducto::actualizaPendiente($producto);
        if($actualiza == '1') return true;
        else return false;
    }

    public static function delete($producto) {
        $actualiza = DAOProducto::deleteProducto($producto);
        if($actualiza == '1') return true;
        else return false;
    }


    public static function selectComprador($user){
     $ventas = DAOVenta::SelectVentasByComprador($user);
      $productos = array(); 
     if($ventas != null){
        
        foreach ($ventas as $clave => $valor)
        {

           $producto = DAOProducto:: selectProductosById($valor->getProducto());
            array_push($productos,$producto);
        }
     }
            return $productos;
    }

   
   

}
?>