<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Empresas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('empresas_model', 'empresas');
    }

    public function index() {
        $this->verificaSessao();
        $busca = $this->input->post('busca');
        if (!isset($busca)) {
            $dados['empresas'] = $this->empresas->select();
        } else {
            if ($this->input->post('filtro') == '0') {
                $mensagem = "Selecione um filtro de busca.";
                $tipo = 0;
                $this->session->set_flashdata('mensagem', $mensagem);
                $this->session->set_flashdata('tipo', $tipo);
                redirect('admin/empresas');
            } else if ($this->input->post('filtro') == '1') {
                $dados['empresas'] = $this->empresas->searchId($busca);
            } else if ($this->input->post('filtro') == '2') {
                $dados['empresas'] = $this->empresas->searchNomeFantasia($busca);
            } else if ($this->input->post('filtro') == '3') {
                $dados['empresas'] = $this->empresas->searchRazaoSocial($busca);
            } else {
                $busca = str_replace(".", "", $busca);
                $busca = str_replace("/", "", $busca);
                $busca = str_replace("-", "", $busca);
                $dados['empresas'] = $this->empresas->searchCNPJ($busca);
            }
        }
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/empresas/list', $dados);
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
        $this->load->view('admin/empresas/create');
        $this->load->view('include/footer_admin');
    }

    public function grava_adicao() {
        $dados = $this->input->post();
        if ($this->input->post('ativa')) {
            $dados['ativa'] = 1;
        } else {
            $dados['ativa'] = 0;
        }
        if ($this->empresas->insert($dados)) {
            $mensagem = "Empresa cadastrada com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Empresa não foi cadastrada.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/empresas');
    }

    public function atualizar($id) {
        $this->verificaSessao();
        $dados['empresa'] = $this->empresas->find($id);
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/empresas/update', $dados);
        $this->load->view('include/footer_admin');
    }

    public function grava_atualizacao($id) {
        $dados = $this->input->post();
        if ($this->input->post('ativa')) {
            $dados['ativa'] = 1;
        } else {
            $dados['ativa'] = 0;
        }
        if ($this->empresas->update($dados, $id)) {
            $mensagem = "Empresa atualizada com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Empresa não foi atualizada.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/empresas');
    }

    public function excluir($id) {
        $this->verificaSessao();
        if ($this->empresas->delete($id)) {
            $mensagem = "Empresa excluída com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Empresa não foi excluída.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/empresas');
    }

}
