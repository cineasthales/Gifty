<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TiposInteresses extends CI_Controller {

    public function index() {
        if ($this->session->logado_admin == true) {
            $this->load->model('tiposinteresses_model', 'tiposinteresses');
            $dados['tiposinteresses'] = $this->tiposinteresses->select();
            $this->load->view('include/aside');
            $this->load->view('include/head');
            $this->load->view('include/header_admin');
            $this->load->view('admin/tiposinteresses/list', $dados);
        } else {
            redirect();
        }
    }

}