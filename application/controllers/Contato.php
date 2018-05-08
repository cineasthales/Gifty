<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contato extends CI_Controller {

    public function index() {
        $this->load->view('include/head');
        $this->load->view('include/header_ext');
        $this->load->view('contato');
        $this->load->view('include/footer');
    }

}
