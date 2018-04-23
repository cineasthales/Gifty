<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {

    public function index() {
        if ($this->session->logado == true) {
            $this->load->model('usuarios_model', 'usuarios');
            $dados['usuario'] = $this->usuarios->find($this->session->id);
            $this->load->view('include/header');
            $this->load->view('user/perfil', $dados);
            $this->load->view('include/footer');
        } else {
            redirect();
        }
    }

}
