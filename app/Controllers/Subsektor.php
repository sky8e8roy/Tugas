<?php 
namespace App\Controllers;

use App\Models\Modelkabupaten;
use App\Models\Modelkecamatan;
use App\Models\Modelkampung;
use App\Models\Modelsubsektor;

class Subsektor extends BaseController
{
	public function index()
	{
		return view('subsektor/tampildata');
    }
    
    public function ambildata()
    {
        if ($this->request->isAJAX()){
            
            $data = [
               // 'tampildata' => $this->joda->get_kec_kab() //join kecamatan dan kabupaten
               // 'tampildata' => $this->kam->findAll() //join kecamatan dan kabupaten
                'tampildata' => $this->joda->get_subsek_satker_sek() //join kampung dan kecamatan
            ];

            $msg = [
                'data' => view('subsektor/datasubsektor',$data)
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
                    'tampildataSek' => $this->sek->findAll(),
                    'tampildataSatker' => $this->satker->findAll()
            ];

            $msg  = [
                'data' => view('subsektor/modaltambah',$data)  
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
                'nm_subsek' => [
                        'label' => 'Nama Sub Sektor',
                        'rules' => 'required|is_unique[subsektor.nm_subsek]',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                            'is_unique' => '{field} tidak boleh ada yang sama'
                        ]
                    ],
                //'nm_kp' => [
                //        'label' => 'Nama Kampung',
                //        'rules' => 'required',
                //        'errors' => [
                //            'required' => '{field} tidak boleh kosong',
                //        ]
                //    ]
            ]);

            if(!$valid){ //jika validasinya tidak valid maka tampilkan data kedalam bentuk json
                $msg = [
                    'error' => [
                       // 'kd_kp' => $validation->getError('kd_kp'),
                        'nm_subsek' => $validation->getError('nm_subsek')
                    ]
                ];              
                
            }else {
                $simpandata = [ //'field dari database' => $this->request->getPost('name dari inputan'),
                    'nm_subsek' => $this->request->getPost('nm_subsek'),
                    'kd_satker' => $this->request->getPost('kd_satker'),
                    'kd_sek' => $this->request->getPost('kd_sek'),
                ];

               // $kab = new Modelkabupaten;

                $this->subsek->insert($simpandata);

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
            $idsubsek = $this->request->getPost('id_subsek');

           // $kab = new Modelkabupaten;
            $row = $this->subsek->find($idsubsek); //cari id subsektor di tbl subsektor
            
            $kode_sek=$row['kd_sek']; //jadikan row
            $sektor = $this->sek->find($kode_sek); // cari nama sektor di tbl sektor berdasarkan kode kec di tbl subsektor

            $kode_satker=$row['kd_satker']; //jadikan row
            $satker = $this->satker->find($kode_satker); // cari nama satker di tbl satker berdasarkan kode kec di tbl subsektor 
            
            $data = [
                'id_subsek' => $row['id_subsek'],
                'nm_subsek' => $row['nm_subsek'],
                'kd_sek' => $row['kd_sek'],
                'nm_sek' => $sektor['nm_sek'], //nama sektor
                'kd_satker' => $satker['kd_satker'],
                'nm_satker' => $satker['nm_satker'], //nama sektor
                'tampildataSek' => $this->sek->findAll(),
                'tampildataSatker' => $this->satker->findAll()
            ];

            $msg = [
                'sukses' => view('subsektor/modaledit', $data)
            ];

            echo json_encode($msg);  
        }
    }

    public function updatedata(){
        //  $this->load->helper(array('form', 'url'));
        if ($this->request->isAJAX())
        {
            
                $simpandata = [ //'field dari database' => $this->request->getPost('name dari inputan'),                    
                    'nm_subsek' => $this->request->getPost('nm_subsek'),
                    'kd_sek' => $this->request->getPost('kd_sek'),
                    'kd_satker' => $this->request->getPost('kd_satker'),
                ];

               // $kab = new Modelkabupaten;

                $kodesubsek = $this->request->getPost('id_subsek');

                $this->subsek->update($kodesubsek, $simpandata);

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

                $kodesubsek = $this->request->getVar('id_subsek');

                $this->subsek->delete($kodesubsek);

                $msg = [
                    'sukses' => "data ini telah di hapus"
                ];

                echo json_encode($msg);

        }

    }

    

    


}