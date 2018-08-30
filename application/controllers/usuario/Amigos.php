<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Amigos extends CI_Controller {

    public function index() {
        if ($this->session->logado == true) {
            if ($this->session->has_userdata('idEvento')) {
                $this->session->unset_userdata('idEvento');
            }
            $this->load->model('amizades_model', 'amizades');
            $dados['amizades'] = $this->amizades->findAll($this->session->id);
            $this->load->view('include/head');
            $this->load->view('include/header_user');
            $this->load->view('user/amigos', $dados);
            $this->load->view('include/footer');
        } else {
            redirect();
        }
    }

    public function perfil($idUsuario) {
        if ($this->session->logado == true) {
            if (isset($idUsuario)) {
                $this->load->model('usuarios_model', 'usuarios');
                $dados['usuario'] = $this->usuarios->findEndereco($idUsuario);
                if ($idUsuario != $this->session->id) {
                    $this->load->model('amizades_model', 'amizades');
                    // busca dados da amizade entre usuário e amigo
                    $dados['amizade'] = $this->amizades->find($idUsuario, $this->session->id);
                    // conta amigos do amigo
                    $dados['numAmigos'] = count($this->amizades->findAll($idUsuario));
                }
                $this->load->view('include/head');
                $this->load->view('include/header_user');
                $this->load->view('user/perfil', $dados);
                $this->load->view('include/footer');
            } else {
                redirect('usuario/amigos');
            }
        } else {
            redirect();
        }
    }

}
