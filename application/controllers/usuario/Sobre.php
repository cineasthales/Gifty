<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sobre extends CI_Controller {

    public function index() {
        if ($this->session->logado == true) {
            $this->load->view('include/head');
            $this->load->view('include/header_user');
            $this->load->view('sobre');
            $this->load->view('include/footer_user');
        } else {
            redirect();
        }
    }

}