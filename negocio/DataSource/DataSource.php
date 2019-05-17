<?php
class DataSource{
    private $stringConex;
    private $conexion;
    private static $instancia;
    /**
    * Inicia la conexion con la BBDD
    **/
    public  function __construct(){
        try{
            $this->stringConex = "mysql:host=" . BD_HOST . ";dbname=" . BD_NAME;
            $this->conexion= new PDO($this->stringConex, BD_USER, BD_PASS);
        }
        catch(PDOException $e)
        {
            echo "BBDD unavariable";
            error_log(print_r($e, FALSE));
        }
    }

    public static function getSingleton()
    {
        if (  !self::$instancia instanceof self) {
            self::$instancia = new self;
        }
        return self::$instancia;
    }

    /**
    * Realizar una consulta usando PDO
    **/
    public function ejecutarConsulta($sql="",$values=array())
    {
        if( $this->stringConex != NULL && $this->conexion != NULL)
        {
			
            if($sql != "")
            {
				
                $consulta = $this->conexion->prepare($sql);
                $consulta->execute($values);
                $tabla_datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
                //Muestra los errores de la BBD (depuracion) QUITAR!!!!!
                $arr = $consulta->errorInfo();
                //print_r($arr);  
                return $tabla_datos;
            }
        }
        return 0;
    }
    /**
    * Nos permite obtener un entero con el numero de tablas actualizadas
    **/
    public function ejecutarActualizacion($sql="",$values= array())
    {
        if( $this->stringConex != NULL && $this->conexion != NULL)
        {
            if($sql != "")
            {
                $consulta = $this->conexion->prepare($sql);
                $consulta->execute($values);
                $num_tablas_afect = $consulta->rowCount();
                //Muestra los errores de la BBD (depuracion) QUITAR!!!!!
                $arr = $consulta->errorInfo();
                //print_r($arr);  
                return $num_tablas_afect;
            }
        }
        else 
        {
            return 0;
        }
    }
}
?>