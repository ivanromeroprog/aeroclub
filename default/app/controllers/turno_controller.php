<?php
class TurnoController extends AppController
{


    /**
     * Obtiene una lista para paginar los menús
     *
     * @param int $page [opcional]
     */
    public function index($page = 1)
    {
        $this->listTurno = (new Turno)->getTurnos($page);
    }



    /**
     * Crea un Registro
     */
    public function alta()
    {
        /**
         * Se verifica si el usuario envío el form (submit) y si además
         * dentro del array POST existe uno llamado "Aeronaves"
         * el cual aplica la autocarga de objeto para guardar los
         * datos enviado por POST utilizando autocarga de objeto
         */

        $this->categorias = ['piloto' => 'Piloto', 'alumno' => 'Alumno'];

        //Listas
        //Aeronaves
        $aeronaves = (new Aeronave())->getAeronavesTodos();
        $this->aeronaves = [];
        foreach ($aeronaves as $v) {
            $this->aeronaves[$v->id] = $v->marca . ' - ' . $v->modelo . ' (' . $v->matricula . ')';
        }

        //Alumnos
        $this->alumnos = [];
        $alumnos = (new Alumno)->getAlumnosTodos();
        foreach ($alumnos as $v) {
            $this->alumnos[$v->id] = $v->apellido . ', ' . $v->nombre;
        }

        //Pilotos
        $this->pilotos = [];
        $pilotos = (new Piloto)->getPilotosTodos();
        foreach ($pilotos as $v) {
            $this->pilotos[$v->id] = $v->apellido . ', ' . $v->nombre;
        }

        if (Input::hasPost('seleccionar_categoria')) {
            //1er Paso, seleccionar Categoria
            $this->categoria_seleccionada = Input::post('Turnos.categoria');
        } elseif (Input::hasPost('seleccionar_aeronave_fecha')) {
            //2do Paso, seleccionar Aeronave y Fecha
            $this->categoria_seleccionada = Input::post('Turnos.categoria');
            //var_dump($_POST);

            //TODO: verificar que la fecha sea válida
            $this->fecha_seleccionada = Input::post('Turnos.fecha');
            $this->aeronave_seleccionada = Input::post('Turnos.id_aeronave');

            //TODO: obtener los turnos ya reservados para la aeronave o turno seleccionado para mostrarlos al usuario
        } elseif (Input::hasPost('Turnos')) {
            //3er Paso, guardar el turno

            /**
             * se le pasa al modelo por constructor los datos del form y ActiveRecord recoge esos datos
             * y los asocia al campo correspondiente siempre y cuando se utilice la convención
             * model.campo
             */

            //TODO: Verificar que el turno sea válido antes de guardar
            $Turno = new Turno(Input::post('Turnos'));
            //En caso que falle la operación de guardar
            if ($Turno->create()) {
                Flash::valid('Operación exitosa');
                //Eliminamos el POST, si no queremos que se vean en el form
                Input::delete();
                return;
            }

            Flash::error('Falló Operación');
        }
    }

    /**
     * Edita un Registro
     *
     * @param int $id (requerido)
     */
    public function modif($id)
    {
        $Turno = new Turno();

        //se verifica si se ha enviado el formulario (submit)
        if (Input::hasPost('Turnos')) {

            if ($Turno->update(Input::post('Turnos'))) {
                Flash::valid('Operación exitosa');
                //enrutando por defecto al index del controller
                return Redirect::to();
            }
            Flash::error('Falló Operación');
            return;
        }


        //Aplicando la autocarga de objeto, para comenzar la edición
        //Si en la vista usamos Aeronaves.nombre, la autocarga buscará una variable llamada $Aeronaves
        //para apoyar los helpers de Form
        $this->Turnos = $Turno->find_by_id((int) $id);
    }

    /**
     * Eliminar un Aeronave
     *
     * @param int $id (requerido)
     */
    public function baja($id)
    {
        if ((new Turno)->delete((int) $id)) {
            Flash::valid('Operación exitosa');
        } else {
            Flash::error('Falló Operación');
        }

        //enrutando por defecto al index del controller
        return Redirect::to();
    }
}
