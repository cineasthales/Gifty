<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Empresas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // carrega a model
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

    public function excluir($id) {
        // verifica se usuário está logado
        $this->verificaSessao();
        // retorno para usuário em relação à exclusão ou não do dado no banco
        if ($this->empresas->delete($id)) {
            $mensagem = "Empresa excluída com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Empresa não foi excluída.";
            $tipo = 0;
        }
        // insere mensagem e tipo em dados flash
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        // redireciona para a página da lista de dados
        redirect('admin/empresas');
    }

}
