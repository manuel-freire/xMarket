<?php
class Productos
{
    private $id;
    private $nombre;
    private $categoria;
    private $descripcion;
    private $precio;
    private $usuarioPropietario;
    private $imag1;
    private $imag2;
    private $imag3;
    private $vendido;
    private $pendiente;
    private $subasta;

    

  

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
    
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
  
     public function setCategoria($categoria)
    {
       $this->categoria = $categoria;
    }
    public function getCategoria()
    {
        return $this->categoria;
    }
    

     public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }


    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }
    public function getprecio()
    {
        return $this->precio;
    }
    

    public function setPropietario($propietario)
    {
        $this->usuarioPropietario = $propietario;
    }
    public function getPropietario()
    {
        return $this->usuarioPropietario;
    }
    public function setImagen1($imagen)
    {
        $this->imag1 = $imagen;
    }
    public function getImagen1()
    {
        return $this->imag1;
    }

    public function setImagen2($imagen)
    {
        $this->imag2 = $imagen;
    }
    public function getImagen2()
    {
        return $this->imag2;
    }
   
    public function setImagen3($imagen)
    {
        $this->imag3 = $imagen;
    }
    public function getImagen3()
    {
        return $this->imag3;
    }
    
    public function setVendido($vendido)
    {
        $this->vendido = $vendido;
    }
    public function getVendido()
    {
        return $this->vendido;
    }

    public function setPendiente($pendiente)
    {
        $this->pendiente = $pendiente;
    }
    public function getPendiente()
    {
        return $this->pendiente;
    }
    public function setSubasta($subasta)
    {
        $this->subasta = $subasta;
    }
    public function getSubasta()
    {
        return $this->subasta;
    }
    

}
?>