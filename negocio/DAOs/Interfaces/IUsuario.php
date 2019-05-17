<?php

interface IUsuario{
    /*
    public static function selectUsuarios();
    public static function selectUsuarioByDni($id);
    */
    public static function insertUsuario(Usuario $usuario);
    //public static function deleteUsuario($id);
    
    public static function searchUsuario($id,$password);
}
?>