<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Empresas extends CI_Controller {

    public function index() {
        if ($this->session->logado_admin == true) {
            $this->load->model('empresas_model', 'empresas');
            $dados['empresas'] = $this->empresas->select();
            $this->load->view('include/aside');
            $this->load->view('include/head');
            $this->load->view('include/header_admin');
            $this->load->view('admin/empresas/list', $dados);
        } else {
            redirect();
        }
    }

}