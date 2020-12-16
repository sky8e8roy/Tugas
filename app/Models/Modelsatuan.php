<?php
namespace App\Models;

use CodeIgniter\Model;

class Modelsatuan extends Model
{
    protected $table = 'satuan';
    protected $primaryKey = 'kd_sat';

    protected $allowedFields = ['kd_sat', 'nm_sat']; //data yang akan disimpan kedalam fields
}