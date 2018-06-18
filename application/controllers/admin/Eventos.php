<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Eventos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('eventos_model', 'eventos');
    }

    public function index() {
        $this->verificaSessao();
        $busca = $this->input->post('busca');
        if (!isset($busca)) {
            $dados['eventos'] = $this->eventos->select();
        } else {
            if ($this->input->post('filtro') == '0') {
                $mensagem = "Selecione um filtro de busca.";
                $tipo = 0;
                $this->session->set_flashdata('mensagem', $mensagem);
                $this->session->set_flashdata('tipo', $tipo);
                redirect('admin/eventos');
            } else if ($this->input->post('filtro') == '1') {
                $dados['eventos'] = $this->eventos->searchId($busca);
            } else if ($this->input->post('filtro') == '2') {
                $dados['eventos'] = $this->eventos->searchTitulo($busca);
            } else if ($this->input->post('filtro') == '3') {
                $busca = str_replace("/", "", $busca);
                $dados['eventos'] = $this->eventos->searchData($busca);
            } else if ($this->input->post('filtro') == '4') {
                $dados['eventos'] = $this->eventos->searchLocal($busca);
            } else if ($this->input->post('filtro') == '5') {
                $aux = explode(" ", $busca);
                $busca = $aux[0];
                $dados['eventos'] = $this->eventos->searchUsuario($busca);
            } else {
                $dados['eventos'] = $this->eventos->searchTipoEvento($busca);
            }
        }
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/eventos/list', $dados);
        $this->load->view('include/footer_admin');
    }

    public function verificaSessao() {
        if (!$this->session->logado_admin) {
            redirect();
        }
    }

    public function adicionar() {
        $this->verificaSessao();
        $this->load->model('usuarios_model', 'usuarios');
        $this->load->model('tiposeventos_model', 'tiposeventos');
        $this->load->model('enderecos_model', 'enderecos');
        $dados['usuarios'] = $this->usuarios->select();
        $dados['tiposeventos'] = $this->tiposeventos->select();
        $dados['enderecos'] = $this->enderecos->select();
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/eventos/create', $dados);
        $this->load->view('include/footer_admin');
    }

    public function grava_adicao() {
        $dados = $this->input->post();
        if ($this->input->post('ativo')) {
            $dados['ativo'] = 1;
        } else {
            $dados['ativo'] = 0;
        }
        if ($this->eventos->insert($dados)) {
            $mensagem = "Evento cadastrado com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Evento não foi cadastrado.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/eventos');
    }

    public function atualizar($id) {
        $this->verificaSessao();
        $dados['evento'] = $this->eventos->find($id);
        $this->load->model('usuarios_model', 'usuarios');
        $this->load->model('tiposeventos_model', 'tiposeventos');
        $this->load->model('enderecos_model', 'enderecos');
        $dados['usuarios'] = $this->usuarios->select();
        $dados['tiposeventos'] = $this->tiposeventos->select();
        $dados['enderecos'] = $this->enderecos->select();
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/eventos/update', $dados);
        $this->load->view('include/footer_admin');
    }

    public function grava_atualizacao($id) {
        $dados = $this->input->post();
        if ($this->input->post('ativo')) {
            $dados['ativo'] = 1;
        } else {
            $dados['ativo'] = 0;
        }
        if ($this->eventos->update($dados, $id)) {
            $mensagem = "Evento atualizado com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Evento não foi atualizado.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/eventos');
    }

    public function excluir($id) {
        $this->verificaSessao();
        if ($this->eventos->delete($id)) {
            $mensagem = "Evento excluído com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Evento não foi excluído.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/eventos');
    }

}
