<?php
namespace App\Models;

use CodeIgniter\Model;

class Modelkabupaten extends Model
{
    protected $table = 'kabupaten';
    protected $primaryKey = 'kd_kab';

    protected $allowedFields = ['kd_kab', 'nm_kab']; //data yang akan disimpan kedalam fields
}