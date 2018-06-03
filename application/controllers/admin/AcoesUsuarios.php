<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AcoesUsuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // carrega a model
        $this->load->model('acoesusuarios_model', 'acoesusuarios');
    }

    public function index() {
        $this->verificaSessao();
        $busca = $this->input->post('busca');
        if (!isset($busca)) {
            $dados['acoesusuarios'] = $this->acoesusuarios->select();
        } else {
            if ($this->input->post('filtro') == '0') {
                $mensagem = "Selecione um filtro de busca.";
                $tipo = 0;
                $this->session->set_flashdata('mensagem', $mensagem);
                $this->session->set_flashdata('tipo', $tipo);
                redirect('admin/acoesusuarios');
            } else if ($this->input->post('filtro') == '1') {
                $dados['acoesusuarios'] = $this->acoesusuarios->searchId($busca);
            } else {
                $dados['acoesusuarios'] = $this->acoesusuarios->searchDescricao($busca);
            }
        }
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/acoesusuarios/list', $dados);
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
        if ($this->acoesusuarios->delete($id)) {
            $mensagem = "Ação de usuário excluída com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Ação de usuário não foi excluída.";
            $tipo = 0;
        }
        // insere mensagem e tipo em dados flash
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        // redireciona para a página da lista de dados
        redirect('admin/acoesUsuarios');
    }

}
