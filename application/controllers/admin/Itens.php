<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Itens extends CI_Controller {

    public function index() {
        if ($this->session->logado_admin == true) {
            $this->load->model('itens_model', 'itens');
            $dados['itens'] = $this->itens->select();
            $this->load->view('include/aside');
            $this->load->view('include/head');
            $this->load->view('include/header_admin');
            $this->load->view('admin/itens/list', $dados);
        } else {
            redirect();
        }
    }

}