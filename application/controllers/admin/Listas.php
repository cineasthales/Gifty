<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Listas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('listas_model', 'listas');
    }

    public function index() {
        $this->verificaSessao();
        $busca = $this->input->post('busca');
        if (!isset($busca)) {
            $dados['listas'] = $this->listas->select();
        } else {
            if ($this->input->post('filtro') == '0') {
                $mensagem = "Selecione um filtro de busca.";
                $tipo = 0;
                $this->session->set_flashdata('mensagem', $mensagem);
                $this->session->set_flashdata('tipo', $tipo);
                redirect('admin/listas');
            } else if ($this->input->post('filtro') == '1') {
                $dados['listas'] = $this->listas->searchEvento($busca);
            } else {
                $dados['listas'] = $this->listas->searchItem($busca);
            }
        }
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/listas/list', $dados);
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
        $this->load->model('itens_model', 'itens');
        $dados['itens'] = $this->itens->select();
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/listas/create', $dados);
        $this->load->view('include/footer_admin');
    }

    public function grava_adicao() {
        $dados = $this->input->post();
        if ($this->listas->insert($dados)) {
            $mensagem = "Adição em lista cadastrada com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Adição em lista não foi cadastrada.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/listas');
    }

    public function atualizar($idEvento, $idItem) {
        $this->verificaSessao();
        $dados['lista'] = $this->listas->find($idEvento, $idItem);
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/listas/update', $dados);
        $this->load->view('include/footer_admin');
    }

    public function grava_atualizacao($idEvento, $idItem) {
        $dados = $this->input->post();
        if ($this->listas->update($dados, $idEvento, $idItem)) {
            $mensagem = "Adição em lista atualizada com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Adição em lista não foi atualizada.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/listas');
    }

    public function excluir($idEvento, $idItem) {
        $this->verificaSessao();
        if ($this->listas->delete($idEvento, $idItem)) {
            $mensagem = "Adição em lista excluída com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Adição em lista não foi excluída.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/listas');
    }

}
