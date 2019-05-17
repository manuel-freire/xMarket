<?php
class Subasta
{
    private $id;
    private $idUsuario;
    private $idProducto;
    private $precioOriginal;
    private $ultimaPuja;
    private $fechaVencimiento;
    
    

  

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
    
    public function setIDUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }
    public function getIDUsuario()
    {
        return $this->idUsuario;
    }
  
     public function setIDProducto($idProducto)
    {
       $this->idProducto = $idProducto;
    }
    public function getIDProducto()
    {
        return $this->idProducto;
    }
    

     public function setPrecioOriginal($precioOriginal)
    {
        $this->precioOriginal = $precioOriginal;
    }
    public function getPrecioOriginal()
    {
        return $this->precioOriginal;
    }


    public function setUltimaPuja($ultimaPuja)
    {
        $this->ultimaPuja = $ultimaPuja;
    }
    public function getultimaPuja()
    {
        return $this->ultimaPuja;
    }
    

    public function setFechaVencimiento($fechaVencimiento)
    {
        $this->fechaVencimiento = $fechaVencimiento;
    }
    public function getFechaVencimiento()
    {
        return $this->fechaVencimiento;
    }
    

}
?>