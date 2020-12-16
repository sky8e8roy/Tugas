<?php
namespace App\Models;

use CodeIgniter\Model;

class Modelsatker extends Model
{
    protected $table = 'satuankerja';
    protected $primaryKey = 'kd_satker';

    protected $allowedFields = ['kd_satker', 'nm_satker']; //data yang akan disimpan kedalam fields
}