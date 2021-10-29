<?php

namespace App\Controllers\API;

use App\Models\CuentasModel;
use App\Models\TransaccionModel;
use CodeIgniter\RESTful\ResourceController;

class Transaccion extends ResourceController
{
    public  function __construct()
    {
        $this->model = $this->setModel(new TransaccionModel());
    }

    public function index()
    {
        $transacciones = $this->model->findAll();
        return $this->respond($transacciones);
    }

    public function create()
    {
        try {
            $transaccion = $this->request->getJSON();
            
            if($this->model->insert($transaccion)):
                $transaccion->id = $this->model->insertID();
                $transaccion->resultado = $this->actualizarFondoCuenta($transaccion->tipo_transaccion_id,
                                                                       $transaccion->monto,
                                                                       $transaccion->cuenta_id);
                return $this->respond($transaccion);
            else:
                return $this->failValidationError($this->model->validation->listErrors());
            endif;
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un problema en el servidor');
        }
        
    }


    public function update($id = null)
    {
        
    }

    public function delete($id = null)
    {
        
    }

    private function actualizarFondoCuenta($tipoTransaccionId,$monto,$cuentaId){

        $modeloCuenta = new CuentasModel();
        $cuenta = $modeloCuenta->find($cuentaId);

        switch($tipoTransaccionId)
        {
            case 1:
                $cuenta["fondo"] += $monto;
            break;
            case 2:
                $cuenta["fondo"] -= $monto;
            break;
        }

        if($modeloCuenta->update($cuentaId,$cuenta)):
            return array('TransaccionExitosa' => true, 'NuevoFondo' => $cuenta["fondo"]);
        else:
            return array('TransaccionExitosa' => false, 'NuevoFondo' => $cuenta["fondo"]);
        endif;
    } 
}
