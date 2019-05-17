<?php
    require_once('comun/config.php');
    require_once (RAIZ . "negocio/Transfers/producto.php");
    require_once (RAIZ . "controller/ProductoV.php");

    require_once (RAIZ . "negocio/Transfers/usuario.php");
    require_once (RAIZ . "controller/UsuarioV.php");

    require_once (RAIZ . "negocio/Transfers/venta.php");
    require_once (RAIZ . "controller/VentaV.php");

    $idProducto = $_GET['id'];
    $producto = ProductoV::selectProductosByID($idProducto);
    $usuario = UsuarioV::selectUsuarioByID($_SESSION['id']);
    echo "Credito: ". $usuario->getCredito() . "\n";
    echo "Precio: ". $producto->getPrecio() . "\n";
    if($usuario->getCredito() < $producto->getPrecio()) {
        echo "<script>
                
                window.location.href='/Aw2019/aportarCredito.php'; //No tienes suficiente crédito!
              </script>";
    } else {
        $producto->setVendido('1');
        if(!ProductoV::actualiza($producto)) echo "ERROR! Fallo en la actualizacion del producto";
        $usuario->setCredito($usuario->getCredito() - $producto->getPrecio());
        if(!UsuarioV::actualiza($usuario)) echo "ERROR! Fallo en la actualizacion del usuario";

        $venta = new Venta();
        $venta->setUsuario($_SESSION['id']);
        $venta->setProducto($producto->getId());
        date_default_timezone_set('Europe/Madrid');
        $d = date('d');
        $m = date('m');
        $y = date('y');
        $venta->setFechaVenta($y . '-' . $m . '-' .$d );
        $venta->setPrecioVenta($producto->getPrecio());
        $venta->setFueSubasta('0');
        if(!VentaV::insertarVenta($venta)) echo "ERROR! Fallo en la creacion de la venta";

        header ('Location: /Aw2019/index.php');
    }
?>