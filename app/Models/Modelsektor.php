<?php
namespace App\Models;

use CodeIgniter\Model;

class Modelsektor extends Model
{
    protected $table = 'sektor';
    protected $primaryKey = 'kd_sek';

    protected $allowedFields = ['kd_sek', 'nm_sek']; //data yang akan disimpan kedalam fields
}