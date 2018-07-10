<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Quemsomos extends CI_Controller {

    public function index() {
        $this->load->view('include/head');
        $this->load->view('include/header_ext');
        $this->load->view('quemsomos');
        $this->load->view('include/footer');
    }

}
