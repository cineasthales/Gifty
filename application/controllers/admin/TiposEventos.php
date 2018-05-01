<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TiposEventos extends CI_Controller {

    public function index() {
        if ($this->session->logado_admin == true) {
            $this->load->model('tiposeventos_model', 'tiposeventos');
            $dados['tiposeventos'] = $this->tiposeventos->select();
            $this->load->view('include/aside');
            $this->load->view('include/head');
            $this->load->view('include/header_admin');
            $this->load->view('admin/tiposeventos/list', $dados);
        } else {
            redirect();
        }
    }

}