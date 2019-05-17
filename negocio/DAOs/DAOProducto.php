<?php
require_once('comun/config.php');
require_once (RAIZ . "negocio/DAOs/Interfaces/IProducto.php");
require_once (RAIZ . "negocio/Transfers/producto.php");
require_once (RAIZ . "negocio/DataSource/SingletonDataSource.php");
class DAOProducto {
    
    public static function selectAllProductos() {
        $data_source = DataSource::getSingleton();


        $data_table = $data_source->ejecutarConsulta("SELECT * FROM productos");
        $producto = null;
        $productos = array();

        foreach ($data_table as $clave => $valor)
        {
			
            $producto = new Productos();
            $producto->setId($data_table[$clave]["ID"]);
            $producto->setNombre($data_table[$clave]["nombre"]);
            $producto->setCategoria($data_table[$clave]["categoria"]);
            $producto->setDescripcion($data_table[$clave]["descripcion"]);
            $producto->setPrecio($data_table[$clave]["precio"]);
            $producto->setPropietario($data_table[$clave]["usuarioPropietario"]);
            $producto->setImagen1($data_table[$clave]["img"]);
            $producto->setImagen2($data_table[$clave]["img2"]);
            $producto->setImagen3($data_table[$clave]["img3"]);
            $producto->setVendido($data_table[$clave]["vendido"]);
            $producto->setPendiente($data_table[$clave]["pendiente"]);

           
           
            array_push($productos,$producto);
        }
        return $productos;
    }
    public static function selectByCategoria($categoria) {
        $data_source = DataSource::getSingleton();


        $data_table = $data_source->ejecutarConsulta("SELECT * FROM productos WHERE categoria = :categoria AND vendido = '0' AND pendiente = '0'", array(':categoria' => $categoria));
        $producto = null;
        $productos = array();

        foreach ($data_table as $clave => $valor)
        {
            
            $producto = new Productos();
            $producto->setId($data_table[$clave]["ID"]);
            $producto->setNombre($data_table[$clave]["nombre"]);
            $producto->setCategoria($data_table[$clave]["categoria"]);
            $producto->setDescripcion($data_table[$clave]["descripcion"]);
            $producto->setPrecio($data_table[$clave]["precio"]);
            $producto->setPropietario($data_table[$clave]["usuarioPropietario"]);
            $producto->setImagen1($data_table[$clave]["img"]);
            $producto->setImagen2($data_table[$clave]["img2"]);
            $producto->setImagen3($data_table[$clave]["img3"]);
            $producto->setVendido($data_table[$clave]["vendido"]);
            $producto->setPendiente($data_table[$clave]["pendiente"]);

           
           
            array_push($productos,$producto);
        }
        return $productos;
    }


    public static function selectProductos($estado) // para no repetir la misma funcion meter un parametro de pendiente o no y eliminar la sieguiente
    {
        $data_source = DataSource::getSingleton();


        $data_table = $data_source->ejecutarConsulta("SELECT * FROM productos where pendiente = :est AND vendido = '0' " , array(':est' => $estado));
        $producto = null;
        $productos = array();

        foreach ($data_table as $clave => $valor)
        {
			
            $producto = new Productos();
            $producto->setId($data_table[$clave]["ID"]);
            $producto->setNombre($data_table[$clave]["nombre"]);
            $producto->setCategoria($data_table[$clave]["categoria"]);
            $producto->setDescripcion($data_table[$clave]["descripcion"]);
            $producto->setPrecio($data_table[$clave]["precio"]);
            $producto->setPropietario($data_table[$clave]["usuarioPropietario"]);
            $producto->setImagen1($data_table[$clave]["img"]);
            $producto->setImagen2($data_table[$clave]["img2"]);
            $producto->setImagen3($data_table[$clave]["img3"]);
            $producto->setVendido($data_table[$clave]["vendido"]);
            $producto->setPendiente($data_table[$clave]["pendiente"]);
            $producto->setSubasta($data_table[$clave]["subasta"]);

           
           
            array_push($productos,$producto);
        }
        return $productos;
    }
   
    
    public static function selectProductosById($id) {        
        $data_source = DataSource::getSingleton();

        $data_table = $data_source->ejecutarConsulta("SELECT * FROM productos WHERE ID = :id", array(':id' => $id));
        $producto = null;
        foreach ($data_table as $clave => $valor)
        {
            $producto = new Productos();
            $producto->setId($data_table[$clave]["ID"]);
            $producto->setNombre($data_table[$clave]["nombre"]);
            $producto->setCategoria($data_table[$clave]["categoria"]);
            $producto->setDescripcion($data_table[$clave]["descripcion"]);
            $producto->setPrecio($data_table[$clave]["precio"]);
            $producto->setPropietario($data_table[$clave]["usuarioPropietario"]);
            $producto->setImagen1($data_table[$clave]["img"]);
            $producto->setImagen2($data_table[$clave]["img2"]);
            $producto->setImagen3($data_table[$clave]["img3"]);
            $producto->setVendido($data_table[$clave]["vendido"]);
            $producto->setPendiente($data_table[$clave]["pendiente"]);
            $producto->setSubasta($data_table[$clave]["subasta"]);
        }

        return $producto;
    }    

    public static function selectLastProductoAñadido() {
        $idMayor = '0';
        $productos = DAOProducto::selectAllProductos();      
        foreach($productos as $valor) {
            if($valor->getId() > $idMayor){
                $idMayor = $valor->getId();
            }
        }
        $producto = DAOProducto::selectProductosById($idMayor);
        return $producto;
    }

    public static function insertProducto(Productos $producto)
    {
        $data_source = DataSource::getSingleton();

        $sql = "INSERT INTO productos ( `nombre`, `categoria`,`descripcion`, `precio`, `usuarioPropietario`, `img`, `img2`, `img3`, `vendido`, `pendiente`,`subasta`) 
        VALUES (:nombre,:categoria,:descripcion,:precio,:usuarioPropietario,:imagen1,:imagen2,:imagen3,:vendido,:pendiente,:subasta)";

        $resultado = $data_source ->ejecutarActualizacion($sql,array(
            ':nombre' => $producto->getNombre(),
            ':categoria' => $producto->getCategoria(),
            ':descripcion' => $producto->getDescripcion(),
            ':precio' => $producto->getPrecio(),
            ':usuarioPropietario' => $producto->getPropietario(),
            ':imagen1' => $producto->getImagen1(),
            ':imagen2' => $producto->getImagen2(),
            ':imagen3' => $producto->getImagen3(),
            ':vendido' => $producto->getVendido(),
            ':pendiente' => $producto->getPendiente(),
            ':subasta' => $producto->getSubasta()
        ));
        return $resultado;
    }
    
    public static function actualiza($producto) {
        $data_source = DataSource::getSingleton();

        $sql = "UPDATE productos SET vendido = :vendido, pendiente = :pendiente WHERE ID = :id";
        $resultado = $data_source ->ejecutarActualizacion($sql,array(
            ':vendido' => $producto->getVendido(),
            ':id' => $producto->getId(),
            ':pendiente' => $producto->getPendiente()
        ));
        return $resultado;
    }
    public static function actualizaPendiente($id) {
        $data_source = DataSource::getSingleton();

        $sql = "UPDATE productos SET pendiente = '0' WHERE ID = :id";
        $resultado = $data_source ->ejecutarActualizacion($sql,array(':id' => $id));
        return $resultado;
    }

    public static function deleteProducto($id)
    {
        $data_source = DataSource::getSingleton();

        $resultado = $data_source->ejecutarActualizacion("DELETE FROM productos WHERE
        ID = :id", array(':id' => $id));
        return $resultado;
    }
  
    
}
?>