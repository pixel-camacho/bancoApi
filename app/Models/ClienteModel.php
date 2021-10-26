<?php

namespace App\Models;
use CodeIgniter\Model;

class ClienteModel extends Model
{
    protected $table                = 'cliente';
    protected $primaryKey           = 'id';

    protected $useAutoIncrement     = true;
    protected $insertID             = 0;

    protected $returnType           = 'array';
    protected $allowedFields        = ['nombre','apellido','telefono','correo'];

    // Dates
    protected $useTimestamps        = true;
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';

    // Validation
    protected $validationRules      = [
        'nombre'   => 'required|alpha_space|min_length[3])|max_length[75]',
        'apellido' => 'required|alpha_space|min_length[3])|max_length[75]',
        'telefono' => 'required|alpha_numeric_space|min_length[8])|max_length[10]',
        'correo'   => 'permit_empty|valid_email|max_length[85]'
    ];
    protected $validationMessages   = [
        'correo' =>[
            'valid_email' => 'Estimado usuario, debe ingresar un email valido'
        ]
    ];
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
