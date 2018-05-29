<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Interesses extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // carrega a model
        $this->load->model('interesses_model', 'interesses');
    }

    public function index() {
        $this->verificaSessao();
        $busca = $this->input->post('busca');
        if (!isset($busca)) {
            $dados['interesses'] = $this->interesses->select();
        } else {
            if ($this->input->post('filtro') == '0') {
                redirect('admin/interesses');
            } else if ($this->input->post('filtro') == '1') {
                $aux = explode(" ", $busca);
                $busca = $aux[0];
                $dados['interesses'] = $this->interesses->searchUsuario($busca);
            } else {
                $dados['interesses'] = $this->interesses->searchTipoInteresse($busca);
            }
        }
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/interesses/list', $dados);
        $this->load->view('include/footer_admin');
    }

    public function verificaSessao() {
        if (!$this->session->logado_admin) {
            redirect();
        }
    }

    public function excluir($idUsuario, $idTipoInteresse) {
        // verifica se usuário está logado
        $this->verificaSessao();
        // retorno para usuário em relação à exclusão ou não do dado no banco
        if ($this->interesses->delete($idUsuario, $idTipoInteresse)) {
            $mensagem = "Interesse excluído com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Interesse não foi excluído.";
            $tipo = 0;
        }
        // insere mensagem e tipo em dados flash
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        // redireciona para a página da lista de dados
        redirect('admin/interesses');
    }

}
