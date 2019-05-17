<?php
require_once('comun/config.php');

require_once (RAIZ . "negocio/Transfers/moderador.php");
require_once (RAIZ . "negocio/DataSource/SingletonDataSource.php");
class DAOModerador {
    
    public static function selectModeradores()
    {
        $data_source = DataSource::getSingleton();


        $data_table = $data_source->ejecutarConsulta("SELECT * FROM moderadores");
        $moderador = null;
        $moderadores = array();

        foreach ($data_table as $clave => $valor)
        {
			
            $moderador = new Moderador();
            $moderador->setId($data_table[$clave]["usuario"]);
            $moderador->setCategoria($data_table[$clave]["categoria"]);
            

           
           
            array_push($moderadores,$moderador);
        }
        return $moderadores;
    }
    public static function selectModerador($id) {      
        $data_source = DataSource::getSingleton();

        $data_table = $data_source->ejecutarConsulta("SELECT * FROM moderadores WHERE usuario = :usuario", array(':usuario' => $id));
        $moderador = null;
        foreach ($data_table as $clave => $valor)
        {
            $moderador = new Moderador();
            $moderador->setId($data_table[$clave]["usuario"]);
            $moderador->setCategoria($data_table[$clave]["categoria"]);
            
        }

        return $moderador;
    }
    public static function selectModeradorByCategoria($categoria) {     // si esta consulta devuelve null es que no hay moderador para esa categoria   
        $data_source = DataSource::getSingleton();

        $data_table = $data_source->ejecutarConsulta("SELECT * FROM moderadores WHERE categoria = :categoria", array(':categoria' => $categoria));
        $moderador = null;
        foreach ($data_table as $clave => $valor)
        {
            $moderador = new Moderador();
            $moderador->setId($data_table[$clave]["usuario"]);
            $moderador->setCategoria($data_table[$clave]["categoria"]);
            
        }

        return $moderador;
    }    


    public static function insertModerador(Moderador $moderador)
    {
        $data_source = DataSource::getSingleton();

        $sql = "INSERT INTO moderadores ( `usuario`, `categoria`) 
        VALUES (:nombre,:categoria)";

        $resultado = $data_source ->ejecutarActualizacion($sql,array(
            ':nombre' => $moderador->getId(),
            ':categoria' => $moderador->getCategoria()
            
        ));
        return $resultado;
    }
    
    public static function actualizaModerador($categoria,$moderador) { // para cambiar el moderador de una categoria
        $data_source = DataSource::getSingleton();

        $sql = "UPDATE moderadores SET usuario = :usuario  WHERE categoria = :categoria";
        $resultado = $data_source ->ejecutarActualizacion($sql,array(
            ':usuario' => $moderador,
            ':categoria' => $categoria
          
        ));
        return $resultado;
    }

    public static function deleteModerador($id) // elimino un moderador, la categoria ya no va a aparecer por lo tanto esa categoria de momento no tiene moderador
    {
        $data_source = DataSource::getSingleton();

        $resultado = $data_source->ejecutarActualizacion("DELETE FROM moderadores WHERE
        usuario = :usuario", array(':usuario' => $id));
        return $resultado;
    }


  
    
}
?>