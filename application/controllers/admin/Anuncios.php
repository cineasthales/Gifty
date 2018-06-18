<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Anuncios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('anuncios_model', 'anuncios');
    }

    public function index() {
        $this->verificaSessao();
        $busca = $this->input->post('busca');
        if (!isset($busca)) {
            $dados['anuncios'] = $this->anuncios->select();
        } else {
            if ($this->input->post('filtro') == '0') {
                $mensagem = "Selecione um filtro de busca.";
                $tipo = 0;
                $this->session->set_flashdata('mensagem', $mensagem);
                $this->session->set_flashdata('tipo', $tipo);
                redirect('admin/anuncios');
            } else if ($this->input->post('filtro') == '1') {
                $dados['anuncios'] = $this->anuncios->searchId($busca);
            } else {
                $dados['anuncios'] = $this->anuncios->searchEmpresa($busca);
            }
        }
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/anuncios/list', $dados);
        $this->load->view('include/footer_admin');
    }

    public function verificaSessao() {
        if (!$this->session->logado_admin) {
            redirect();
        }
    }

    public function adicionar() {
        $this->verificaSessao();
        $this->load->model('empresas_model', 'empresas');
        $dados['empresas'] = $this->empresas->select();
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/anuncios/create', $dados);
        $this->load->view('include/footer_admin');
    }

    public function grava_adicao() {
        $dados = $this->input->post();
        if ($this->input->post('ativo')) {
            $dados['ativo'] = 1;
        } else {
            $dados['ativo'] = 0;
        }
        if ($this->anuncios->insert($dados)) {
            $mensagem = "Anúncio cadastrado com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Anúncio não foi cadastrado.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/anuncios');
    }

    public function atualizar($id) {
        $this->verificaSessao();
        $dados['anuncio'] = $this->anuncios->find($id);
        $this->load->model('empresas_model', 'empresas');
        $dados['empresas'] = $this->empresas->select();
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/anuncios/update', $dados);
        $this->load->view('include/footer_admin');
    }

    public function grava_atualizacao($id) {
        $dados = $this->input->post();
        if ($this->input->post('ativo')) {
            $dados['ativo'] = 1;
        } else {
            $dados['ativo'] = 0;
        }
        if ($this->anuncios->update($dados, $id)) {
            $mensagem = "Anúncio atualizado com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Anúncio não foi atualizado.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/anuncios');
    }

    public function excluir($id) {
        $this->verificaSessao();
        if ($this->anuncios->delete($id)) {
            $mensagem = "Anúncio excluído com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Anúncio não foi excluído.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/anuncios');
    }

}
