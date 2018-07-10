<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Logeventos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('logeventos_model', 'logeventos');
    }

    public function index() {
        $this->verificaSessao();
        $busca = $this->input->post('busca');
        if (!isset($busca)) {
            $dados['logeventos'] = $this->logeventos->select();
        } else {
            if ($this->input->post('filtro') == '0') {
                $mensagem = "Selecione um filtro de busca.";
                $tipo = 0;
                $this->session->set_flashdata('mensagem', $mensagem);
                $this->session->set_flashdata('tipo', $tipo);
                redirect('admin/logeventos');
            } else if ($this->input->post('filtro') == '1') {
                $dados['logeventos'] = $this->logeventos->searchId($busca);
            } else {
                $dados['logeventos'] = $this->logeventos->searchEvento($busca);
            }
        }
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/logeventos/list', $dados);
        $this->load->view('include/footer_admin');
    }

    public function verificaSessao() {
        if (!$this->session->logado_admin) {
            redirect();
        }
    }

    public function adicionar() {
        $this->verificaSessao();
        $this->load->model('eventos_model', 'eventos');
        $dados['eventos'] = $this->eventos->select();
        $this->load->model('acoeseventos_model', 'acoeseventos');
        $dados['acoes'] = $this->acoeseventos->select();
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/logeventos/create', $dados);
        $this->load->view('include/footer_admin');
    }

    public function grava_adicao() {
        $dados = $this->input->post();
        if ($this->logeventos->insert($dados)) {
            $mensagem = "Log de evento cadastrado com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Log de evento não foi cadastrado.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/logeventos');
    }

    public function atualizar($id) {
        $this->verificaSessao();
        $dados['log'] = $this->logeventos->find($id);
        $this->load->model('eventos_model', 'eventos');
        $dados['eventos'] = $this->eventos->select();
        $this->load->model('acoeseventos_model', 'acoeseventos');
        $dados['acoes'] = $this->acoeseventos->select();
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/logeventos/update', $dados);
        $this->load->view('include/footer_admin');
    }

    public function grava_atualizacao($id) {
        $dados = $this->input->post();
        if ($this->logeventos->update($dados, $id)) {
            $mensagem = "Log de evento atualizado com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Log de evento não foi atualizado.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/logeventos');
    }

    public function excluir($id) {
        $this->verificaSessao();
        if ($this->logeventos->delete($id)) {
            $mensagem = "Log de evento excluído com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Log de evento não foi excluído.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/logEventos');
    }

}
