<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaccioneModel extends Model
{
  
    protected $table                = 'transaccion';
    protected $primaryKey           = 'id';

    protected $useAutoIncrement     = true;
    protected $insertID             = 0;

    protected $returnType           = 'array';
    protected $allowedFields        = ['cuenta_id','tipo_transaccion_id','monto'];

    // Dates
    protected $useTimestamps        = true;
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';


    // Validation
    protected $validationRules      = [
        'cuenta_id' => 'required|integer',
        'tipo_trasaccion_id' => 'required|integer',
        'monto' => 'required|numeric'
    ];
    
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = [];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];
}
