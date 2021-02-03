<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ortu extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('m_admin');
        $this->load->model('m_guru');
        $this->load->model('m_cetak');
        $this->load->model('m_ortu');
        $this->load->library('pagination');

        if ($this->session->userdata('status') == "") {
            redirect('login');
        }
    }
    public function index()
    {
        $data['content'] = "ortu/content";
        $this->load->view('ortu/index', $data);
    }

    public function kompetensi_siswa()
    {
        $id = $this->session->userdata('id');
        $data['kompetensi'] = $this->m_ortu->m_get_kompetensi($id);
        // print('<pre>');print_r($data);exit();
        $data['content'] = "ortu/kompetensi";
        $this->load->view('ortu/index', $data);
    }

    public function saran_saran()
    {
        $id = $this->session->userdata('id');
        $data['saran'] = $this->m_ortu->m_get_saran($id);
        // print('<pre>');print_r($data);exit();
        $data['content'] = "ortu/saran";
        $this->load->view('ortu/index', $data);
    }
    public function nilai_raport()
    {
        $id = $this->session->userdata('id');

        $data['siswa'] = $this->m_ortu->m_get_siswa($id);
        //ambil nis siswa  //
        $nis = $data['siswa']['nis'];

        //ambil data kelas siswa//
        $data['kelas'] = $this->m_ortu->m_get_kelas($nis);
        //ambil data id kelas siswa//
        $id_kelas = $data['kelas']['id_kelas'];

        // ambil data tahun aktif
        $data['tahun'] = $this->m_ortu->m_get_tahun_aktif();
        $tahunAktif = $data['tahun']['id_tahun'];

        //ambil data semester aktif
        $data['semester'] = $this->m_ortu->m_get_semester_aktif();
        $semesterAktif = $data['semester']['id_semester'];



        // //FORM CETAK CONTROLLER //
        $data['sekolah'] = $this->m_ortu->m_get_data_sekolah();

        $data['tahun_ajaran'] = $this->m_cetak->select_dataWhere('id_tahun=' . $tahunAktif . '', 'setup_tahun')->row();
        $data['semester'] = $this->m_cetak->select_dataWhere('id_semester=' . $semesterAktif . '', 'setup_semester')->row();
        $data['kelas'] = $this->m_cetak->select_dataWhere('id_kelas=' . $id_kelas . '', 'setup_kelas')->row();
        $kategori_kls = $data['kelas']->kategori_kls;
        // //tbl_nilai,setup_pelajaran,tbl_kategori_mapel,data_siswa,setup_kelas
        $data['nilai_sikap'] = $this->m_cetak->get_nilai_sikap($nis, $id_kelas, $tahunAktif, $semesterAktif);
        $data['nilai_rapor'] = $this->m_cetak->get_nilai_rapor($nis, $id_kelas, $tahunAktif, $semesterAktif, $kategori_kls);
        $data['deskripsi_nilai'] = $this->m_cetak->get_deskripsi_nilai($nis, $id_kelas, $tahunAktif, $semesterAktif);
        $data['nilai_ekstra'] = $this->m_cetak->get_nilai_ekstra($nis, $id_kelas, $tahunAktif, $semesterAktif);
        $data['nilai_prestasi'] = $this->m_cetak->get_nilai_prestasi($nis, $id_kelas, $tahunAktif, $semesterAktif);
        $data['kehadiran'] = $this->m_cetak->get_kehadiran_siswa($nis, $id_kelas, $tahunAktif, $semesterAktif);
        $data['catatan_wk'] = $this->m_cetak->get_cttnwk($nis, $id_kelas, $tahunAktif, $semesterAktif);
        $data['wali_kelas'] = $this->m_cetak->get_wk_saat_ini($tahunAktif, $id_kelas)->row();
        $data['tinggi_berat'] = $this->m_ortu->m_get_tinggi_berat($nis);
        // $data['kepsek'] = $this->m_cetak->get_ref_kepsek($tahunAktif,$semesterAktif)->row();

        // print('<pre>');print_r($data['tinggi_berat']);exit();


        // print('<pre>');print_r($data);exit();
        $data['content'] = "ortu/rapot";
        $this->load->view('ortu/index', $data);
    }
}
