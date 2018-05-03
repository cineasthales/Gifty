<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Anuncios extends CI_Controller {

    public function index() {
        if ($this->session->logado_admin == true) {
            $this->load->model('anuncios_model', 'anuncios');
            $dados['anuncios'] = $this->anuncios->select();
            $this->load->view('include/aside');
            $this->load->view('include/head');
            $this->load->view('include/header_admin');
            $this->load->view('admin/anuncios/list', $dados);
            $this->load->view('include/footer_admin');
        } else {
            redirect();
        }
    }

}