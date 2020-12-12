<?php 
namespace App\Controllers;

use App\Models\Modelkabupaten;
use App\Models\Modelkecamatan;

class Kecamatan extends BaseController
{
	public function index()
	{
		return view('kecamatan/tampildata');
    }
    
    public function ambildata()
    {
        if ($this->request->isAJAX()){
            
            $data = [
                'tampildata' => $this->joda->get_kec_kab() //join kecamatan dan kabupaten
               // 'tampildata' => $this->kec->findAll() //join kecamatan dan kabupaten
            ];

            $msg = [
                'data' => view('kecamatan/datakecamatan',$data)
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
                    'tampildata' => $this->kab->findAll()
            ];

            $msg  = [
                'data' => view('kecamatan/modaltambah',$data)  
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
                'kd_kec' => [
                        'label' => 'Kode Kabupaten',
                        'rules' => 'required|is_unique[kecamatan.kd_kab]',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                            'is_unique' => '{field} tidak boleh ada yang sama'
                        ]
                    ],
                'nm_kec' => [
                        'label' => 'Nama Kecamatan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                    ]
            ]);

            if(!$valid){ //jika validasinya tidak valid maka tampilkan data kedalam bentuk json
                $msg = [
                    'error' => [
                        'kd_kec' => $validation->getError('kd_kec'),
                        'nm_kec' => $validation->getError('nm_kec')
                    ]
                ];              
                
            }else {
                $simpandata = [ //'field dari database' => $this->request->getPost('name dari inputan'),
                    'kd_kab' => $this->request->getPost('kd_kab'),
                    'kd_kec' => $this->request->getPost('kd_kec'),
                    'nm_kec' => $this->request->getPost('nm_kec'),
                ];

               // $kab = new Modelkabupaten;

                $this->kec->insert($simpandata);

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
            $kodekecamatan = $this->request->getPost('kd_kec');

           // $kab = new Modelkabupaten;
            $row = $this->kec->find($kodekecamatan);
            //$row = $this->joda->get_kec_kab()
            $kode_kab=$row['kd_kab'];
            $kabupaten = $this->kab->find($kode_kab);
            
            $data = [
                'kd_kec' => $row['kd_kec'],
                'nm_kec' => $row['nm_kec'],
                'kd_kab' => $row['kd_kab'],
                'nm_kab' => $kabupaten['nm_kab'],
                'tampildata' => $this->kab->findAll()
            ];

            $msg = [
                'sukses' => view('kecamatan/modaledit', $data)
            ];

            echo json_encode($msg);  
        }
    }

    public function updatedata(){
        //  $this->load->helper(array('form', 'url'));
        if ($this->request->isAJAX())
        {
                $simpandata = [ //'field dari database' => $this->request->getPost('name dari inputan'),                    
                    'nm_kec' => $this->request->getPost('nm_kec'),
                    'kd_kab' => $this->request->getPost('kd_kab'),
                ];

               // $kab = new Modelkabupaten;

                $kodekecamatan = $this->request->getPost('kd_kec');

                $this->kec->update($kodekecamatan, $simpandata);

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

                $kodekecamatan = $this->request->getVar('kd_kec');

                $this->kec->delete($kodekecamatan);

                $msg = [
                    'sukses' => "data kabupaten $kodekecamatan telah di hapus"
                ];

                echo json_encode($msg);

        }

    }
    


}