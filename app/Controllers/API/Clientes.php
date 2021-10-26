<?php

namespace App\Controllers\API;

use App\Models\ClienteModel;
use CodeIgniter\RESTful\ResourceController;

class Clientes extends ResourceController
{
    public function __construct(){
      $this->model = $this->setModel(new ClienteModel());
    }

    public function index()
    {
        $cliente = $this->model->findAll();
        return $this->respond($cliente);
    }

    public function createClient()
    {
        try{

            $cliente = $this->request->getJSON();
            if($this->model->insert($cliente)):
                $cliente->id = $this->model->insertID();
                return $this->respondCreated($cliente);
            else:
                return $this->failValidationError($this->model->validation->listErrors());
            endif;

        }catch(\Exception $e){
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }

    public function getClientById($id = null)
    {
        try {

            if($id == null)
                return $this->failValidationError('No se ha pasado un ID  valido');

            $cliente = $this->model->find($id);

            if($cliente == null)
                return $this->failNotFound('No se ha encontrado un cliente con el id: '.$id.' ');
            
            return $this->respond($cliente);
            
        } catch (\Throwable $th) {
                return $this->failServerError('Ha ocurrido un problema en el servidor');
        }
    }

    private function verifiClient($id = null){
        try {

            if($id == null)
                return $this->failValidationError('No se ha pasado un ID  valido');

            $cliente = $this->model->find($id);

            if($cliente == null)
                return $this->failNotFound('No se ha encontrado un cliente con el id: '.$id.' ');
            
            return true;
            
        } catch (\Throwable $th) {
                return $this->failServerError('Ha ocurrido un problema en el servidor');
        }

    }

    public function updateClient($id = null)
    {
       try {
            
           $clienteVerificado = $this->verifiClient($id);

           if($clienteVerificado !== true):
              return $clienteVerificado;
           endif;
              
           $cliente = $this->request->getJSON();

        if($this->model->update($id,$cliente)):
            $cliente->id = $id;
            return $this->respondUpdated($cliente);
        else:
            return $this->failValidationError($this->model->validation->listErrors());
        endif; 
           
       } catch (\Throwable $th) {
                return $this->failServerError('Ha ocurrido un problema en el servidor');
       }
    }

    public function deleteClient($id = null)
    {
        try {

            $clienteVerificado = $this->verifiClient($id);

            if($clienteVerificado !== true):
                return $clienteVerificado;
            endif;
    
            if($this->model->delete($id)):
                return $this->respondDeleted('Registro con el identificador '.$id.' Eliminado');
            else:
                return $this->failServerError('No se ha podido eliminar el registro');
            endif;

        } catch (\Throwable $th) {
            return $this->failServerError('Ha ocurrido un problema en el servidor');
        }    
    }
}
