<?php
class ProductoOrden extends ActiveRecord
{



    /**
     * Retorna las ordenes para ser paginados
     *
     * @param int $page  [requerido] pÃ¡gina a visualizar
     * @param int $ppage [opcional] por defecto 20 por pÃ¡gina
     */
    public function getProductoOrden($page, $ppage = 20)
    {
        return $this->paginate("page: $page", "per_page: $ppage", 'order: id desc');
    }

    //recupera todas las ordenes del sistema
    public function getOrdenesTodas()
    {


        return $this->find_all_by_sql('SELECT producto_orden.id,producto_orden.nro_orden,cliente.dni,concat(cliente.apellido,",",cliente.nombre) as nombreComp
                                    FROM producto_orden inner join cliente on producto_orden.cliente_id = cliente.id');
    }

    //recupera las ordenes de un cliente
    public function getOrdenesCliente($id)
    {


        return $this->find_all_by_sql('SELECT distinct producto_orden.nro_orden,producto_orden.id
                                        FROM producto_orden inner join cliente on producto_orden.cliente_id = cliente.id
                                        WHERE cliente_id = ' . $id . ';');
    }

    //recupera los productos de una orden por el nuro de orden
    public function getProductosOrden($nro_orden)
    {
        return $this->find_all_by_sql("SELECT producto_orden.id, producto.nombre,producto.precio,detalle_producto_orden.id as id_detalle_producto_orden  
                                       FROM producto_orden INNER JOIN detalle_producto_orden on producto_orden.id = detalle_producto_orden.id_producto_orden 
                                                           INNER JOIN producto on producto.id = detalle_producto_orden.id_producto 
                                                           WHERE nro_orden = " . $nro_orden);
    }

    public function getMontoProductosOrden()
    {
        $data = $this->find_by_sql(
            "SELECT SUM(producto.precio) as monto 
                      FROM producto_orden INNER JOIN detalle_producto_orden on producto_orden.id = detalle_producto_orden.id_producto_orden 
                      INNER JOIN producto on producto.id = detalle_producto_orden.id_producto"
        );
        return $data->monto;
    }

    //realiza la transaccion para guardar una nueva orden en la base de datos
    public function nuevaOrden($cliente_id)
    {

        $this->begin();  //iniciamos transaccion

        $ultimaOrden = $this->find_by_sql("SELECT MAX(nro_orden) as ultimaOrden FROM producto_orden");

        $nuevaOrden = $ultimaOrden->ultimaOrden + 1;

        $resultado = $this->create(   //creamos la entrada
            "nro_orden: " . $nuevaOrden,  //incremento en 1 respecto de la ultima orden disponible
            "cliente_id: " . $cliente_id
        );

        if ($resultado) //si funciono la creación
        {
            if ($this->commit())  //finalizamos transaccion
            {

                return $nuevaOrden;   //retornamos el valor de la nueva orden
            } else {
                $this->rollback(); //si fallo retornamos al estado anterior

            }
        } else {
            $this->rollback(); //si fallo retornamos al estado anterior

        }

        return false;  //si no salio por exito siempre retornamos false


    }

    public function bajaOrden($id)
    {
    }
}
