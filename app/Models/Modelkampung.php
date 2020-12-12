<?php
namespace App\Models;

use CodeIgniter\Model;

class Modelkampung extends Model
{
    protected $table = 'kampung';
    protected $primaryKey = 'kd_kp';

    protected $allowedFields = ['kd_kp', 'nm_kp', 'kd_kec']; //data yang akan disimpan kedalam fields
}