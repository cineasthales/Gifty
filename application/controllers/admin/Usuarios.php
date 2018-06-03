<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuarios_model', 'usuarios');
    }

    public function index() {
        $this->verificaSessao();
        $busca = $this->input->post('busca');
        if (!isset($busca)) {
            $dados['usuarios'] = $this->usuarios->select();
        } else {
            if ($this->input->post('filtro') == '0') {
                $mensagem = "Selecione um filtro de busca.";
                $tipo = 0;
                $this->session->set_flashdata('mensagem', $mensagem);
                $this->session->set_flashdata('tipo', $tipo);
                redirect('admin/usuarios');
            } else if ($this->input->post('filtro') == '1') {
                $dados['usuarios'] = $this->usuarios->searchId($busca);
            } else if ($this->input->post('filtro') == '2') {
                $dados['usuarios'] = $this->usuarios->searchNome($busca);
            } else if ($this->input->post('filtro') == '3') {
                $dados['usuarios'] = $this->usuarios->searchEmail($busca);
            } else if ($this->input->post('filtro') == '4') {
                $dados['usuarios'] = $this->usuarios->searchNomeUsuario($busca);
            } else {
                $busca = str_replace(".", "", $busca);
                $busca = str_replace("-", "", $busca);
                $dados['usuarios'] = $this->usuarios->searchCPF($busca);
            }
        }
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/usuarios/list', $dados);
        $this->load->view('include/footer_admin');
    }

    public function verificaSessao() {
        if (!$this->session->logado_admin) {
            redirect();
        }
    }

    public function adicionar() {
        $this->verificaSessao();
        $this->load->model('enderecos_model', 'enderecos');
        $dados['enderecos'] = $this->enderecos->select();
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/usuarios/create', $dados);
        $this->load->view('include/footer_admin');
    }

    public function grava_adicao() {
        $dados = $this->input->post();
        $dados['senha'] = md5($dados['senha']);
        $dados['imagem'] = 'x.jpg';
        if ($this->input->post('ativo')) {
            $dados['ativo'] = 1;
        } else {
            $dados['ativo'] = 0;
        }
        if ($this->input->post('notificaEmail')) {
            $dados['notificaEmail'] = 1;
        } else {
            $dados['notificaEmail'] = 0;
        }
        if ($this->input->post('nivel')) {
            $dados['nivel'] = 1;
        } else {
            $dados['nivel'] = 0;
        }
        $dados['tentaLogin'] = 0;
        if ($this->usuarios->insert($dados)) {
            $mensagem = "Usuário cadastrado com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Usuário não foi cadastrado.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/usuarios');
    }

    public function atualizar($id) {
        $this->verificaSessao();
        $dados['usuario'] = $this->usuarios->find($id);
        $this->load->model('enderecos_model', 'enderecos');
        $dados['enderecos'] = $this->enderecos->select();
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/usuarios/update', $dados);
        $this->load->view('include/footer_admin');
    }

    public function grava_atualizacao($id) {
        $dados = $this->input->post();
        $dados['senha'] = md5($dados['senha']);
        $dados['imagem'] = $id . '.jpg';
        if ($this->input->post('ativo')) {
            $dados['ativo'] = 1;
        } else {
            $dados['ativo'] = 0;
        }
        if ($this->input->post('notificaEmail')) {
            $dados['notificaEmail'] = 1;
        } else {
            $dados['notificaEmail'] = 0;
        }
        if ($this->input->post('nivel')) {
            $dados['nivel'] = 1;
        } else {
            $dados['nivel'] = 0;
        }
        $dados['tentaLogin'] = 0;
        if ($this->usuarios->update($dados, $id)) {
            $mensagem = "Usuário atualizado com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Usuário não foi atualizado.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/usuarios');
    }

    public function excluir($id) {
        $this->verificaSessao();
        if ($this->usuarios->delete($id)) {
            $mensagem = "Usuário excluído com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Usuário não foi excluído.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/usuarios');
    }

}
