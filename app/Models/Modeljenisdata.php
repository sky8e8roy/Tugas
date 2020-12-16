<?php
namespace App\Models;

use CodeIgniter\Model;

class Modeljenisdata extends Model
{
    protected $table = 'jenisdata';
    protected $primaryKey = 'id_jenis_data';

    protected $allowedFields = ['id_jenis_data', 'nm_jenis_data', 'kd_sat', 'id_subsek']; //data yang akan disimpan kedalam fields
}