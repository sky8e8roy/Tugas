<?php 
namespace App\Controllers;

use App\Models\Modelkabupaten;

class Kabupaten extends BaseController
{
	public function index()
	{
		return view('kabupaten/tampildata');
    }
    
    public function ambildata()
    {
        if ($this->request->isAJAX()){
           // $kab = new Modelkabupaten;
            $data = [
                'tampildata' => $this->kab->findAll()
            ];

            $msg = [
                'data' => view('kabupaten/datakabupaten',$data)
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
                'data' => view('kabupaten/modaltambah')  
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
                'kd_kab' => [
                        'label' => 'Kode Kabupaten',
                        'rules' => 'required|is_unique[kabupaten.kd_kab]',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                            'is_unique' => '{field} tidak boleh ada yang sama'
                        ]
                    ],
                'nm_kab' => [
                        'label' => 'Nama Kabupaten',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                    ]
            ]);

            if(!$valid){ //jika validasinya tidak valid maka tampilkan data kedalam bentuk json
                $msg = [
                    'error' => [
                        'kd_kab' => $validation->getError('kd_kab'),
                        'nm_kab' => $validation->getError('nm_kab')
                    ]
                ];              
                
            }else {
                $simpandata = [ //'field dari database' => $this->request->getPost('name dari inputan'),
                    'kd_kab' => $this->request->getPost('kd_kab'),
                    'nm_kab' => $this->request->getPost('nm_kab'),
                ];

               // $kab = new Modelkabupaten;

                $this->kab->insert($simpandata);

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
            $kodekabupaten = $this->request->getPost('kd_kab');

           // $kab = new Modelkabupaten;
            $row = $this->kab->find($kodekabupaten);
            
            $data = [
                'kd_kab' => $row['kd_kab'],
                'nm_kab' => $row['nm_kab'],
            ];

            $msg = [
                'sukses' => view('kabupaten/modaledit', $data)
            ];

            echo json_encode($msg);  
        }
    }

    public function updatedata(){
        //  $this->load->helper(array('form', 'url'));
        if ($this->request->isAJAX())
        {
                $simpandata = [ //'field dari database' => $this->request->getPost('name dari inputan'),                    
                    'nm_kab' => $this->request->getPost('nm_kab'),
                ];

               // $kab = new Modelkabupaten;

                $kodekabupaten = $this->request->getPost('kd_kab');

                $this->kab->update($kodekabupaten, $simpandata);

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

                $kodekabupaten = $this->request->getVar('kd_kab');

                $this->kab->delete($kodekabupaten);

                $msg = [
                    'sukses' => "data kabupaten $kodekabupaten telah di hapus"
                ];

                echo json_encode($msg);

        }

    }
    

}
