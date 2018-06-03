<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AcoesEventos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // carrega a model
        $this->load->model('acoeseventos_model', 'acoeseventos');
    }

    public function index() {
        $this->verificaSessao();
        $busca = $this->input->post('busca');
        if (!isset($busca)) {
            $dados['acoeseventos'] = $this->acoeseventos->select();
        } else {
            if ($this->input->post('filtro') == '0') {
                $mensagem = "Selecione um filtro de busca.";
                $tipo = 0;
                $this->session->set_flashdata('mensagem', $mensagem);
                $this->session->set_flashdata('tipo', $tipo);
                redirect('admin/acoeseventos');
            } else if ($this->input->post('filtro') == '1') {
                $dados['acoeseventos'] = $this->acoeseventos->searchId($busca);
            } else {
                $dados['acoeseventos'] = $this->acoeseventos->searchDescricao($busca);
            }
        }
        $this->load->view('include/head');
        $this->load->view('include/aside');     
        $this->load->view('include/header_admin');
        $this->load->view('admin/acoeseventos/list', $dados);
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
        if ($this->acoeseventos->delete($id)) {
            $mensagem = "Ação de evento excluída com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Ação de evento não foi excluída.";
            $tipo = 0;
        }
        // insere mensagem e tipo em dados flash
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        // redireciona para a página da lista de dados
        redirect('admin/acoesEventos');
    }

}
