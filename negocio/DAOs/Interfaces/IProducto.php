<?php
interface IProducto{
    public static function selectProductos();
    public static function selectProductosById($id);
    public static function insertProducto(Productos $producto);
    public static function selectLastProductoAñadido();
   
}
?>