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
        return $this->paginate_by_sql('SELECT

        alumno.nombre AS alumno_nombre,
        alumno.apellido AS alumno_apellido,
        piloto.nombre AS piloto_nombre,
        piloto.apellido AS piloto_apellido,
        aeronave.marca,
        aeronave.modelo,
        turno.*
        
        FROM turno
        
        LEFT JOIN alumno ON turno.id_alumno = alumno.id
        LEFT JOIN piloto ON turno.id_piloto = piloto.id
        LEFT JOIN aeronave ON turno.id_aeronave = aeronave.id

        ORDER BY
        turno.id_alumno,
        turno.fecha
        
        ', "page: $page", "per_page: $ppage");
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
