<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Convidados extends CI_Controller {

    public function index() {
        if ($this->session->logado_admin == true) {
            $this->load->model('convidados_model', 'convidados');
            $dados['convidados'] = $this->convidados->select();
            $this->load->view('include/aside');
            $this->load->view('include/head');
            $this->load->view('include/header_admin');
            $this->load->view('admin/convidados/list', $dados);
            $this->load->view('include/footer_admin');
        } else {
            redirect();
        }
    }

}