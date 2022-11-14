<?php

/**
 * Controller por defecto si no se usa el routes
 *
 */
class DashboardController extends AppController
{
    public function index()
    {

        $cliente = new Cliente();
        $producto = new Producto();
        $orden = new ProductoOrden();

        $this->cantidadClientes = $cliente->getCantidadClientes();
        $this->cantidadProductos = $producto->getCantidadProductos();
        $this->montoTotal = $orden->getMontoProductosOrden();
        //var_dump($this->montoTotal);
        //die();

    }
}
