<?php
namespace App\Models;

use CodeIgniter\Model;

class Modelkecamatan extends Model
{
    protected $table = 'kecamatan';
    protected $primaryKey = 'kd_kec';

    protected $allowedFields = ['kd_kec', 'nm_kec', 'kd_kab']; //data yang akan disimpan kedalam fields
    
}