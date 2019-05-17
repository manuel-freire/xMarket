<?php
require_once('comun/config.php');
require_once(RAIZ ."negocio/DAOs/DAOModerador.php");
require_once(RAIZ."negocio/Transfers/moderador.php");
require_once(RAIZ ."negocio/Transfers/usuario.php");



class ModeradorV{   
   
    public static function cargarModeradores(){
        $recurso = array();
         
            $recurso = DAOModerador::selectModeradores();
        
        return $recurso;
    }
    public static function cargarUsuarioModerador($id){ // carga los datos completos del usuario en funcion del moderador tengo que combinarlo con la funcion de DAOusuario en la vista para no cargarme el patron MVC
        $recurso = array();
         
            $recurso = DAOModerador::selectModerador($id);
        
        return $recurso;
    }
	

     public static function cargarModeradorByCategoria($categoria){ // si es null es que la categoria no tiene moderador 
        $recurso = array();
         
            $recurso = DAOModerador::selectModeradorByCategoria($categoria);

        
        return $recurso;
    }
	public static function crearModerador($moderador) { // el objeto moderador tiene un usuario y una categoria
        $inserta = '0';
        if(DAOModerador::selectModerador($id) == NULL) {
            $inserta = DAOModerador::insertModerador($moderador);
        }
        if($inserta == '1') return true;
        else return false;
    }

   

    public static function actualizaModeradorr($moderador,$categoria) { // el objeto moderador tiene un usuario y una categoria
        $inserta = '0';
        if(DAOModerador::selectModerador($id) == NULL) {
            $inserta = DAOModerador::actualizaModerador($categoria,$moderador) ;
        }
        if($inserta == '1') return true;
        else return false;
    }

    public static function borraModerador($usuario) {
       $inserta = '0';
        if(DAOModerador::selectModerador($id) == NULL) {
            $inserta = DAOModerador::deleteModerador($id) ;
        }
        if($inserta == '1') return true;
        else return false; // no se pudo borrar el moderador 
    }
}
?>