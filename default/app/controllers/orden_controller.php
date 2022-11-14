<?php
class OrdenController extends AppController
{


    /**
     * Obtiene una lista para paginar los menús
     *
     * @param int $page [opcional]
     */
    public function index($page = 1)
    {
        $this->listProductoOrden = (new ProductoOrden)->getOrdenesTodas();
    }

    //recuperar la orden de un cliente por su id
    public function getOrdenCliente($id)
    {
        $this->listProductoOrden = (new ProductoOrden)->getOrdenesCliente($id);
        $this->id = $id;
    }


    //recupera la informacion de una orden por su numero de orden 
    public function verOrden($nro_orden)
    {
        $this->listProductoOrden = (new ProductoOrden)->getProductosOrden($nro_orden); //obtiene los producots de la orden
        $this->listaProductos = (new Producto)->getProductosTodos(); //listado de los productos disponibles para agregar
        $this->nro_orden = $nro_orden;
        $this->totalOrden = 0;
        foreach ($this->listProductoOrden as $productoOrden) {
            $this->totalOrden += $productoOrden->precio;
        }
    }


    //genera una nueva orden
    public function nuevaOrden($id)
    {
        $this->nro_orden = (new ProductoOrden)->nuevaOrden($id);
        if ($this->nro_orden === false) {
            Flash::error('Falló Operación');
        } else {
            $this->listProductoOrden = new ProductoOrden($this->nro_orden);
            Flash::valid('Operación exitosa');
        }
    }


    //Agrega un producto a una orden
    public function agregarProducto($nro_orden)
    {


        if (Input::hasPost('productos')) {
            $nuevo_elemnto_orden = new DetalleProductoOrden(); //creo un elemento de detalle orden

            $elementoAgregado = Input::post('productos'); //recupero el elelemnto agregado

            $unaOrden = (new ProductoOrden())->find_first("conditions: nro_orden= " . $nro_orden); //recupero de la base de datos el id de la orden por su nro_orden

            $nuevo_elemnto_orden->agregaProducto($unaOrden->id, $elementoAgregado);
        }

        Redirect::to("orden/verOrden/" . $nro_orden);
    }


    public function baja($id_producto_orden)

    {

        $orden = new ProductoOrden();    //inicio el objeto Model 
        $detalleOrden = new DetalleProductoOrden();   //inicio el objeto Model

        $orden->begin();    //inicio una transacción
        $detalleOrden->begin();   //inicio una transacción

        $resultadoDetalle = $detalleOrden->delete_all("id_producto_orden =" . $id_producto_orden);

        if ($resultadoDetalle) {
            $resultadoOrden = $orden->delete($id_producto_orden);
            if ($resultadoOrden) {
                $detalleOrden->commit();
                $orden->commit();
            } else {
                $orden->rollback();
                $detalleOrden->rollback();
            }
        } else {
            //die('lalala');
            $detalleOrden->rollback();
        }

        Redirect::to("orden");
    }


    public function bajadetalle($nro_orden, $id_detalle_producto_orden)

    {

        $resultado = (new DetalleProductoOrden)->delete($id_detalle_producto_orden);
        if ($resultado) {
            Flash::valid('Operación exitosa');
        } else {
            Flash::error('Falló Operación');
        }

        Redirect::to("orden/verOrden/" . $nro_orden);
    }
}
