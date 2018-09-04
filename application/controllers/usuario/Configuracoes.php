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

    public function desativar() {
        $this->load->model('usuarios_model', 'usuarios');
        $dados['ativo'] = 0;
        if ($this->usuarios->update($dados, $this->session->id)) {
            $mensagem = "Sua conta foi desativada.";
            $tipo = 1;
        } else {
            $mensagem = "Sua conta não foi desativada.";
            $tipo = 0;
        }
        $this->session->sess_destroy();
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect();
    }

    public function reativar($idUsuario) {
        $this->load->model('usuarios_model', 'usuarios');
        $dados['ativo'] = 1;
        if ($this->usuarios->update($dados, $idUsuario)) {
            $mensagem = "Sua conta foi reativada.";
            $tipo = 1;
        } else {
            $mensagem = "Sua conta não foi reativada.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('usuario/inicio');
    }

}
