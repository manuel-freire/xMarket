<?php
require_once($_SERVER['DOCUMENT_ROOT']. "/Aw2019/comun/Definitions.php");
require_once ("Interfaces/IUsuario.php");
require_once (RAIZ . "negocio/DataSource/SingletonDataSource.php");
require_once (RAIZ . "negocio/Transfers/usuario.php");
require_once (RAIZ . "negocio/DAOs/DAOModerador.php");

class DAOUsuario {

     public static function searchUsuario($id,$password)
    {
        $data_source = DataSource::getSingleton();

        $data_table = $data_source->ejecutarConsulta("SELECT * FROM usuarios
        WHERE nombreUsuario = :id ",array(':id' => $id));
        $usuario = NULL;
        if($data_table != NULL)
        {
           
            foreach($data_table as $clave => $valor)
            {
                $usuario = new Usuario();
            $usuario->setId($data_table[$clave]["ID"]);
            $usuario->setNombre($data_table[$clave]["nombreUsuario"]);
            $usuario->setPass($data_table[$clave]["password"]);
            $usuario->setDireccion($data_table[$clave]["direccion"]);
            $usuario->setEmail($data_table[$clave]["correo"]);
            $usuario->setImagen($data_table[$clave]["imgPerfil"]);
            $usuario->setEsAdmin($data_table[$clave]["esAdmin"]);
           
            $usuario->setCredito($data_table[$clave]["credito"]);
            $usuario->setValoracion($data_table[$clave]["valoracion"]);

            
            
            }
        }
        if($usuario != NULL && password_verify($password, $usuario->getPass()))
        {
            
            return $usuario;
        }
        else return NULL;
    }
    
    public static function insertUsuario(Usuario $usuario)
    {
        $data_source = DataSource::getSingleton();

        $sql = "INSERT INTO usuarios (`nombreUsuario`, `password`, `direccion`, `correo`, `imgPerfil`, `esAdmin`, `credito`, `valoracion`)
            VALUES (:username, :pass, :direccion, :email, :imgPerfil, :esAdmin, :credito, :valoracion)";
        
        $resultado = $data_source ->ejecutarActualizacion($sql,array(
            ':username' => $usuario->getNombre(),
            ':pass' => $usuario->getPass(),
            ':direccion' => $usuario->getDireccion(),
            ':email' => $usuario->getEmail(),
            ':imgPerfil' => $usuario->getImagen(),
            ':esAdmin' => $usuario->getEsAdmin(),
            
            ':credito' => $usuario->getCredito(),
            ':valoracion' => $usuario->getValoracion()          
            )
        );
        return $resultado;
    }

    public static function actualiza($usuario) {
        $data_source = DataSource::getSingleton();

        $sql = "UPDATE usuarios SET password = :pass, direccion = :direccion, imgPerfil = :imgPerfil, credito = :credito, valoracion = :valoracion WHERE nombreUsuario = :nombreUsuario";
        $resultado = $data_source ->ejecutarActualizacion($sql,array(
            ':nombreUsuario' => $usuario->getNombre(),
            ':pass' => $usuario->getPass(),
            ':direccion' => $usuario->getDireccion(),
            ':imgPerfil' => $usuario->getImagen(),
            ':credito' => $usuario->getCredito(),
            ':valoracion' => $usuario->getValoracion()
        ));
        return $resultado;
    }

    public static function edita_perfil($usuario,$id) {
        $data_source = DataSource::getSingleton();

        $sql = "UPDATE usuarios SET nombreUsuario = :nombreUsuario, password = :pass, direccion = :direccion, correo = :correo, imgPerfil = :imgPerfil, credito = :credito, valoracion = :valoracion WHERE ID = :id";
        $resultado = $data_source ->ejecutarActualizacion($sql,array(
            ':id' => $usuario->getID(),
            ':nombreUsuario' => $usuario->getNombre(),
            ':pass' => $usuario->getPass(),
            ':direccion' => $usuario->getDireccion(),
            ':correo' => $usuario->getEmail(),
            ':imgPerfil' => $usuario->getImagen(),
            ':credito' => $usuario->getCredito(),
            ':valoracion' => $usuario->getValoracion()
        ));
        return $resultado;
    }
    public static function selectUsuarioByNickCorreo($nick,$correo)
    {
        $data_source = DataSource::getSingleton();

        $data_table_nick = $data_source->ejecutarConsulta("SELECT * FROM usuarios WHERE nombreUsuario = :nombreUsuario",array(':nombreUsuario' => $nick));
        $data_table = null;                                        
        $data_table_email = $data_source->ejecutarConsulta("SELECT * FROM usuarios WHERE correo = :correo",array(':correo' => $correo)); 
       
            //Miramos si existe el ID del usuario (DNI) 
            if(count($data_table_nick) == 1)
            {
                $data_table = $data_table_nick;
            }
            //Si no existe miramos su correo (Email)
            else if(count($data_table_email) == 1)
            {
                $data_table = $data_table_email;
            } 
             
        $usuario = null;
        if($data_table != NULL)
        {
            foreach($data_table as $clave => $valor)
            {
              $usuario = new Usuario();
            $usuario->setId($data_table[$clave]["ID"]);
            $usuario->setNombre($data_table[$clave]["nombreUsuario"]);
            $usuario->setPass($data_table[$clave]["password"]);
            $usuario->setDireccion($data_table[$clave]["direccion"]);
            $usuario->setEmail($data_table[$clave]["correo"]);
            $usuario->setImagen($data_table[$clave]["imgPerfil"]);
            $usuario->setEsAdmin($data_table[$clave]["esAdmin"]);
            
            $usuario->setCredito($data_table[$clave]["credito"]);
            $usuario->setValoracion($data_table[$clave]["valoracion"]);
            
            }
        }
        return $usuario;
    } 

    public static function selectUsuarioByID($id) {
        $data_source = DataSource::getSingleton();

        $data_table = null;
        $data_table = $data_source->ejecutarConsulta("SELECT * FROM usuarios WHERE ID = :id",array(':id' => $id));
        $usuario = null;
        if($data_table != NULL)
        {
            foreach($data_table as $clave => $valor)
            {
                $usuario = new Usuario();
                $usuario->setId($data_table[$clave]["ID"]);
                $usuario->setNombre($data_table[$clave]["nombreUsuario"]);
                $usuario->setPass($data_table[$clave]["password"]);
                $usuario->setDireccion($data_table[$clave]["direccion"]);
                $usuario->setEmail($data_table[$clave]["correo"]);
                $usuario->setImagen($data_table[$clave]["imgPerfil"]);
                $usuario->setEsAdmin($data_table[$clave]["esAdmin"]);

                $usuario->setCredito($data_table[$clave]["credito"]);
                $usuario->setValoracion($data_table[$clave]["valoracion"]);
            }
        }
        return $usuario;                                     
    }
     public static function SelectUsuariosPorValoracion() // nos devuelve los vendedores con mejores valoraciones
    {
        $data_source = DataSource::getSingleton();

        $data_table = $data_source->ejecutarConsulta("SELECT nombreUsuario ,ID,  MAX(valoracion) AS topValoracion  FROM usuarios  GROUP BY nombreUsuario ORDER BY MAX(valoracion) DESC LIMIT 0 , 4 ");
        $user = null;
        $users = array();
        foreach ($data_table as $clave => $valor)
        {
             $user = new Usuario();
            
            $user->setId($data_table[$clave]["ID"]); // me devulve los que mas ventas tienen
            $user->setNombre($data_table[$clave]["nombreUsuario"]);
            if(DAOModerador::selectModerador($user->getId()) == null) array_push($users,$user);
        }
        return $users;
    }
}
?>