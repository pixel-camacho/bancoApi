<?php
  
namespace App\Models\CustomRules;
use App\Models\ClienteModel;

class MyRules 
{
    public function is_valid_client(int $id):bool
    {
        $model = new ClienteModel();
        $cliente =  $model->find($id);
        
        return $cliente == null ? false : true; 
    }
}