<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function index() {
        if ($this->session->logado_admin == true) {
            $this->load->model('usuarios_model', 'usuarios');
            $dados['usuarios'] = $this->usuarios->select();
            $this->load->view('include/aside');
            $this->load->view('include/head');
            $this->load->view('include/header_admin');
            $this->load->view('admin/usuarios/list', $dados);
        } else {
            redirect();
        }
    }

}