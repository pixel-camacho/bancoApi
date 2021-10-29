<?php

namespace App\Models;

use CodeIgniter\Model;

class TipoTransaccioneModel extends Model
{

    protected $table                = 'tipo_transaccion';
    protected $primaryKey           = 'id';

    protected $useAutoIncrement     = true;
    protected $insertID             = 0;

    protected $returnType           = 'array';
    protected $allowedFields        = ['descripcion'];

    // Dates
    protected $useTimestamps        = true;
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';

    // Validation
    protected $validationRules      = [
        'descripcion' => 'required|alpha_space|min_length[5]|max_length[25]'
    ];

    protected $validationMessages   = [];
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
