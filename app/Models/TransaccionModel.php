<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaccionModel extends Model
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
        'monto' => 'required|numeric',
        'cuenta_id' => 'required|integer|is_valid_cuenta',
        'tipo_transaccion_id' => 'required|integer|is_valid_type_transaccion'
    ];
    protected $validationMessages   = [
        'cuenta_id' =>[
            'is_valid_cuenta' => 'Estimado usuario, debe ingresar una cuenta valida'
        ],
        'tipo_transaccion_id' =>[
            'is_valid_type_transaccion' => 'Estimado usuario, debe ingresar un tipo de transaccion valido'
        ]
    ];
    protected $skipValidation       = false;

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
