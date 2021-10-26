<?php

namespace App\Models;

use CodeIgniter\Model;

class CuentasModel extends Model
{
    protected $table                = 'cuenta';
    protected $primaryKey           = 'id';

    protected $useAutoIncrement     = true;
    protected $insertID             = 0;

    protected $returnType           = 'array';
    protected $allowedFields        = ['moneda','fondo','cliente_id'];

    // Dates
    protected $useTimestamps        = true;
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';

    // Validation
    protected $validationRules      = [
        'moneda' => 'required|alpha_space|min_length[3]|max_length[3]',
        'fondo'  => 'required|numeric',
        'cliente_id' => 'required|integer'
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
