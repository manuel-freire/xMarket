<?php
require_once($_SERVER['DOCUMENT_ROOT']. "/Aw2019/comun/Definitions.php");
require_once(RAIZ ."negocio/DAOs/DAOUsuario.php");
require_once(RAIZ."negocio/Transfers/producto.php");
require_once(RAIZ ."negocio/Transfers/usuario.php");



class UsuarioV{   
   
    public static function cargarDatosUsuario(){
        $recurso = array();
         
            $recurso = DAOUsuario::selectUsuarios();
        
        return $recurso;
    }
	
	public static function crear($usuario) {
        $inserta = '0';
        if(DAOUsuario::searchUsuario($usuario->getNombre(), $usuario->getPass()) == NULL) {
            $inserta = DAOUsuario::insertUsuario($usuario);
        }
        if($inserta == '1') return true;
        else return false;
    }

    public static function selectUsuarioByNick($nombre) {
        $select = DAOUsuario::selectUsuarioByNickCorreo($nombre, '');
        return $select;
    }

    public static function selectUsuarioByID($id) {
        $select = DAOUsuario::selectUsuarioByID($id);
        return $select;
    }

    public static function actualiza($usuario) {
        $actualiza = DAOUsuario::actualiza($usuario);
        if($actualiza == '1') return true;
        else return false;
    }
     public static function editar_perfil($usuario,$id) {
        $actualiza = DAOUsuario::edita_perfil($usuario,$id);
        if($actualiza == '1') return true;
        else return false;
    }

    public static function selectUsuariosByValoracion() {
        $select = DAOUsuario::SelectUsuariosPorValoracion();
        return $select;
    }
}
?>