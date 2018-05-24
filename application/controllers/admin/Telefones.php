<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Telefones extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // carrega a model
        $this->load->model('telefones_model', 'telefones');
    }

    public function index() {
        $this->verificaSessao();
        $busca = $this->input->post('busca');
        if (!isset($busca)) {
            $dados['telefones'] = $this->telefones->select();
        } else {
            if ($this->input->post('filtro') == '0') {
                redirect('admin/telefones');
            } else if ($this->input->post('filtro') == '1') {
                $dados['telefones'] = $this->telefones->searchId($busca);
            } else if ($this->input->post('filtro') == '1') {
                $dados['telefones'] = $this->telefones->searchDDD($busca);
            } else {
                $dados['telefones'] = $this->telefones->searchNumero($busca);
            }
        }
        $this->load->view('include/aside');
        $this->load->view('include/head');
        $this->load->view('include/header_admin');
        $this->load->view('admin/telefones/list', $dados);
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
        if ($this->telefones->delete($id)) {
            $mensagem = "Telefone excluído com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Telefone não foi excluído.";
            $tipo = 0;
        }
        // insere mensagem e tipo em dados flash
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        // redireciona para a página da lista de dados
        redirect('admin/telefones');
    }

}
