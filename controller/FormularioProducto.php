<?php
    require_once('comun/config.php');
    require_once (RAIZ . "negocio/Transfers/producto.php");
    require_once (RAIZ . "controller/ProductoV.php");
    require_once (RAIZ . "negocio/Transfers/subasta.php");
    require_once (RAIZ . "controller/SubastaV.php");
    require_once(RAIZ ."controller/Form.php");
    require_once(RAIZ ."comun/Parsedown.php");

class FormularioProducto extends Form
{
    public function __construct() {
        $options = [ 'enctype' => 'multipart/form-data' ];
        parent::__construct('formProducto', $options);
    }
    
    protected function generaCamposFormulario($datos)
    {
        $html='<div class="field half first">
                    <label for="name">Nombre del producto*</label>
                    <input name="nombreProducto" type="text" placeholder="Nombre del producto" required>
                </div>
                <div class="field half">
                    <label for="email">Categoria de Producto*</label>
                    <select class="formProducto" name = "categoria" required>
                        <option style="display:none">Elige una categoría</option>
                        <option value="libros">Libros</option>
                        <option value="juguetes">Juguetes</option>
                        <option value="ropa">Ropa</option>
                    </select>
                </div>
                <div class="field half first">
                    <label for="name">Precio*</label>
                    <input name="precio" type="text" placeholder="Precio" required>
                </div>
                <div class="field half">
                    <label for="name">Descripcion*</label>
                    <input name="descripcion" type="text" placeholder="Separa las frases con puntos." required>
                </div>
                <div class="field half first">
                    <label for="email">Subasta o venta*</label>
                    <select class="formProducto" name = "tipo" required>
                        <option id="categoria">Elige una opción</option>
                        <option value="venta">Venta</option>
                        <option value="subasta">Subasta</option>
                    </select>
                </div>
                <div class="field half">
                    <label for="name">Imagen 1*</label>
                    <input type="file" name="imagen1" id="img1" class="button alt" required>
                </div>
                <div class="field half first">
                    <label for="name">Imagen 2</label>
                    <input type="file" name="imagen2" class="button alt" >
                </div>
                <div class="field half">
                    <label for="name">Imagen 3</label>
                    <input type="file" name="imagen3" class="button alt">
                </div>
                <ul class="actions">
                    <li><input value="Subir Producto" class="button alt" type="submit"></li>
                </ul>';
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        
        $result = array();
        
        $ultimoProducto = DAOProducto::selectLastProductoAñadido();
        $nombreProducto = $datos['nombreProducto'];
        $categoria = $datos['categoria'];
        $tipo = $datos['tipo'];
        if(! is_numeric($datos['precio'])){
            $result[] = "EL precio deberá ser un número. Intentelo de nuevo, por favor.";
        } else $precioProducto = $datos['precio'];

        $descripcionProducto = $datos['descripcion'];
        $pieces = explode(". ", $descripcionProducto);
        $descripcionProducto = implode("\n \n", $pieces);
        $parsedown = new Parsedown();
        $descripcionProducto = $parsedown->text($descripcionProducto);
        
        //IMÁGENES
        $imagen1 = null; $imagen2 = null; $imagen3 = null;
        $idP = null;
        //la primera imagen es obligatoria
        if($ultimoProducto == null) $idP == '1';
        else $idP = $ultimoProducto->getId() + 1;
        $uploads_dir = RAIZ . '/upload/productos/' . $idP;
        if(!mkdir($uploads_dir, 0777, true)) {$result[] = "Fallo en la página web. Intentelo de nuevo, por favor.";}
        else {
            $tmp_name = $_FILES['imagen1']['tmp_name'];
            $name = "1.png";
            move_uploaded_file($tmp_name, "$uploads_dir/$name");  
            $imagen1 = "upload/productos/$idP/$name";
        }
            
        //las dos siguientes son opcionales, por eso el isset
        if(isset($_FILES['imagen2']) && $_FILES['imagen2']['name'] != '') {
            $tmp_name = $_FILES['imagen2']['tmp_name'];
            $name = "2.png";
            move_uploaded_file($tmp_name, "$uploads_dir/$name");
            $imagen2 = "upload/productos/$idP/$name"; 
        }
        if(isset($_FILES['imagen3']) && $_FILES['imagen3']['name'] != '') {
            $tmp_name = $_FILES['imagen3']['tmp_name'];
            $name = "3.png";
            move_uploaded_file($tmp_name, "$uploads_dir/$name");
            $imagen3 = "upload/productos/$idP/$name"; 
        }

        $producto = new Productos();
        $producto->setNombre($nombreProducto);
        $producto->setCategoria($categoria);
        $producto->setDescripcion($descripcionProducto);
        $producto->setPrecio($precioProducto);
        echo "propietario: ";
        echo $_SESSION['id'];
        $producto->setPropietario($_SESSION['id']);
        $producto->setImagen1($imagen1);
        $producto->setImagen2($imagen2);
        $producto->setImagen3($imagen3);
        $producto->setVendido('0'); // si pone 1 en este campo es que esta vendido
        $producto->setPendiente('1'); // el producto esta pendiente de revision 
        if($tipo == "subasta"){
            $producto->setSubasta('1');
        }
        else { $producto->setSubasta('0');}
        if(ProductoV::crear($producto)) {
            /*
            if($tipo == "subasta") {
                $subasta = new Subasta();
                $subasta->setIDUsuario($_SESSION['id']);
                
                $ultimoProducto = DAOProducto::selectLastProductoAñadido();
                $subasta->setIDProducto($ultimoProducto->getId());
    
                $subasta->setPrecioOriginal($ultimoProducto->getPrecio());
                $subasta->setUltimaPuja($ultimoProducto->getPrecio());
    
                //falta tocar las fechas, que cuadren bien
                date_default_timezone_set('Europe/Madrid');
                $d = date('d'); $d = $d+1;
                $m = date('m');
                $y = date('y');
                $subasta->setFechaVencimiento($y . '-' . $m . '-' . $d);
                //aquí no se muy bien si poner un if con un alert en caso de que falle el insertarSubasta
                //o borrar el producto de la tabla productos ya que se supone que es una subasta y no está en la tabla
                //en un principio, no debería haber ningún problema.
                SubastaV::insertaSubasta($subasta);
            }
            */
            $result ="index.php";
        } else $result[] = "Ha habido un error en la web. Intentelo más tarde, por favor.";

        return $result;        
    }    
}
?>