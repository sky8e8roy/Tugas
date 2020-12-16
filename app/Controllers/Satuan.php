<?php 
namespace App\Controllers;

use App\Models\Modelsatuan;

class Satuan extends BaseController
{
	public function index()
	{
		return view('satuan/tampildata');
    }
    
    public function ambildata()
    {
        if ($this->request->isAJAX()){
           // $sat = new Modelsatuan;
            $data = [
                'tampildata' => $this->sat->findAll()
            ];

            $msg = [
                'data' => view('satuan/datasatuan',$data)
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
                'data' => view('satuan/modaltambah')  
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
                'kd_sat' => [
                        'label' => 'Kode Satuan',
                        'rules' => 'required|is_unique[satuan.kd_sat]',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                            'is_unique' => '{field} tidak boleh ada yang sama'
                        ]
                    ],
                'nm_sat' => [
                        'label' => 'Nama Satuan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                    ]
            ]);

            if(!$valid){ //jika validasinya tidak valid maka tampilkan data kedalam bentuk json
                $msg = [
                    'error' => [
                        'kd_sat' => $validation->getError('kd_sat'),
                        'nm_sat' => $validation->getError('nm_sat')
                    ]
                ];              
                
            }else {
                $simpandata = [ //'field dari database' => $this->request->getPost('name dari inputan'),
                    'kd_sat' => $this->request->getPost('kd_sat'),
                    'nm_sat' => $this->request->getPost('nm_sat'),
                ];

               // $sat = new Modelsatuan;

                $this->sat->insert($simpandata);

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
            $kodesatuan = $this->request->getPost('kd_sat');

           // $sat = new Modelsatuan;
            $row = $this->sat->find($kodesatuan);
            
            $data = [
                'kd_sat' => $row['kd_sat'],
                'nm_sat' => $row['nm_sat'],
            ];

            $msg = [
                'sukses' => view('satuan/modaledit', $data)
            ];

            echo json_encode($msg);  
        }
    }

    public function updatedata(){
        //  $this->load->helper(array('form', 'url'));
        if ($this->request->isAJAX())
        {
                $simpandata = [ //'field dari database' => $this->request->getPost('name dari inputan'),                    
                    'nm_sat' => $this->request->getPost('nm_sat'),
                ];

               // $sat = new Modelsatuan;

                $kodesatuan = $this->request->getPost('kd_sat');

                $this->sat->update($kodesatuan, $simpandata);

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

                //$sat = new Modelsatuan;

                $kodesatuan = $this->request->getVar('kd_sat');

                $this->sat->delete($kodesatuan);

                $msg = [
                    'sukses' => "data satuan $kodesatuan telah di hapus"
                ];

                echo json_encode($msg);

        }

    }
    

}
