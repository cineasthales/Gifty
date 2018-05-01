<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LogEventos extends CI_Controller {

    public function index() {
        if ($this->session->logado_admin == true) {
            $this->load->model('logeventos_model', 'logeventos');
            $dados['logeventos'] = $this->logeventos->select();
            $this->load->view('include/aside');
            $this->load->view('include/head');
            $this->load->view('include/header_admin');
            $this->load->view('admin/logeventos/list', $dados);
        } else {
            redirect();
        }
    }

}