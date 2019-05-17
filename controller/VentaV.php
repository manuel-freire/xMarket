<?php
    require_once($_SERVER['DOCUMENT_ROOT']. "/Aw2019/comun/Definitions.php");
    require_once(RAIZ ."negocio/DAOs/DAOVenta.php");
    require_once(RAIZ ."negocio/Transfers/Venta.php");



    class VentaV{   
    
        public static function insertarVenta($venta) {
            $inserta = DAOventa::insertarVenta($venta);
            if($inserta == '1') return true;
            else return false;
        }

         public static function selectVentaByFecha($fecha) { // devuelve el numero de ventas en un mes concreto
            $recurso = DAOventa::SelectVentasByFecha($fecha);
            $ventas = count($recurso);
            return $ventas;  
           
        }

        public static function recaudacion($fecha){ // total de recaudacion 
         $recurso = DAOVenta::SelectVentasByFecha($fecha);
        $total = 0;
        foreach ($recurso as $key => $value) {
         $total = $total + $recurso[$key]->getPrecioVenta();
        }

            return $total;
     }
      public static function maxVendedores(){ // total de recaudacion 
         $recurso = DAOVenta::SelectMaxVendedores();
        
        return $recurso;
     }

     

    }
?>