<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Listas extends CI_Controller {

    public function index() {
        if ($this->session->logado == true) {
            $this->load->view('include/header');
            $this->load->view('user/listas');
            $this->load->view('include/footer');
        } else {
            redirect();
        }
    }

}