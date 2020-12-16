<?php 
namespace App\Controllers;

use App\Models\Modelkabupaten;
use App\Models\Modelkecamatan;
use App\Models\Modelkampung;
use App\Models\Modelsubsektor;

class Riwayat_kabupaten extends BaseController
{
	public function index()
	{
		return view('riwayatkab/tampildata');
    }
    
    public function ambildata()
    {
        if ($this->request->isAJAX()){
            
            $data = [
                'tampildata' => $this->joda->get_rkab_jd_kab() 
            ];

            $msg = [
                'data' => view('riwayatkab/datariwayatkab',$data)
            ];

            echo json_encode($msg);

        }else{
            exit('maaf data tidak dapat di proses!');
        }
    }

    public function formtambah()
    {
        

        if ($this->request->isAJAX()){
            
            $data = [
               // 'tampildata' => $this->kec->get_kec_kab() --------- join kecamatan dan kaupaten
                    'tampilJenisData' => $this->jenisdata->findAll(),
                    'tampildataKab' => $this->kab->findAll()
            ];

            $msg  = [
                'data' => view('riwayatkab/modaltambah',$data)  
            ];
            echo json_encode($msg);

        }else{

            exit('maaf data tidak dapat di proses!');

        }
    }
    public function simpandata()
    {
        //  $this->load->helper(array('form', 'url'));
        if ($this->request->isAJAX())
        {                    
                $simpandata = [ //'field dari database' => $this->request->getPost('name dari inputan'),
                    'id_jenis_data' => $this->request->getPost('id_jenis_data'),
                    'jlh_data' => $this->request->getPost('jlh_data'),
                    'thn' => $this->request->getPost('thn'),
                    'kd_kab' => $this->request->getPost('kd_kab'),
                ];

               // $kab = new Modelkabupaten;

                $this->rkab->insert($simpandata);

                $msg = [
                    'sukses' => 'data berhasil tersimpan'
                ];
            echo json_encode($msg);

        }else{

            exit('maaf data tidak dapat di proses!');

        }
    }

    public function formedit()
    {
        
        if($this->request->isAJAX())
        {            
            $idrkab = $this->request->getPost('id_riwayatdata');

           // $kab = new Modelkabupaten;
            $row = $this->rkab->find($idrkab); //cari id subsektor di tbl subsektor
            
            $id_jenisdata=$row['id_jenis_data']; //jadikan row
            $jenis_data = $this->jenisdata->find($id_jenisdata); // cari nama sektor di tbl sektor berdasarkan kode kec di tbl subsektor

            $kode_kab=$row['kd_kab']; //jadikan row
            $kabupaten = $this->kab->find($kode_kab); // cari nama satker di tbl satker berdasarkan kode kec di tbl subsektor 
            
            $data = [
                'id_riwayatdata' => $row['id_riwayatdata'],
                'thn' => $row['thn'],
                'jlh_data' => $row['jlh_data'],

                'id_jenis_data' => $row['id_jenis_data'],
                'nm_jenis_data' => $jenis_data['nm_jenis_data'], //nama jenis data

                'kd_kab' => $kabupaten['kd_kab'],
                'nm_kab' => $kabupaten['nm_kab'], //nama sektor

                'tampiljenisdata' => $this->jenisdata->findAll(),
                'tampildataKab' => $this->kab->findAll()
            ];

            $msg = [
                'sukses' => view('riwayatkab/modaledit', $data)
            ];

            echo json_encode($msg);  
        }
    }

    public function updatedata(){
        //  $this->load->helper(array('form', 'url'));
        if ($this->request->isAJAX())
        {
            
                $simpandata = [ //'field dari database' => $this->request->getPost('name dari inputan'),                    
                    'id_jenis_data' => $this->request->getPost('id_jenis_data'),
                    'jlh_data' => $this->request->getPost('jlh_data'),
                    'thn' => $this->request->getPost('thn'),
                    'kd_kab' => $this->request->getPost('kd_kab'),
                ];

               // $kab = new Modelkabupaten;

                $id_riwayatdata = $this->request->getPost('id_riwayatdata');

                $this->rkab->update($id_riwayatdata, $simpandata);

                $msg = [
                    'sukses' => 'data berhasil di Update'
                ];

            
            echo json_encode($msg);

        }else{

            exit('maaf data tidak dapat di proses!');

        }
    }

    public function hapus(){

        if($this->request->isAJAX()){

                //$kab = new Modelkabupaten;

                $id_riwayatdata = $this->request->getVar('id_riwayatdata');

                $this->rkab->delete($id_riwayatdata);

                $msg = [
                    'sukses' => "data ini telah di hapus"
                ];

                echo json_encode($msg);

        }

    }

    

    


}