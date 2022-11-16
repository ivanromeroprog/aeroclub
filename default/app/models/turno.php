<?php
class Turno extends ActiveRecord
{



    /**
     * Retorna los clientes para ser paginados
     *
     * @param int $page  [requerido] página a visualizar
     * @param int $ppage [opcional] por defecto 20 por página
     */
    public function getTurnos($page, $ppage = 20)
    {
        return $this->paginate("page: $page", "per_page: $ppage", 'order: id desc');
    }

    //recupera todos los Aeronaves
    public function getTurnosTodos()
    {
        return $this->find();
    }

    //contar Aeronaves
    public function getCantidadTurnos()
    {
        return $this->count();
    }
}
