<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index() {
        if ($this->session->logado == true) {
            redirect('usuario');
        } else {
            $this->load->view('include/header_ext');
            $this->load->view('inicio');
            $this->load->view('include/footer');
        }
    }

    public function logar() {
        $this->load->model('usuarios_model', 'usuarios');
        $user = $this->input->post('user');
        $senha = $this->input->post('senha');
        $verifica = $this->usuarios->check($user, md5($senha), $user, md5($senha));
        if (isset($verifica)) {
            $sessao['id'] = $verifica->id;
            $sessao['nome'] = $verifica->nome;
            $sessao['nivel'] = $verifica->nivel;
            $sessao['logado'] = true;           
            $this->session->set_userdata($sessao);
        } else {
            $mensagem = "Nome de usuário, e-mail e/ou senha incorretos.";
            $tipo = 0;
            $this->session->set_flashdata('mensagem', $mensagem);
            $this->session->set_flashdata('tipo', $tipo);
        }
        redirect('home');
    }

    public function sair() {
        $this->session->sess_destroy();
        redirect('home');
    }

    public function cadastrar() {
        $this->load->view('include/header_ext');
        $this->load->view('cadastro');
        $this->load->view('include/footer');
    }

}
