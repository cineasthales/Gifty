<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Itens extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // carrega a model
        $this->load->model('itens_model', 'itens');
    }

    public function index() {
        $this->verificaSessao();
        $busca = $this->input->post('busca');
        if (!isset($busca)) {
            $dados['itens'] = $this->itens->select();
        } else {
            if ($this->input->post('filtro') == '0') {
                $mensagem = "Selecione um filtro de busca.";
                $tipo = 0;
                $this->session->set_flashdata('mensagem', $mensagem);
                $this->session->set_flashdata('tipo', $tipo);
                redirect('admin/itens');
            } else if ($this->input->post('filtro') == '1') {
                $dados['itens'] = $this->itens->searchId($busca);
            } else if ($this->input->post('filtro') == '2') {
                $dados['itens'] = $this->itens->searchNome($busca);
            } else {
                $dados['itens'] = $this->itens->searchCategoria($busca);
            }
        }
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/itens/list', $dados);
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
        $this->load->view('admin/itens/create');
        $this->load->view('include/footer_admin');
    }

    public function grava_adicao() {
        $dados = $this->input->post();
        if ($this->itens->insert($dados)) {
            $mensagem = "Item cadastrado com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Item não foi cadastrado.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/itens');
    }

    public function atualizar($id) {
        $this->verificaSessao();
        $dados['item'] = $this->itens->find($id);
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/itens/update', $dados);
        $this->load->view('include/footer_admin');
    }

    public function grava_atualizacao($id) {
        $dados = $this->input->post();
        if ($this->itens->update($dados, $id)) {
            $mensagem = "Item atualizado com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Item não foi atualizado.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/itens');
    }

    public function excluir($id) {
        // verifica se usuário está logado
        $this->verificaSessao();
        // retorno para usuário em relação à exclusão ou não do dado no banco
        if ($this->itens->delete($id)) {
            $mensagem = "Item excluído com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Item não foi excluído.";
            $tipo = 0;
        }
        // insere mensagem e tipo em dados flash
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        // redireciona para a página da lista de dados
        redirect('admin/itens');
    }

}
