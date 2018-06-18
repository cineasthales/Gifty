<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('categorias_model', 'categorias');
    }

    public function index() {
        $this->verificaSessao();
        $busca = $this->input->post('busca');
        if (!isset($busca)) {
            $dados['categorias'] = $this->categorias->select();
        } else {
            if ($this->input->post('filtro') == '0') {
                $mensagem = "Selecione um filtro de busca.";
                $tipo = 0;
                $this->session->set_flashdata('mensagem', $mensagem);
                $this->session->set_flashdata('tipo', $tipo);
                redirect('admin/categorias');
            } else if ($this->input->post('filtro') == '1') {
                $dados['categorias'] = $this->categorias->searchId($busca);
            } else {
                $dados['categorias'] = $this->categorias->searchDescricao($busca);
            }
        }
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/categorias/list', $dados);
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
        $this->load->view('admin/categorias/create');
        $this->load->view('include/footer_admin');
    }

    public function grava_adicao() {
        $dados = $this->input->post();
        if ($this->categorias->insert($dados)) {
            $mensagem = "Categoria cadastrada com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Categoria não foi cadastrada.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/categorias');
    }

    public function atualizar($id) {
        $this->verificaSessao();
        $dados['categoria'] = $this->categorias->find($id);
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/categorias/update', $dados);
        $this->load->view('include/footer_admin');
    }

    public function grava_atualizacao($id) {
        $dados = $this->input->post();
        if ($this->categorias->update($dados, $id)) {
            $mensagem = "Categoria atualizada com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Categoria não foi atualizada.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/categorias');
    }

    public function excluir($id) {
        $this->verificaSessao();
        if ($this->categorias->delete($id)) {
            $mensagem = "Categoria excluída com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Categoria não foi excluída.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/categorias');
    }

}
