<?php
class Usuario
{   
	private $id;
	private $nombre;
	private $password;
	private $direccion;
	private $correo;
	private $imagenPerfil;
    private $esAdmin;
    private $credito;
    private $valoracion;
    private $subasta;
    
  
    
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
 
  
    /*Nombre*/
     public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    /*Password*/
      public function setPass($password)
    {
        $this->password = $password;
    }
    public function getPass()
    {
        return $this->password;
    }
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }
    public function getDireccion()
    {
        return $this->direccion;
    }
    
    /*Email*/
     public function setEmail($email)
    {
        $this->correo = $email;
    }
    public function getEmail()
    {
        return $this->correo;
    }
   
     

  
    
      public function setImagen($imagen)
    {
        $this->imagenPerfil = $imagen;
    }
    public function getImagen()
    {
        return $this->imagenPerfil;
    }

    
    
    
    public function setEsAdmin($admin)
    {
        $this->esAdmin = $admin;
    }
    public function getEsAdmin()
    {
        return $this->esAdmin;
    }

    public function setCredito($credito)
    {
        $this->credito = $credito;
    }
    public function getCredito()
    {
        return $this->credito;
    }

    public function setValoracion($valoracion)
    {
        $this->valoracion = $valoracion;
    }
    public function getValoracion()
    {
        return $this->valoracion;
    }
    
    
}
?>