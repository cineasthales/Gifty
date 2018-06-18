<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AcoesEventos extends CI_Controller {

    public function __construct() {
        parent::__construct();
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

    public function adicionar() {
        $this->verificaSessao();
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/acoeseventos/create');
        $this->load->view('include/footer_admin');
    }

    public function grava_adicao() {
        $dados = $this->input->post();
        if ($this->acoeseventos->insert($dados)) {
            $mensagem = "Ação de evento cadastrada com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Ação de evento não foi cadastrada.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/acoeseventos');
    }

    public function atualizar($id) {
        $this->verificaSessao();
        $dados['acao'] = $this->acoeseventos->find($id);
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/acoeseventos/update', $dados);
        $this->load->view('include/footer_admin');
    }

    public function grava_atualizacao($id) {
        $dados = $this->input->post();
        if ($this->acoeseventos->update($dados, $id)) {
            $mensagem = "Ação de evento atualizada com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Ação de evento não foi atualizada.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/acoeseventos');
    }

    public function excluir($id) {
        $this->verificaSessao();
        if ($this->acoeseventos->delete($id)) {
            $mensagem = "Ação de evento excluída com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Ação de evento não foi excluída.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/acoesEventos');
    }

}
