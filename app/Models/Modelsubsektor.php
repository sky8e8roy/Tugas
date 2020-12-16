<?php
namespace App\Models;

use CodeIgniter\Model;

class Modelsubsektor extends Model
{
    protected $table = 'subsektor';
    protected $primaryKey = 'id_subsek';

    protected $allowedFields = ['id_subsek', 'nm_subsek','kd_satker','kd_sek']; //data yang akan disimpan kedalam fields
}