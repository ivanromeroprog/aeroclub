<?php
class AeronaveController extends AppController
{


    /**
     * Obtiene una lista para paginar los menús
     *
     * @param int $page [opcional]
     */
    public function index($page = 1)
    {
        $this->listAeronave = (new Aeronave)->getAeronaves($page);
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

        //var_dump($_POST);
        //die();

        if (Input::hasPost('Aeronaves')) {
            /**
             * se le pasa al modelo por constructor los datos del form y ActiveRecord recoge esos datos
             * y los asocia al campo correspondiente siempre y cuando se utilice la convención
             * model.campo
             */
            $Aeronave = new Aeronave(Input::post('Aeronaves'));
            //En caso que falle la operación de guardar
            if ($Aeronave->create()) {
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
        $Aeronave = new Aeronave();

        //se verifica si se ha enviado el formulario (submit)
        if (Input::hasPost('Aeronaves')) {

            if ($Aeronave->update(Input::post('Aeronaves'))) {
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
        $this->Aeronaves = $Aeronave->find_by_id((int) $id);
    }

    /**
     * Eliminar un Aeronave
     *
     * @param int $id (requerido)
     */
    public function baja($id)
    {
        if ((new Aeronave)->delete((int) $id)) {
            Flash::valid('Operación exitosa');
        } else {
            Flash::error('Falló Operación');
        }

        //enrutando por defecto al index del controller
        return Redirect::to();
    }
}
