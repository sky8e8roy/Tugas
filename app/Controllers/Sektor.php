<?php 
namespace App\Controllers;

use App\Models\Modelsatker;

class Sektor extends BaseController
{
	public function index()
	{
		return view('sektor/tampildata');
    }
    
    public function ambildata()
    {
        if ($this->request->isAJAX()){
            
            $data = [
                'tampildata' => $this->sek->findAll()
            ];

            $msg = [
                'data' => view('sektor/datasektor',$data)
            ];

            echo json_encode($msg);

        }else{
            exit('maaf data tidak dapat di proses!');
        }
    }

    public function formtambah()
    {
      //  $this->load->helper(array('form', 'url'));
        if ($this->request->isAJAX()){

            $msg  = [
                'data' => view('sektor/modaltambah')  
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
                'kd_sek' => [
                        'label' => 'Kode Sektor',
                        'rules' => 'required|is_unique[sektor.kd_sek]',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                            'is_unique' => '{field} tidak boleh ada yang sama'
                        ]
                    ],
                'nm_sek' => [
                        'label' => 'Nama Sektor',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                    ]
            ]);

            if(!$valid){ //jika validasinya tidak valid maka tampilkan data kedalam bentuk json
                $msg = [
                    'error' => [
                        'kd_sek' => $validation->getError('kd_sek'),
                        'nm_sek' => $validation->getError('nm_sek')
                    ]
                ];              
                
            }else {
                $simpandata = [ //'field dari database' => $this->request->getPost('name dari inputan'),
                    'kd_sek' => $this->request->getPost('kd_sek'),
                    'nm_sek' => $this->request->getPost('nm_sek'),
                ];

               // $kab = new Modelkabupaten;

                $this->sek->insert($simpandata);

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
            $kodesektor = $this->request->getPost('kd_sek');

           // $kab = new Modelkabupaten;
            $row = $this->sek->find($kodesektor);
            
            $data = [
                'kd_sek' => $row['kd_sek'],
                'nm_sek' => $row['nm_sek'],
            ];

            $msg = [
                'sukses' => view('sektor/modaledit', $data)
            ];

            echo json_encode($msg);  
        }
    }

    public function updatedata(){
        //  $this->load->helper(array('form', 'url'));
        if ($this->request->isAJAX())
        {
                $simpandata = [ //'field dari database' => $this->request->getPost('name dari inputan'),                    
                    'nm_sek' => $this->request->getPost('nm_sek'),
                ];

               // $kab = new Modelkabupaten;

                $kodesektor = $this->request->getPost('kd_sek');

                $this->sek->update($kodesektor, $simpandata);

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

                $kodesektor = $this->request->getVar('kd_sek');

                $this->sek->delete($kodesektor);

                $msg = [
                    'sukses' => "Data Satuan Kerja $kodesektor telah di hapus"
                ];

                echo json_encode($msg);

        }

    }
    

}
