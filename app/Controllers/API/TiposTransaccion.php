<?php

namespace App\Controllers\API;

use App\Models\TipoTransaccioneModel;
use CodeIgniter\RESTful\ResourceController;

class TiposTransaccion extends ResourceController
{

    public function  __construct()
    {
        $this->model = $this->setModel(new TipoTransaccioneModel());
    }

    public function index()
    {
        $tiposTransaccion = $this->model->findAll();
        return $this->respond($tiposTransaccion);
    }

    public function create()
    {
        try {
            $tipoTransaccion = $this->request->getJSON();

            if($this->model->insert($tipoTransaccion)):
                $tipoTransaccion->id = $this->model->insertID();
                return $this->respond($tipoTransaccion);
            else:
                return $this->failValidationError($this->model->validation->listErrors());
            endif;
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un problema en el servidor');
        }
    }

    private function verifiAccount ($id = null)
    {  
        try {
              if($id == null)
                return $this->failValidationError('No se ha pasado un ID valido');

              $cuenta = $this->model->find($id);

              if($cuenta == null):
                return $this->failNotFound('No se ha encontrado la cuenta con el id: '.$id.'');
              else:
                return true;
              endif;

        } catch (\Exception $e) {
            return $this->failServerError('ha ocurrido un problema en el servidor');
        }
    }

    public function update($id = null)
    {
        try {

            $tipoTransaccionVerificada = $this->verifiAccount($id);

            if($tipoTransaccionVerificada !== true)
                 return $tipoTransaccionVerificada;
            
                 $tipoTransaccion = $this->request->getJSON();   

            if($this->model->update($tipoTransaccion)):
                $tipoTransaccion->id = $id;
                return  $this->respondUpdated($tipoTransaccion);
            else:
                return $this->failValidationError($this->model->validation->listErrors());
            endif;

        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un problema en el servidor');
        } 
    }

    public function delete($id = null)
    {
        try {
            $tipoTransaccionVerificada = $this->verifiAccount($id);

            if($tipoTransaccionVerificada !== true)
              return $tipoTransaccionVerificada;

            if($this->model->delete($id)):
                return $this->respondDeleted('Registro con el identificador '.$id.' Eliminado');
            else:
                return $this->failServerError('No se ha podido eliminar el registro');
            endif;

        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un problema en el servidor');
        }
    }

}
