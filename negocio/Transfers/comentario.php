<?php

    class Comentario {
        private $id;
        private $tipo;
        private $usuario;
        private $producto;
        private $comentario;
     

        public function setId($id)
        {
            $this->id = $id;
        }
        public function getId()
        {
            return $this->id;
        }

        public function setUsuario($usuario)
        {
            $this->usuario = $usuario;
        }
        public function getUsuario()
        {
            return $this->usuario;
        }

        public function setProducto($producto)
        {
            $this->producto = $producto;
        }
        public function getProducto()
        {
            return $this->producto;
        }

        public function setTipo($tipo)
        {
            $this->tipo = $tipo;
        }
        public function getTipo()
        {
            return $this->tipo;
        }
        
        public function setComentario($comentario)
        {
            $this->comentario = $comentario;
        }
        public function getComentario()
        {
            return $this->comentario;
        }

    }

?>