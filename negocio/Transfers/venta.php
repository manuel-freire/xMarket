<?php

    class Venta {
        private $id;
        private $usuario;
        private $producto;
        private $fechaVenta;
        private $precioVenta;
        private $fueSubasta;

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

        public function setFechaVenta($fechaVenta)
        {
            $this->fechaVenta = $fechaVenta;
        }
        public function getFechaVenta()
        {
            return $this->fechaVenta;
        }

        public function setPrecioVenta($precioVenta)
        {
            $this->precioVenta = $precioVenta;
        }
        public function getPrecioVenta()
        {
            return $this->precioVenta;
        }

        public function setFueSubasta($fueSubasta)
        {
            $this->fueSubasta = $fueSubasta;
        }
        public function getFueSubasta()
        {
            return $this->fueSubasta;
        }

    }

?>