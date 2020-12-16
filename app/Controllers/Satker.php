<?php 
namespace App\Controllers;

use App\Models\Modelsatker;

class Satker extends BaseController
{
	public function index()
	{
		return view('satker/tampildata');
    }
    
    public function ambildata()
    {
        if ($this->request->isAJAX()){
            
            $data = [
                'tampildata' => $this->satker->findAll()
            ];

            $msg = [
                'data' => view('satker/datasatker',$data)
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
                'data' => view('satker/modaltambah')  
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
                'kd_satker' => [
                        'label' => 'Kode Satuan Kerja',
                        'rules' => 'required|is_unique[satuankerja.kd_satker]',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                            'is_unique' => '{field} tidak boleh ada yang sama'
                        ]
                    ],
                'nm_satker' => [
                        'label' => 'Nama Satuan Kerja',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                    ]
            ]);

            if(!$valid){ //jika validasinya tidak valid maka tampilkan data kedalam bentuk json
                $msg = [
                    'error' => [
                        'kd_satker' => $validation->getError('kd_satker'),
                        'nm_satker' => $validation->getError('nm_satker')
                    ]
                ];              
                
            }else {
                $simpandata = [ //'field dari database' => $this->request->getPost('name dari inputan'),
                    'kd_satker' => $this->request->getPost('kd_satker'),
                    'nm_satker' => $this->request->getPost('nm_satker'),
                ];

               // $kab = new Modelkabupaten;

                $this->satker->insert($simpandata);

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
            $kodesatuankerja = $this->request->getPost('kd_satker');

           // $kab = new Modelkabupaten;
            $row = $this->satker->find($kodesatuankerja);
            
            $data = [
                'kd_satker' => $row['kd_satker'],
                'nm_satker' => $row['nm_satker'],
            ];

            $msg = [
                'sukses' => view('satker/modaledit', $data)
            ];

            echo json_encode($msg);  
        }
    }

    public function updatedata(){
        //  $this->load->helper(array('form', 'url'));
        if ($this->request->isAJAX())
        {
                $simpandata = [ //'field dari database' => $this->request->getPost('name dari inputan'),                    
                    'nm_satker' => $this->request->getPost('nm_satker'),
                ];

               // $kab = new Modelkabupaten;

                $kodesatker = $this->request->getPost('kd_satker');

                $this->satker->update($kodesatker, $simpandata);

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

                $kodesatker = $this->request->getVar('kd_satker');

                $this->satker->delete($kodesatker);

                $msg = [
                    'sukses' => "Data Satuan Kerja $kodesatker telah di hapus"
                ];

                echo json_encode($msg);

        }

    }
    

}
