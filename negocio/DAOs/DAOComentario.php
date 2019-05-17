<?php
    require_once('comun/config.php');
    require_once (RAIZ . "negocio/Transfers/comentario.php");
    require_once (RAIZ . "negocio/DataSource/SingletonDataSource.php");


    class DAOComentario {

        public static function insertComentario($comentario) {
            $data_source = DataSource::getSingleton();

            $sql = "INSERT INTO comentarios ( `queja_comentario`,`usuario`, `producto`, `comentario`) 
            VALUES (:tipo,:usuario,:producto,:comentario)";

            $resultado = $data_source ->ejecutarActualizacion($sql,array(
                ':tipo' => $comentario->getTipo(),
                ':usuario' => $comentario->getUsuario(),
                ':producto' => $comentario->getProducto(),
                ':comentario' => $comentario->getComentario()
            ));
            return $resultado;
        }
        public static function SelectComentarios() // nos devuelve los comentarios a un usuario
    {
        $data_source = DataSource::getSingleton();

        $data_table = $data_source->ejecutarConsulta("SELECT * FROM comentarios" );
        $comentario = null;
        $comentarios = array();
        foreach ($data_table as $clave => $valor)
        {
            $comentario = new Comentario();
            $comentario->setId($data_table[$clave]["ID"]);
            $comentario->setTipo($data_table[$clave]["queja_comentario"]);
            $comentario->setProducto($data_table[$clave]["producto"]);
            $comentario->setUsuario($data_table[$clave]["usuario"]);
            $comentario->setComentario($data_table[$clave]["comentario"]);
       
           
            array_push($comentarios,$comentario);
        }
        return $comentarios;
    }

    public static function SelectQuejas() // nos devuelve las quejas ----queja_producto = 1
    {
        $data_source = DataSource::getSingleton();

        $data_table = $data_source->ejecutarConsulta("SELECT * FROM comentarios WHERE queja_comentario = '1' " );
        $queja = null;
        $quejas = array();
        foreach ($data_table as $clave => $valor)
        {
            $queja = new Comentario();
            $queja->setId($data_table[$clave]["ID"]);
            $queja->setTipo($data_table[$clave]["queja_comentario"]);
            $queja->setProducto($data_table[$clave]["producto"]);
            $queja->setUsuario($data_table[$clave]["usuario"]);
            $queja->setComentario($data_table[$clave]["comentario"]);
            
              
           
            
            
           
            array_push($quejas,$queja);
        }
        return $quejas;
    }

     

    public static function deleteComentario($id_comentario)
    {
        $data_source = DataSource::getSingleton();

        $resultado = $data_source->ejecutarActualizacion("DELETE FROM comentarios WHERE
        ID = :id_comentario ", array(':id_comentario' => $id_comentario));
        return $resultado;
    }
    
    public static function estaComentado($idP, $idU){

        $data_source = DataSource::getSingleton();

        $data_table = $data_source->ejecutarConsulta("SELECT * FROM comentarios 
                WHERE producto = :producto AND usuario = :usuario", array(':producto' => $idP, ':usuario' => $idU));
        $comentario = null;
        foreach ($data_table as $clave => $valor)
        {
        $comentario = new Comentario();
        $comentario->setId($data_table[$clave]["ID"]);
        $comentario->setTipo($data_table[$clave]["queja_comentario"]);
        $comentario->setProducto($data_table[$clave]["producto"]);
        $comentario->setUsuario($data_table[$clave]["usuario"]);
        $comentario->setComentario($data_table[$clave]["comentario"]);
        }
        if($comentario != null) return true;
        else return false;
    }
    

   
 }
?>