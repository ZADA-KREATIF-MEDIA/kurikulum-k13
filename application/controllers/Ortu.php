<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ortu extends CI_Controller {
    public function index()
    {
        $data['content'] = "ortu/content";
        $this->load->view('ortu/index', $data);
    }
}