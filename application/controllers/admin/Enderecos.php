<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Enderecos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('enderecos_model', 'enderecos');
    }

    public function index() {
        $this->verificaSessao();
        $busca = $this->input->post('busca');
        if (!isset($busca)) {
            $dados['enderecos'] = $this->enderecos->select();
        } else {
            if ($this->input->post('filtro') == '0') {
                $mensagem = "Selecione um filtro de busca.";
                $tipo = 0;
                $this->session->set_flashdata('mensagem', $mensagem);
                $this->session->set_flashdata('tipo', $tipo);
                redirect('admin/enderecos');
            } else if ($this->input->post('filtro') == '1') {
                $dados['enderecos'] = $this->enderecos->searchId($busca);
            } else if ($this->input->post('filtro') == '2') {
                $dados['enderecos'] = $this->enderecos->searchLogradouro($busca);
            } else if ($this->input->post('filtro') == '3') {
                $dados['enderecos'] = $this->enderecos->searchBairro($busca);
            } else if ($this->input->post('filtro') == '4') {
                $dados['enderecos'] = $this->enderecos->searchCidade($busca);
            } else {
                $dados['enderecos'] = $this->enderecos->searchEstado($busca);
            }
        }
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/enderecos/list', $dados);
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
        $this->load->view('admin/enderecos/create');
        $this->load->view('include/footer_admin');
    }

    public function grava_adicao() {
        $dados = $this->input->post();
        if ($this->enderecos->insert($dados)) {
            $mensagem = "Endereço cadastrado com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Endereço não foi cadastrado.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/enderecos');
    }

    public function atualizar($id) {
        $this->verificaSessao();
        $dados['endereco'] = $this->enderecos->find($id);
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/enderecos/update', $dados);
        $this->load->view('include/footer_admin');
    }

    public function grava_atualizacao($id) {
        $dados = $this->input->post();
        if ($this->enderecos->update($dados, $id)) {
            $mensagem = "Endereço atualizado com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Endereço não foi atualizado.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/enderecos');
    }

    public function excluir($id) {
        $this->verificaSessao();
        if ($this->enderecos->delete($id)) {
            $mensagem = "Endereço excluído com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Endereço não foi excluído.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/enderecos');
    }

}
