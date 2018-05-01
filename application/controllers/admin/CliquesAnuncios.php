<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CliquesAnuncios extends CI_Controller {

    public function index() {
        if ($this->session->logado_admin == true) {
            $this->load->model('cliquesanuncios_model', 'cliquesanuncios');
            $dados['cliquesanuncios'] = $this->cliquesanuncios->select();
            $this->load->view('include/aside');
            $this->load->view('include/head');
            $this->load->view('include/header_admin');
            $this->load->view('admin/cliquesanuncios/list', $dados);
        } else {
            redirect();
        }
    }

}