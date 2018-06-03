<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Listas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // carrega a model
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

    public function excluir($idEvento, $idItem) {
        // verifica se usuário está logado
        $this->verificaSessao();
        // retorno para usuário em relação à exclusão ou não do dado no banco
        if ($this->listas->delete($idEvento, $idItem)) {
            $mensagem = "Item excluído da lista com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Item da lista não foi excluído";
            $tipo = 0;
        }
        // insere mensagem e tipo em dados flash
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        // redireciona para a página da lista de dados
        redirect('admin/listas');
    }

}
