<?php
require_once('comun/config.php');
require_once(RAIZ ."negocio/DAOs/DAOSubasta.php");
require_once(RAIZ ."negocio/Transfers/subasta.php");


class SubastaV{

    public static function cargarSubastas(){
        $recurso = array();
	    $recurso = DAOsubasta::selectSubastas();
        return $recurso;
    }

    public static function insertaSubasta($subasta) {
        $inserta = DAOsubasta::insertaSubasta($subasta);
        if($inserta == '1') return true;
        else return false;
    }   

    public static function selectSubastaByIDProducto($idProducto) {
        $subasta = DAOsubasta::selectSubastaByIDProducto($idProducto);
        return $subasta;
    }
    public static function selectSubastaById($id_puja) {
        $subasta = DAOsubasta::selectSubastaById($id_puja);
        return $subasta;
    }

    public static function updateUltimaPuja($dinero,$id_user,$id_puja){
        $subasta = DAOsubasta::updateUltimaSubasta($dinero,$id_user,$id_puja);
        return $subasta;
    }

}
?>