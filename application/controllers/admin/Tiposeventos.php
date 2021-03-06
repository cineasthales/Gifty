<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tiposeventos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('tiposeventos_model', 'tiposeventos');
    }

    public function index() {
        $this->verificaSessao();
        $busca = $this->input->post('busca');
        if (!isset($busca)) {
            $dados['tiposeventos'] = $this->tiposeventos->select();
        } else {
            if ($this->input->post('filtro') == '0') {
                $mensagem = "Selecione um filtro de busca.";
                $tipo = 0;
                $this->session->set_flashdata('mensagem', $mensagem);
                $this->session->set_flashdata('tipo', $tipo);
                redirect('admin/tiposeventos');
            } else if ($this->input->post('filtro') == '1') {
                $dados['tiposeventos'] = $this->tiposeventos->searchId($busca);
            } else {
                $dados['tiposeventos'] = $this->tiposeventos->searchDescricao($busca);
            }
        }
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/tiposeventos/list', $dados);
        $this->load->view('include/footer_admin');
    }

    public function verificaSessao() {
        if (!$this->session->logado_admin) {
            redirect();
        }
    }

    public function adicionar() {
        $this->verificaSessao();
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/tiposeventos/create');
        $this->load->view('include/footer_admin');
    }

    public function grava_adicao() {
        $dados = $this->input->post();
        if ($this->tiposeventos->insert($dados)) {
            $mensagem = "Tipo de evento cadastrado com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Tipo de evento não foi cadastrado.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/tiposeventos');
    }

    public function atualizar($id) {
        $this->verificaSessao();
        $dados['tipo'] = $this->tiposeventos->find($id);
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/tiposeventos/update', $dados);
        $this->load->view('include/footer_admin');
    }

    public function grava_atualizacao($id) {
        $dados = $this->input->post();
        if ($this->tiposeventos->update($dados, $id)) {
            $mensagem = "Tipo de evento atualizado com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Tipo de evento não foi atualizado.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/tiposeventos');
    }

    public function excluir($id) {
        $this->verificaSessao();
        if ($this->tiposeventos->delete($id)) {
            $mensagem = "Tipo de evento excluído com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Tipo de evento não foi excluído.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/tiposeventos');
    }

}
