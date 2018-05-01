<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Eventos extends CI_Controller {

    public function index() {
        if ($this->session->logado_admin == true) {
            $this->load->model('eventos_model', 'eventos');
            $dados['eventos'] = $this->eventos->select();
            $this->load->view('include/aside');
            $this->load->view('include/head');
            $this->load->view('include/header_admin');
            $this->load->view('admin/eventos/list', $dados);
        } else {
            redirect();
        }
    }

}