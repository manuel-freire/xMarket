<?php
class Moderador
{   
	private $id;
	private $categoria;


    
  
    
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
 
  
    /*categoria*/
     public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }
    public function getcategoria()
    {
        return $this->categoria;
    }

    
}
?>