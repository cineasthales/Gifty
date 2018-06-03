<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TiposInteresses extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('tiposinteresses_model', 'tiposinteresses');
    }

    public function index() {
        $this->verificaSessao();
        $busca = $this->input->post('busca');
        if (!isset($busca)) {
            $dados['tiposinteresses'] = $this->tiposinteresses->select();
        } else {
            if ($this->input->post('filtro') == '0') {
                $mensagem = "Selecione um filtro de busca.";
                $tipo = 0;
                $this->session->set_flashdata('mensagem', $mensagem);
                $this->session->set_flashdata('tipo', $tipo);
                redirect('admin/tiposinteresses');
            } else if ($this->input->post('filtro') == '1') {
                $dados['tiposinteresses'] = $this->tiposinteresses->searchId($busca);
            } else {
                $dados['tiposinteresses'] = $this->tiposinteresses->searchDescricao($busca);
            }
        }
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/tiposinteresses/list', $dados);
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
        $this->load->view('admin/tiposinteresses/create');
        $this->load->view('include/footer_admin');
    }

    public function grava_adicao() {
        $dados = $this->input->post();
        if ($this->tiposinteresses->insert($dados)) {
            $mensagem = "Tipo de interesse cadastrado com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Tipo de interesse não foi cadastrado.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/tiposinteresses');
    }

    public function atualizar($id) {
        $this->verificaSessao();
        $dados['tipo'] = $this->tiposinteresses->find($id);
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/tiposinteresses/update', $dados);
        $this->load->view('include/footer_admin');
    }

    public function grava_atualizacao($id) {
        $dados = $this->input->post();
        if ($this->tiposinteresses->update($dados, $id)) {
            $mensagem = "Tipo de interesse atualizado com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Tipo de interesse não foi atualizado.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/tiposinteresses');
    }

    public function excluir($id) {
        $this->verificaSessao();
        if ($this->tiposinteresses->delete($id)) {
            $mensagem = "Tipo de interesse excluído com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Tipo de interesse não foi excluído.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/tiposinteresses');
    }

}
