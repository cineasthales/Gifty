<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AcoesUsuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
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
    
    public function adicionar() {
        $this->verificaSessao();
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/acoesusuarios/create');
        $this->load->view('include/footer_admin');
    }

    public function grava_adicao() {
        $dados = $this->input->post();
        if ($this->acoesusuarios->insert($dados)) {
            $mensagem = "Ação de usuário cadastrada com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Ação de usuário não foi cadastrada.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/acoesusuarios');
    }

    public function atualizar($id) {
        $this->verificaSessao();
        $dados['acao'] = $this->acoesusuarios->find($id);
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/acoesusuarios/update', $dados);
        $this->load->view('include/footer_admin');
    }

    public function grava_atualizacao($id) {
        $dados = $this->input->post();
        if ($this->acoesusuarios->update($dados, $id)) {
            $mensagem = "Ação de usuário atualizada com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Ação de usuário não foi atualizada.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/acoesusuarios');
    }

    public function excluir($id) {
        $this->verificaSessao();
        if ($this->acoesusuarios->delete($id)) {
            $mensagem = "Ação de usuário excluída com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Ação de usuário não foi excluída.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/acoesUsuarios');
    }

}
