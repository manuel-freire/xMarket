<?php
    require_once($_SERVER['DOCUMENT_ROOT']. "/Aw2019/comun/Definitions.php");
    require_once (RAIZ . "negocio/Transfers/venta.php");
    require_once (RAIZ . "negocio/DataSource/SingletonDataSource.php");


    class DAOVenta {

        public static function insertarVenta($venta) {
            $data_source = DataSource::getSingleton();

            $sql = "INSERT INTO ventas ( `usuario`, `producto`,`fechaVenta`, `precioVenta`, `fueSubasta`) 
            VALUES (:usuario,:producto,:fechaVenta,:precioVenta,:fueSubasta)";

            $resultado = $data_source ->ejecutarActualizacion($sql,array(
                ':usuario' => $venta->getUsuario(),
                ':producto' => $venta->getProducto(),
                ':fechaVenta' => $venta->getFechaVenta(),
                ':precioVenta' => $venta->getPrecioVenta(),
                ':fueSubasta' => $venta->getFueSubasta()
            ));
            return $resultado;
        }
        public static function SelectVentasByFecha($fecha) // nos devuelve las ventas de un dia,mes, o un año concreto interactua con DAOTicket
    {
        $data_source = DataSource::getSingleton();

        $data_table = $data_source->ejecutarConsulta("SELECT * FROM ventas WHERE MONTH(fechaVenta) = :fecha " ,array(':fecha' => $fecha));
        $venta = null;
        $ventas = array();
        foreach ($data_table as $clave => $valor)
        {
             $venta = new Venta();
            $venta->setId($data_table[$clave]["ID"]);
            $venta->setUsuario($data_table[$clave]["usuario"]);
             $venta->setProducto($data_table[$clave]["producto"]);
              $venta->setFechaVenta($data_table[$clave]["fechaVenta"]);
               $venta->setPrecioVenta($data_table[$clave]["precioVenta"]);
                $venta->setFueSubasta($data_table[$clave]["fueSubasta"]);
              
           
            
            
           
            array_push($ventas,$venta);
        }
        return $ventas;
    }
    
    
    public static function SelectVentasByComprador($user) // nos devuelve las ventas de un dia,mes, o un año concreto interactua con DAOTicket
    {
        $data_source = DataSource::getSingleton();

        $data_table = $data_source->ejecutarConsulta("SELECT * FROM ventas WHERE usuario = :usuario",array(':usuario' => $user));
        $venta = null;
        $ventas = array();
        foreach ($data_table as $clave => $valor)
        {
         $venta = new Venta();
        $venta->setId($data_table[$clave]["ID"]);
        $venta->setUsuario($data_table[$clave]["usuario"]);
        $venta->setProducto($data_table[$clave]["producto"]);
        $venta->setFechaVenta($data_table[$clave]["fechaVenta"]);
        $venta->setPrecioVenta($data_table[$clave]["precioVenta"]);
        $venta->setFueSubasta($data_table[$clave]["fueSubasta"]);
              
           
           
            
            
           
            array_push($ventas,$venta);
        }
        return $ventas;
    }
   

      public static function SelectMaxVendedores() // nos devuelve los vendedores con mas ventas 
    {
        $data_source = DataSource::getSingleton();

        $data_table = $data_source->ejecutarConsulta("SELECT usuario , COUNT(usuario) AS topVendedores  FROM ventas  GROUP BY usuario ORDER BY COUNT(usuario) DESC LIMIT 0 , 6 ");
        $venta = null;
        $ventas = array();
        foreach ($data_table as $clave => $valor)
        {
             $venta = new Venta();
            
            $venta->setUsuario($data_table[$clave]["usuario"]); // me devulve los que mas ventas tienen
            array_push($ventas,$venta);
        }
        return $ventas;
    }

   
 }
?>