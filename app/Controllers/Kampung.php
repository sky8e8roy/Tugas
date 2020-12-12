<?php 
namespace App\Controllers;

use App\Models\Modelkabupaten;
use App\Models\Modelkecamatan;
use App\Models\Modelkampung;

class Kampung extends BaseController
{
	public function index()
	{
		return view('kampung/tampildata');
    }
    
    public function ambildata()
    {
        if ($this->request->isAJAX()){
            
            $data = [
               // 'tampildata' => $this->joda->get_kec_kab() //join kecamatan dan kabupaten
               // 'tampildata' => $this->kam->findAll() //join kecamatan dan kabupaten
                'tampildata' => $this->joda->get_kp_kec() //join kampung dan kecamatan
            ];

            $msg = [
                'data' => view('kampung/datakampung',$data)
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
                    'tampildata' => $this->kec->findAll()
            ];

            $msg  = [
                'data' => view('kampung/modaltambah',$data)  
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
                'kd_kp' => [
                        'label' => 'Kode Kampung',
                        'rules' => 'required|is_unique[kampung.kd_kp]',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                            'is_unique' => '{field} tidak boleh ada yang sama'
                        ]
                    ],
                'nm_kp' => [
                        'label' => 'Nama Kampung',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                    ]
            ]);

            if(!$valid){ //jika validasinya tidak valid maka tampilkan data kedalam bentuk json
                $msg = [
                    'error' => [
                        'kd_kp' => $validation->getError('kd_kp'),
                        'nm_kp' => $validation->getError('nm_kp')
                    ]
                ];              
                
            }else {
                $simpandata = [ //'field dari database' => $this->request->getPost('name dari inputan'),
                    'kd_kec' => $this->request->getPost('kd_kec'),
                    'kd_kp' => $this->request->getPost('kd_kp'),
                    'nm_kp' => $this->request->getPost('nm_kp'),
                ];

               // $kab = new Modelkabupaten;

                $this->kp->insert($simpandata);

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
            $kodekampung = $this->request->getPost('kd_kp');

           // $kab = new Modelkabupaten;
            $row = $this->kp->find($kodekampung); //cari kode kecamatan di tbl kampung
            //$row = $this->joda->get_kec_kab()
            $kode_kec=$row['kd_kec']; //jadikan row
            $kecamatan = $this->kec->find($kode_kec); // cari nama kecamatan di tbl kecamatan berdasarkan kode kec di tbl kampung 
            
            $data = [
                'kd_kp' => $row['kd_kp'],
                'nm_kp' => $row['nm_kp'],
                'kd_kec' => $row['kd_kec'],
                'nm_kec' => $kecamatan['nm_kec'], //nama kecamatan
                'tampildata' => $this->kec->findAll()
            ];

            $msg = [
                'sukses' => view('kampung/modaledit', $data)
            ];

            echo json_encode($msg);  
        }
    }

    public function updatedata(){
        //  $this->load->helper(array('form', 'url'));
        if ($this->request->isAJAX())
        {
            
                $simpandata = [ //'field dari database' => $this->request->getPost('name dari inputan'),                    
                    'nm_kp' => $this->request->getPost('nm_kp'),
                    'kd_kec' => $this->request->getPost('kd_kec'),
                ];

               // $kab = new Modelkabupaten;

                $kodekampung = $this->request->getPost('kd_kp');

                $this->kp->update($kodekampung, $simpandata);

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

                $kodekampung = $this->request->getVar('kd_kp');

                $this->kp->delete($kodekampung);

                $msg = [
                    'sukses' => "data kabupaten $kodekampung telah di hapus"
                ];

                echo json_encode($msg);

        }

    }

    

    


}