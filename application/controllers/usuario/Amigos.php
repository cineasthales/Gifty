<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Amigos extends CI_Controller {

    public function index() {
        if ($this->session->logado == true) {
            $this->load->view('include/head');
            $this->load->view('include/header_user');
            $this->load->view('user/amigos');
            $this->load->view('include/footer');
        } else {
            redirect();
        }
    }

}