<?php
class Piloto extends ActiveRecord
{

    /**
     * Retorna los Pilotos para ser paginados
     * @param int $page  [requerido] página a visualizar
     * @param int $ppage [opcional] por defecto 20 por página
     *  Metodo propio de la clase ActiveRecord
     */

    public function getPilotos($page, $ppage = 20)
    {
        return $this->paginate("page: $page", "per_page: $ppage", 'order: id desc');
    }

    public function getPiloto($id)
    {
        return $this->find($id);
    }

    public function getCantidadPilotos()
    {
        return $this->count();
    }
}
