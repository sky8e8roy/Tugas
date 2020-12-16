<?php 
namespace App\Controllers;

use App\Models\Modelkabupaten;
use App\Models\Modelkecamatan;
use App\Models\Modelkampung;
use App\Models\Modeljenisdata;

class Jenisdata extends BaseController
{
	public function index()
	{
		return view('jenisdata/tampildata');
    }
    
    public function ambildata()
    {
        if ($this->request->isAJAX()){
            
            $data = [
                'tampildata' => $this->joda->get_jenisdata_sat_subsek() 
            ];

            $msg = [
                'data' => view('jenisdata/datajenisdata',$data)
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
                    'tampildataSat' => $this->sat->findAll(),
                    'tampildataSubsek' => $this->subsek->findAll()
            ];

            $msg  = [
                'data' => view('jenisdata/modaltambah',$data)  
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
                    
            //helper(['form', 'url']);
            $validation =  \Config\Services::validation();

            $valid = $this->validate([
                'nm_jenis_data' => [
                        'label' => 'Jenis Data',
                        'rules' => 'required|is_unique[jenisdata.nm_jenis_data]',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                            'is_unique' => '{field} tidak boleh ada yang sama'
                        ]
                    ],
            ]);

            if(!$valid){ //jika validasinya tidak valid maka tampilkan data kedalam bentuk json
                $msg = [
                    'error' => [
                       // 'kd_kp' => $validation->getError('kd_kp'),
                        'nm_jenis_data' => $validation->getError('nm_jenis_data')
                    ]
                ];              
                
            }else {
                $simpandata = [ //'field database' => $this->request->getPost('name dari inputan'),
                    'nm_jenis_data' => $this->request->getPost('nm_jenis_data'),
                    'kd_sat' => $this->request->getPost('kd_sat'),
                    'id_subsek' => $this->request->getPost('id_subsek'),
                ];

               // $kab = new Modelkabupaten;

                $this->jenisdata->insert($simpandata);

                $msg = [
                    'sukses' => 'data berhasil tersimpan'
                ];

            }
            echo json_encode($msg);

        }else{

            exit('maaf data tidak dapat di proses!');

        }
    }

    public function formedit()
    {
        
        if($this->request->isAJAX())
        {            
            $idjenisdata = $this->request->getPost('id_jenis_data');

           // $kab = new Modelkabupaten;
            $row = $this->jenisdata->find($idjenisdata); //cari id jenisdata di tbl jenisdata
            
            $kode_sat=$row['kd_sat']; //jadikan row
            $satuan = $this->sat->find($kode_sat); // cari nama sektor di tbl sektor berdasarkan kode kec di tbl jenisdata

            $id_subsek=$row['id_subsek']; //jadikan row
            $subsek = $this->subsek->find($id_subsek); // cari nama satker di tbl satker berdasarkan kode kec di tbl jenisdata 
            
            $data = [
                'id_jenis_data' => $row['id_jenis_data'],
                'nm_jenis_data' => $row['nm_jenis_data'],

                'kd_sat' => $row['kd_sat'],
                'nm_sat' => $satuan['nm_sat'], //nama satuan

                'id_subsek' => $subsek['id_subsek'],
                'nm_subsek' => $subsek['nm_subsek'], //nama subsektor

                'tampildataSat' => $this->sat->findAll(),
                'tampildataSubsek' => $this->subsek->findAll()
            ];

            $msg = [
                'sukses' => view('jenisdata/modaledit', $data)
            ];

            echo json_encode($msg);  
        }
    }

    public function updatedata(){
        //  $this->load->helper(array('form', 'url'));
        if ($this->request->isAJAX())
        {
            
                $simpandata = [ //'field dari database' => $this->request->getPost('name dari inputan'),                    
                    'nm_jenis_data' => $this->request->getPost('nm_jenis_data'),
                    'kd_sat' => $this->request->getPost('kd_sat'),
                    'id_subsek' => $this->request->getPost('id_subsek'),
                ];

               // $kab = new Modelkabupaten;

                $id_jenis_data = $this->request->getPost('id_jenis_data');

                $this->jenisdata->update($id_jenis_data, $simpandata);

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

                $id_jenis_data = $this->request->getVar('id_jenis_data');

                $this->jenisdata->delete($id_jenis_data);

                $msg = [
                    'sukses' => "data ini telah di hapus"
                ];

                echo json_encode($msg);

        }

    }

    

    


}