<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracoes extends CI_Controller {

    public function index() {
        if ($this->session->logado == true) {
            $this->load->model('usuarios_model', 'usuarios');
            $dados['usuario'] = $this->usuarios->findEndereco($this->session->id);
            $this->load->model('telefones_model', 'telefones');
            $dados['telefones'] = $this->telefones->findUsuario($this->session->id);
            $this->load->view('include/head');
            $this->load->view('include/header_user');
            $this->load->view('user/configuracoes', $dados);
            $this->load->view('include/footer');
        } else {
            redirect();
        }
    }

}
