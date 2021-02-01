<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ortu extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('m_ortu');

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
}