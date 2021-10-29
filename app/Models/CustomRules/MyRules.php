<?php
  
namespace App\Models\CustomRules;
use App\Models\ClienteModel;
use App\Models\CuentasModel;
use App\Models\TipoTransaccioneModel;

class MyRules 
{

    public function is_valid_client(int $id):bool
    {
        $model = new ClienteModel();
        $cliente =  $model->find($id);
        
        return $cliente == null ? false : true; 
    }

    public function is_valid_cuenta(int $id):bool
    {
        $model = new CuentasModel();
        $cuenta = $model->find($id);

        return $cuenta == null ? false : true;
    }

    public function is_valid_type_transaccion(int $id):bool
    {
        $model = new TipoTransaccioneModel();
        $tipotTransaccion = $model->find($id);

        return $tipotTransaccion == null ? false : true;
    }

}