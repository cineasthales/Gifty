<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Eventos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // carrega a model
        $this->load->model('eventos_model', 'eventos');
    }

    public function index() {
        $this->verificaSessao();
        $busca = $this->input->post('busca');
        if (!isset($busca)) {
            $dados['eventos'] = $this->eventos->select();
        } else {
            if ($this->input->post('filtro') == '0') {
                redirect('admin/eventos');
            } else if ($this->input->post('filtro') == '1') {
                $dados['eventos'] = $this->eventos->searchId($busca);
            } else if ($this->input->post('filtro') == '2') {
                $dados['eventos'] = $this->eventos->searchTitulo($busca);
            } else if ($this->input->post('filtro') == '3') {
                $busca = str_replace("/", "", $busca);
                $dados['eventos'] = $this->eventos->searchData($busca);
            } else if ($this->input->post('filtro') == '4') {
                $dados['eventos'] = $this->eventos->searchLocal($busca);
            } else if ($this->input->post('filtro') == '5') {
                $aux = explode(" ", $busca);
                $busca = $aux[0];
                $dados['eventos'] = $this->eventos->searchUsuario($busca);
            } else {
                $dados['eventos'] = $this->eventos->searchTipoEvento($busca);
            }
        }
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/eventos/list', $dados);
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
        if ($this->eventos->delete($id)) {
            $mensagem = "Evento excluído com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Evento não foi excluído.";
            $tipo = 0;
        }
        // insere mensagem e tipo em dados flash
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        // redireciona para a página da lista de dados
        redirect('admin/eventos');
    }

}
