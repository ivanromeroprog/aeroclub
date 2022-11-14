<?php
class Producto extends ActiveRecord
{



    /**
     * Retorna los clientes para ser paginados
     *
     * @param int $page  [requerido] página a visualizar
     * @param int $ppage [opcional] por defecto 20 por página
     */
    public function getProductos($page, $ppage = 20)
    {
        return $this->paginate("page: $page", "per_page: $ppage", 'order: id desc');
    }

    //recupera todos los productos
    public function getProductosTodos()
    {
        return $this->find();
    }

    //contar productos
    public function getCantidadProductos()
    {
        return $this->count();
    }
}
