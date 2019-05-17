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
            $this->stringConex = "mysql:host=localhost;dbname=xmarket";
            $this->conexion= new PDO($this->stringConex,"root","");
        }
        catch(PDOException $e)
        {
            echo "BBDD unavariable";
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