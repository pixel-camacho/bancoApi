<?php

namespace App\Controllers\API;
use App\Models\CuentasModel;
use CodeIgniter\RESTful\ResourceController;

class Cuenta extends ResourceController
{

    public function __construct()
    {
      $this->model = $this->setModel(new CuentasModel());
    }
  
    public function index()
    {
       $cuentas = $this->model->findAll();
       return $this->respond($cuentas);
    }

    public function create()
    {
        try {
            $cuenta = $this->request->getJSON();

            if($this->model->insert($cuenta)):
                $cuenta->id = $this->model->insertID();
                return $this->respondCreated($cuenta);
            else:
                return $this->failValidationError($this->model->validation->listErrors());
            endif;

        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
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

            $cuentaVerificada = $this->verifiAccount($id);

            if($cuentaVerificada !== true)
                 return $cuentaVerificada;
            
                 $cuenta = $this->request->getJSON();   

            if($this->model->update($cuenta)):
                $cuenta->id = $id;
                return  $this->respondUpdated($cuenta);
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
            $verificarCuenta = $this->verifiAccount($id);

            if($verificarCuenta !== true)
              return $verificarCuenta;

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
