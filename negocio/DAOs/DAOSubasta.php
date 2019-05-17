<?php
require_once($_SERVER['DOCUMENT_ROOT']. "/Aw2019/comun/Definitions.php");
require_once ("Interfaces/ISubasta.php");
require_once (RAIZ . "negocio/DataSource/SingletonDataSource.php");
require_once (RAIZ . "negocio/Transfers/subasta.php");

class DAOsubasta implements ISubasta{

     public static function cargarSubastas()
    {
        $data_source = DataSource::getSingleton();

        $data_table = $data_source->ejecutarConsulta("SELECT * FROM subastas");
        $subasta = NULL;
        $subastas = array();
        if($data_table != NULL)
        {
           
            foreach($data_table as $clave => $valor)
            {
                $subasta = new subasta();
                $subasta->setID($data_table[$clave]["ID"]);
                $subasta->setIDUsuario($data_table[$clave]["usuario"]);
                $subasta->setIDProducto($data_table[$clave]["producto"]);
                $subasta->setPrecioOriginal($data_table[$clave]["precioOriginal"]);
                $subasta->setUltimaPuja($data_table[$clave]["ultimaPuja"]);
                $subasta->setFechaVencimiento($data_table[$clave]["fechaVencimiento"]);    
                
                array_push($subastas, $subasta);
            }
        }
        
        return $subastas;
    }
    
    public static function insertaSubasta(Subasta $subasta)
    {
        $data_source = DataSource::getSingleton();

        $sql = "INSERT INTO subastas (`usuario`, `producto`, `precioOriginal`, `ultimaPuja`, `fechaVencimiento`)
            VALUES (:usuario, :producto, :precioOriginal, :ultimaPuja, :fechaVencimiento)";
        
        $resultado = $data_source ->ejecutarActualizacion($sql,array(
            ':usuario' => $subasta->getIDUsuario(),
            ':producto' => $subasta->getIDProducto(),
            ':precioOriginal' => $subasta->getPrecioOriginal(),
            ':ultimaPuja' => $subasta->getUltimaPuja(),
            ':fechaVencimiento' => $subasta->getFechaVencimiento()
            )
        );
        return $resultado;
    }

    public static function selectSubastaByIDProducto($idProducto) {
        $data_source = DataSource::getSingleton();

        $data_table = $data_source->ejecutarConsulta("SELECT * FROM subastas WHERE producto = :idProducto", 
                array(":idProducto" => $idProducto));
        $subasta = NULL;
        if($data_table != NULL)
        {
           
            foreach($data_table as $clave => $valor)
            {
                $subasta = new subasta();
                $subasta->setID($data_table[$clave]["ID"]);
                $subasta->setIDUsuario($data_table[$clave]["usuario"]);
                $subasta->setIDProducto($data_table[$clave]["producto"]);
                $subasta->setPrecioOriginal($data_table[$clave]["precioOriginal"]);
                $subasta->setUltimaPuja($data_table[$clave]["ultimaPuja"]);
                $subasta->setFechaVencimiento($data_table[$clave]["fechaVencimiento"]);    
            }
        }
        
        return $subasta;
    }
   
public static function selectSubastaById($id_puja) {
        $data_source = DataSource::getSingleton();

        $data_table = $data_source->ejecutarConsulta("SELECT * FROM subastas WHERE ID = :id_puja", 
                array(":id_puja" => $id_puja));
        $subasta = NULL;
        if($data_table != NULL)
        {
           
            foreach($data_table as $clave => $valor)
            {
                $subasta = new subasta();
                $subasta->setID($data_table[$clave]["ID"]);
                $subasta->setIDUsuario($data_table[$clave]["usuario"]);
                $subasta->setIDProducto($data_table[$clave]["producto"]);
                $subasta->setPrecioOriginal($data_table[$clave]["precioOriginal"]);
                $subasta->setUltimaPuja($data_table[$clave]["ultimaPuja"]);
                $subasta->setFechaVencimiento($data_table[$clave]["fechaVencimiento"]);    
            }
        }
        
        return $subasta;
    }

   public static function updateUltimaSubasta($ult_puja,$id_user,$id_puja) {
        $data_source = DataSource::getSingleton();

        $sql = "UPDATE subastas SET ultimaPuja = :ult_puja , usuario = :id_user WHERE ID = :id_puja";
        $resultado = $data_source ->ejecutarActualizacion($sql,array(
            ':id_user' => $id_user,
            ':ult_puja' => $ult_puja,
            ':id_puja' => $id_puja
            
        ));
        return $resultado;
    }
}
?>