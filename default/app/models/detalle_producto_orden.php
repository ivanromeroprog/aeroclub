<?php

class DetalleProductoOrden extends ActiveRecord
{

    // clase index
    public function index($nro_orden)
    {
        $this->nro_orden = $nro_orden;
        $this->listaProductos = (new Producto)->getProductosTodos();
    }

    //Agrega un producto asociado a una orden 
    public function agregaProducto($id_producto_orden, $id_producto)
    {
        $this->begin();  //iniciamos transaccion
        $datos = array("id_producto_orden" => $id_producto_orden, "id_producto" => $id_producto);
        if ($this->create($datos)) {
            $this->commit();
        } else {
            $this->rollback();
        }
    }
}
