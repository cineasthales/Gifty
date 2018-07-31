<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracoes extends CI_Controller {

    public function index() {
        if ($this->session->logado == true) {
            if ($this->session->has_userdata('idEvento')) {
                $this->session->unset_userdata('idEvento');
            }
            $this->load->view('include/head');
            $this->load->view('include/header_user');
            $this->load->view('user/configuracoes');
            $this->load->view('include/footer');
        } else {
            redirect();
        }
    }

}
