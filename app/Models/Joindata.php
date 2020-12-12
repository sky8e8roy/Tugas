<?php
namespace App\Models;

use CodeIgniter\Model;

class Joindata extends Model
{
    

    public function get_kec_kab()
    {
        return $this->db->table('kecamatan')
        ->join('kabupaten','kabupaten.kd_kab=kecamatan.kd_kab')
        ->get()->getResultArray();
    }

    public function get_kp_kec()
    {
        return $this->db->table('kampung')
        ->join('kecamatan','kecamatan.kd_kec=kampung.kd_kec')
        ->get()->getResultArray();
    }
}