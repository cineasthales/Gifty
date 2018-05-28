<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CliquesAnuncios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // carrega a model
        $this->load->model('cliquesanuncios_model', 'cliquesanuncios');
    }

    public function index() {
        $this->verificaSessao();
        $busca = $this->input->post('busca');
        if (!isset($busca)) {
            $dados['cliques'] = $this->cliquesanuncios->select();
        } else {
            if ($this->input->post('filtro') == '0') {
                redirect('admin/cliquesanuncios');
            } else if ($this->input->post('filtro') == '1') {
                $dados['cliques'] = $this->cliquesanuncios->searchId($busca);
            } else {
                $aux = explode(" ", $busca);
                $busca = $aux[0];
                $dados['cliques'] = $this->cliquesanuncios->searchUsuario($busca);
            }
        }
        $this->load->view('include/aside');
        $this->load->view('include/head');
        $this->load->view('include/header_admin');
        $this->load->view('admin/cliquesanuncios/list', $dados);
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
        if ($this->cliquesanuncios->delete($id)) {
            $mensagem = "Clique em anúncio excluído com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Clique em anúncio não foi excluído.";
            $tipo = 0;
        }
        // insere mensagem e tipo em dados flash
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        // redireciona para a página da lista de dados
        redirect('admin/cliquesanuncios');
    }

}
