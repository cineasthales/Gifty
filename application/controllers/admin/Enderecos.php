<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Enderecos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // carrega a model
        $this->load->model('enderecos_model', 'enderecos');
    }

    public function index() {
        $this->verificaSessao();
        $busca = $this->input->post('busca');
        if (!isset($busca)) {
            $dados['enderecos'] = $this->enderecos->select();
        } else {
            if ($this->input->post('filtro') == '0') {
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
        $this->load->view('include/aside');
        $this->load->view('include/head');
        $this->load->view('include/header_admin');
        $this->load->view('admin/enderecos/list', $dados);
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
        if ($this->enderecos->delete($id)) {
            $mensagem = "Endereço excluído com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Endereço não foi excluído.";
            $tipo = 0;
        }
        // insere mensagem e tipo em dados flash
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        // redireciona para a página da lista de dados
        redirect('admin/enderecos');
    }

}
