<?php
class Alumno extends ActiveRecord
{

    /**
     * Retorna los Alumnos para ser paginados
     * @param int $page  [requerido] página a visualizar
     * @param int $ppage [opcional] por defecto 20 por página
     *  Metodo propio de la clase ActiveRecord
     */

    public function getAlumnos($page, $ppage = 20)
    {
        return $this->paginate("page: $page", "per_page: $ppage", 'order: id desc');
    }

    public function getAlumnosTodos()
    {
        return $this->find();
    }

    public function getAlumno($id)
    {
        return $this->find($id);
    }

    public function getCantidadAlumnos()
    {
        return $this->count();
    }
}
