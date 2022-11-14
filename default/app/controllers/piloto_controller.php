<?php
class PilotoController extends AppController
{


    /**
     * Obtiene una lista para paginar los menús
     *
     * @param int $page [opcional]
     */
    public function index($page = 1)
    {
        $this->listPiloto = (new Piloto)->getPilotos($page);
    }



    /**
     * Crea un Registro
     */
    public function alta()
    {
        /**
         * Se verifica si el usuario envío el form (submit) y si además
         * dentro del array POST existe uno llamado "Pilotos"
         * el cual aplica la autocarga de objeto para guardar los
         * datos enviado por POST utilizando autocarga de objeto
         */
        if (Input::hasPost('Pilotos')) {
            /**
             * se le pasa al modelo por constructor los datos del form y ActiveRecord recoge esos datos
             * y los asocia al campo correspondiente siempre y cuando se utilice la convención
             * model.campo
             */
            $Piloto = new Piloto(Input::post('Pilotos'));
            //En caso que falle la operación de guardar
            if ($Piloto->create()) {
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
        $Piloto = new Piloto();

        //se verifica si se ha enviado el formulario (submit)
        if (Input::hasPost('Pilotos')) {

            if ($Piloto->update(Input::post('Pilotos'))) {
                Flash::valid('Operación exitosa');
                //enrutando por defecto al index del controller
                return Redirect::to();
            }
            Flash::error('Falló Operación');
            return;
        }


        //Aplicando la autocarga de objeto, para comenzar la edición
        //Si en la vista usamos Pilotos.nombre, la autocarga buscará una variable llamada $Pilotos
        //para apoyar los helpers de Form
        $this->Pilotos = $Piloto->find_by_id((int) $id);
    }

    /**
     * Eliminar un Piloto
     *
     * @param int $id (requerido)
     */
    public function baja($id)
    {
        if ((new Piloto)->delete((int) $id)) {
            Flash::valid('Operación exitosa');
        } else {
            Flash::error('Falló Operación');
        }

        //enrutando por defecto al index del controller
        return Redirect::to();
    }
}
