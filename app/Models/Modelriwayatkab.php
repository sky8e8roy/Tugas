<?php
namespace App\Models;

use CodeIgniter\Model;

class Modelriwayatkab extends Model
{
    protected $table = 'riwayatdatakab';
    protected $primaryKey = 'id_riwayatdata';

    protected $allowedFields = ['id_riwayatdata', 'id_jenis_data','jlh_data','thn','kd_kab']; //data yang akan disimpan kedalam fields
}