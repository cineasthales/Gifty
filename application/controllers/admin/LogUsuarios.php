<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LogUsuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('logusuarios_model', 'logusuarios');
    }

    public function index() {
        $this->verificaSessao();
        $busca = $this->input->post('busca');
        if (!isset($busca)) {
            $dados['logusuarios'] = $this->logusuarios->select();
        } else {
            if ($this->input->post('filtro') == '0') {
                $mensagem = "Selecione um filtro de busca.";
                $tipo = 0;
                $this->session->set_flashdata('mensagem', $mensagem);
                $this->session->set_flashdata('tipo', $tipo);
                redirect('admin/logusuarios');
            } else if ($this->input->post('filtro') == '1') {
                $dados['logusuarios'] = $this->logusuarios->searchId($busca);
            } else {
                $aux = explode(" ", $busca);
                $busca = $aux[0];
                $dados['logusuarios'] = $this->logusuarios->searchUsuario($busca);
            }
        }
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/logusuarios/list', $dados);
        $this->load->view('include/footer_admin');
    }
    
    public function adicionar() {
        $this->verificaSessao();
        $this->load->model('usuarios_model', 'usuarios');
        $dados['usuarios'] = $this->usuarios->select();
        $this->load->model('acoesusuarios_model', 'acoesusuarios');
        $dados['acoes'] = $this->acoesusuarios->select();
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/logusuarios/create', $dados);
        $this->load->view('include/footer_admin');
    }

    public function grava_adicao() {
        $dados = $this->input->post();
        if ($this->logusuarios->insert($dados)) {
            $mensagem = "Log de usuário cadastrado com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Log de usuário não foi cadastrado.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/logusuarios');
    }

    public function atualizar($id) {
        $this->verificaSessao();
        $dados['log'] = $this->logusuarios->find($id);
        $this->load->model('usuarios_model', 'usuarios');
        $dados['usuarios'] = $this->usuarios->select();
        $this->load->model('acoesusuarios_model', 'acoesusuarios');
        $dados['acoes'] = $this->acoesusuarios->select();
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/logusuarios/update', $dados);
        $this->load->view('include/footer_admin');
    }

    public function grava_atualizacao($id) {
        $dados = $this->input->post();
        if ($this->logusuarios->update($dados, $id)) {
            $mensagem = "Log de usuário atualizado com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Log de usuário não foi atualizado.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/logusuarios');
    }

    public function verificaSessao() {
        if (!$this->session->logado_admin) {
            redirect();
        }
    }

    public function excluir($id) {
        $this->verificaSessao();
        if ($this->logusuarios->delete($id)) {
            $mensagem = "Log de usuário excluído com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Log de usuário não foi excluído.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/logusuarios');
    }

}
