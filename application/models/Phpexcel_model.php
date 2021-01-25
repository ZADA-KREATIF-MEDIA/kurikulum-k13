<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Phpexcel_model extends CI_Model {

	public function upload_data_siswa($filename){
        ini_set('memory_limit', '-1');
        $inputFileName = './assets/file_import/'.$filename;
        try {
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        } catch(Exception $e) {
        die('Error loading file :' . $e->getMessage());
        }

        $worksheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        $numRows = count($worksheet);

        for ($i=2; $i < ($numRows+1) ; $i++) { 
        	//$tgl_asli = str_replace('///', '-', $worksheet[$i]['H']);
	        $exp_tgl_asli = explode('-', $worksheet[$i]['D']);
	        $exp_tahun = explode(' ', $exp_tgl_asli[0]); //format yyyy-mm-dd
	        //$tgl_sql = $exp_tahun[2].'-'.$exp_tgl_asli[1].'-'.$exp_tgl_asli[1].' '.$exp_tahun[1];
            $tgl_sql = $exp_tgl_asli[0].'-'.$exp_tgl_asli[1].'-'.$exp_tgl_asli[2];

            //---------
            $exp_tgl_asli2 = explode('-', $worksheet[$i]['M']);
            $exp_tahun2 = explode(' ', $exp_tgl_asli[0]); //format yyyy-mm-dd
            $tgl_sql2 = $exp_tgl_asli[0].'-'.$exp_tgl_asli[1].'-'.$exp_tgl_asli[2];

	        $ins = array(
	        		"nama_siswa" => $worksheet[$i]["A"],
                    "nis" => $worksheet[$i]["B"],
                    "tempat_lahir" => $worksheet[$i]["C"],
                    "tgl_lahir" => $tgl_sql,
                    "kelamin" => $worksheet[$i]["E"],
                    "agama" => $worksheet[$i]["F"],
                    "status_dlm_kel" => $worksheet[$i]["G"],
                    "anakke" => $worksheet[$i]["H"],
                    "alamat_siswa" => $worksheet[$i]["I"],
                    "telpon_siswa" => $worksheet[$i]["J"],
                    "asal_sekolah" => $worksheet[$i]["K"],
                    "kelas" => $worksheet[$i]["L"],
                    "diterima_tanggal" => $tgl_sql2,
                    "nama_ayah" => $worksheet[$i]["N"],
                    "nama_ibu" => $worksheet[$i]["O"],
                    "alamat_ortu" => $worksheet[$i]["P"],
                    "telpon_ortu" => $worksheet[$i]["Q"],
                    "kerja_ayah" => $worksheet[$i]["R"],
                    "kerja_ibu" => $worksheet[$i]["S"],
                    "nama_wali" => $worksheet[$i]["T"],
                    "alamat_wali" => $worksheet[$i]["U"],
                    "telpon_wali" => $worksheet[$i]["V"],
                    "kerja_wali" => $worksheet[$i]["W"],
                    "tahun_ajaran" => $worksheet[$i]["X"],
                    "username" => $worksheet[$i]["Y"],
                    "password" => md5($worksheet[$i]["Z"]),
	        		"nisn" => $worksheet[$i]["AA"],
                    "foto_siswa" => $worksheet[$i]["AB"],
                    "status" => $worksheet[$i]["AC"]
                    
                    //"level" => $worksheet[$i]["Q"]
	        	   );

	        $insert = $this->db->insert('data_siswa', $ins);
            if(!$insert)
                die (mysql_error());
	    }
    }

    public function upload_data_guru($filename){
        ini_set('memory_limit', '-1');
        $inputFileName = './assets/file_import/'.$filename;
        try {
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        } catch(Exception $e) {
        die('Error loading file :' . $e->getMessage());
        }

        $worksheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        $numRows = count($worksheet);

        for ($i=2; $i < ($numRows+1) ; $i++) { 
            //$tgl_asli = str_replace('/', '-', $worksheet[$i]['H']);
            //$exp_tgl_asli = explode('-', $tgl_asli);
            //$exp_tahun = explode(' ', $exp_tgl_asli[2]);
            //$tgl_sql = $exp_tahun[0].'-'.$exp_tgl_asli[1].'-'.$exp_tgl_asli[1].' '.$exp_tahun[1];
            //$tgl_sql = $exp_tgl_asli[2].'-'.$exp_tgl_asli[1].'-'.$exp_tgl_asli[0];

            $ins = array(
                    "nama_guru" => $worksheet[$i]["A"],
                    "nip" => $worksheet[$i]["B"],
                    "kelamin" => $worksheet[$i]["C"],
                    "alamat_guru" => $worksheet[$i]["D"],
                    "telpon_guru" => $worksheet[$i]["E"],
                    "username" => $worksheet[$i]["F"],
                    "password" => md5($worksheet[$i]["G"]),
                    "nik" => $worksheet[$i]["H"],
                    "status_pns" => $worksheet[$i]["I"],
                    "foto_guru" => $worksheet[$i]["J"]
                    
                    //"level" => $worksheet[$i]["Q"]
                   );

            $insert = $this->db->insert('data_guru', $ins);
            if(!$insert)
                die (mysql_error());
        }
    }
    //----------------------------------------------------------------------------------------
     public function importin_nilai_siswa($filename,$idpel,$idkel,$idguru,$idsms,$idthn){
        ini_set('memory_limit', '-1');
        $inputFileName = './assets/file_import/'.$filename;
        try {
        //libxml_use_internal_errors(true);
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        } catch(Exception $e) {
        die('Error loading file :' . $e->getMessage());
        }

        $worksheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        $numRows = count($worksheet);

        for ($i=4; $i < ($numRows+1) ; $i++) { 
            //$tgl_asli = str_replace('/', '-', $worksheet[$i]['H']);
            //$exp_tgl_asli = explode('-', $tgl_asli);
            //$exp_tahun = explode(' ', $exp_tgl_asli[2]);
            //$tgl_sql = $exp_tahun[0].'-'.$exp_tgl_asli[1].'-'.$exp_tgl_asli[1].' '.$exp_tahun[1];
            //$tgl_sql = $exp_tgl_asli[2].'-'.$exp_tgl_asli[1].'-'.$exp_tgl_asli[0];

            $ins = array(
                    "nis" => $worksheet[$i]["B"],
                    //"id_pelajaran" => $worksheet[$i]["C"],
                    //"id_kelas" => $worksheet[$i]["D"],
                    //"id_guru" => $worksheet[$i]["E"],
                    "id_pelajaran" => $idpel,
                    "id_kelas" => $idkel,
                    "id_guru" => $idguru,
                    "nilai_pengetahuan" => $worksheet[$i]["D"],
                    "nilai_ketrampilan" => $worksheet[$i]["E"],
                    "id_tahun" => $idthn,
                    "semester" => $idsms
                    //"id_tahun" => $worksheet[$i]["H"],
                    //"semester" => $worksheet[$i]["I"]
            );
           
           
            $insert = $this->db->insert('tbl_nilai', $ins);
            if(!$insert)
                die (mysql_error());
        }
    }


     public function importup_nilai_siswa($filename,$idpel,$idkel,$idguru,$idsms,$idthn){
        ini_set('memory_limit', '-1');
        $inputFileName = './assets/file_import/'.$filename;
        try {
        //libxml_use_internal_errors(true);
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        } catch(Exception $e) {
        die('Error loading file :' . $e->getMessage());
        }

        $worksheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        $numRows = count($worksheet);

        for ($i=4; $i < ($numRows+1) ; $i++) {

                            //$tgl_asli = str_replace('/', '-', $worksheet[$i]['H']);
                //$exp_tgl_asli = explode('-', $tgl_asli);
                //$exp_tahun = explode(' ', $exp_tgl_asli[2]);
                //$tgl_sql = $exp_tahun[0].'-'.$exp_tgl_asli[1].'-'.$exp_tgl_asli[1].' '.$exp_tahun[1];
                //$tgl_sql = $exp_tgl_asli[2].'-'.$exp_tgl_asli[1].'-'.$exp_tgl_asli[0];

                $ins = array(
                        "nis" => $worksheet[$i]["C"],
                        //"id_pelajaran" => $worksheet[$i]["D"],
                        //"id_kelas" => $worksheet[$i]["E"],
                        //"id_guru" => $worksheet[$i]["F"],
                        "id_pelajaran" => $idpel,
                        "id_kelas" => $idkel,
                        "id_guru" => $idguru,
                        "nilai_pengetahuan" => $worksheet[$i]["E"],
                        "nilai_ketrampilan" => $worksheet[$i]["F"],
                        "id_tahun" => $idthn,
                        "semester" => $idsms
                        //"id_tahun" => $worksheet[$i]["I"],
                        //"semester" => $worksheet[$i]["J"]
                );

                $idnilai = $worksheet[$i]['B'];

                $replace = $this->db->update('tbl_nilai', $ins, 'id_nilai='.$idnilai.'');
                if(!$replace)
                    die (mysql_error());
           
            
        }
    }

     public function importup_deskripsi($filename,$idpel,$idkel,$idguru,$idsms,$idthn){
        ini_set('memory_limit', '-1');
        $inputFileName = './assets/file_import/'.$filename;
        try {
        //libxml_use_internal_errors(true);
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        } catch(Exception $e) {
        die('Error loading file :' . $e->getMessage());
        }

        $worksheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        $numRows = count($worksheet);

        for ($i=5; $i < ($numRows+1) ; $i++) {

                            //$tgl_asli = str_replace('/', '-', $worksheet[$i]['H']);
                //$exp_tgl_asli = explode('-', $tgl_asli);
                //$exp_tahun = explode(' ', $exp_tgl_asli[2]);
                //$tgl_sql = $exp_tahun[0].'-'.$exp_tgl_asli[1].'-'.$exp_tgl_asli[1].' '.$exp_tahun[1];
                //$tgl_sql = $exp_tgl_asli[2].'-'.$exp_tgl_asli[1].'-'.$exp_tgl_asli[0];

                $data = array(
                        'id_nilai' => $worksheet[$i]["B"],
                        //'id_pelajaran' => $worksheet[$i]["D"],
                        'id_pelajaran' => $idpel,
                        'nis' => $worksheet[$i]["C"],
                        'pengetahuan' => $worksheet[$i]["F"],
                        'ketrampilan' => $worksheet[$i]["H"],
                        'semester' => $idsms,
                        'id_tahun' => $idthn
                        //'semester' => $worksheet[$i]["J"],
                        //'id_tahun' => $worksheet[$i]["K"]
                );

                $this->db->replace('tbl_deskripsi_nilai', $data);
                //$where = array(
                  //  'id_nilai' => $worksheet[$i]["C"]
                //);
                //$this->db->update('tbl_deskripsi_nilai',$data,$where);
                
        }
    }

     public function importin_nilai_sikap($filename,$idkel,$idwali,$idsms,$idthn){
        ini_set('memory_limit', '-1');
        $inputFileName = './assets/file_import/'.$filename;
        try {
        //libxml_use_internal_errors(true);
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        } catch(Exception $e) {
        die('Error loading file :' . $e->getMessage());
        }

        $worksheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        $numRows = count($worksheet);

        for ($i=5; $i < ($numRows+1) ; $i++) {
                   
            $data = array(
                'nis' => $worksheet[$i]["B"],
                'id_kelas' => $idkel,
                'id_wali' => $idwali,
                'id_semester' => $idsms,
                'id_tahun' => $idthn,
                'predikat_spiritual' => $worksheet[$i]["C"],
                'sikap_spiritual' => $worksheet[$i]["D"],
                'predikat_sosial' => $worksheet[$i]["E"],
                'sikap_sosial' => $worksheet[$i]["F"]
            );

            $insert = $this->db->insert('tbl_nilai_sikap', $data);
            if(!$insert)
                die (mysql_error());
                
        }
    }

     public function importup_nilai_sikap($filename,$idkel,$idwali,$idsms,$idthn){
        ini_set('memory_limit', '-1');
        $inputFileName = './assets/file_import/'.$filename;
        try {
        //libxml_use_internal_errors(true);
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        } catch(Exception $e) {
        die('Error loading file :' . $e->getMessage());
        }

        $worksheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        $numRows = count($worksheet);

        for ($i=5; $i < ($numRows+1) ; $i++) {
                   
                $data = array(
                    "predikat_spiritual" => $worksheet[$i]["D"],
                    "sikap_spiritual" => $worksheet[$i]["E"],
                    "predikat_sosial" => $worksheet[$i]["F"],
                    "sikap_sosial" => $worksheet[$i]["G"]
                );

                $where = array(
                    'nis' => $worksheet[$i]["B"],
                    'id_kelas' => $idkel,
                    'id_wali' => $idwali,
                    'id_semester' => $idsms,
                    'id_tahun' => $idthn
                );

                $this->db->update('tbl_nilai_sikap', $data, $where);
                
        }
    }

}

/* End of file Phpexcel_model.php */
/* Location: ./application/models/Phpexcel_model.php */