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

    public function get_subsek_satker_sek()
    {
        return $this->db->table('subsektor')
        ->join('satuankerja','satuankerja.kd_satker=subsektor.kd_satker')
        ->join('sektor','sektor.kd_sek=subsektor.kd_sek')
        ->get()->getResultArray();
    }
    

    public function get_jenisdata_sat_subsek()
    {
        return $this->db->table('jenisdata')
        ->join('satuan','satuan.kd_sat=jenisdata.kd_sat')
        ->join('subsektor','subsektor.id_subsek=jenisdata.id_subsek')
        ->get()->getResultArray();
    }

    public function get_rkab_jd_kab() //data riwayat kabupaten - jenis data - kabupaten
    {
        return $this->db->table('riwayatdatakab')
        ->join('jenisdata','jenisdata.id_jenis_data=riwayatdatakab.id_jenis_data')
        ->join('kabupaten','kabupaten.kd_kab=riwayatdatakab.kd_kab')
        ->get()->getResultArray();
    }
}