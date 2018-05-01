<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LogUsuarios extends CI_Controller {

    public function index() {
        if ($this->session->logado_admin == true) {
            $this->load->model('logusuarios_model', 'logusuarios');
            $dados['logusuarios'] = $this->logusuarios->select();
            $this->load->view('include/aside');
            $this->load->view('include/head');
            $this->load->view('include/header_admin');
            $this->load->view('admin/logusuarios/list', $dados);
        } else {
            redirect();
        }
    }

}