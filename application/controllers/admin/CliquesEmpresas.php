<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CliquesEmpresas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // carrega a model
        $this->load->model('cliquesempresas_model', 'cliquesempresas');
    }

    public function index() {
        $this->verificaSessao();
        $busca = $this->input->post('busca');
        if (!isset($busca)) {
            $dados['cliques'] = $this->cliquesempresas->select();
        } else {
            if ($this->input->post('filtro') == '0') {
                $mensagem = "Selecione um filtro de busca.";
                $tipo = 0;
                $this->session->set_flashdata('mensagem', $mensagem);
                $this->session->set_flashdata('tipo', $tipo);
                redirect('admin/cliquesempresas');
            } else if ($this->input->post('filtro') == '1') {
                $dados['cliques'] = $this->cliquesempresas->searchId($busca);
            } else if ($this->input->post('filtro') == '2') {
                $dados['cliques'] = $this->cliquesempresas->searchEmpresa($busca);
            } else {
                $aux = explode(" ", $busca);
                $busca = $aux[0];
                $dados['cliques'] = $this->cliquesempresas->searchUsuario($busca);
            }
        }
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/cliquesempresas/list', $dados);
        $this->load->view('include/footer_admin');
    }

    public function verificaSessao() {
        if (!$this->session->logado_admin) {
            redirect();
        }
    }

    public function adicionar() {
        $this->verificaSessao();
        $this->load->model('usuarios_model', 'usuarios');
        $dados['usuarios'] = $this->usuarios->select();
        $this->load->model('empresas_model', 'empresas');
        $dados['empresas'] = $this->empresas->select();
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/cliquesempresas/create', $dados);
        $this->load->view('include/footer_admin');
    }

    public function grava_adicao() {
        $dados = $this->input->post();
        if ($this->cliquesempresas->insert($dados)) {
            $mensagem = "Clique em empresa cadastrado com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Clique em empresa não foi cadastrado.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/cliquesempresas');
    }

    public function atualizar($id) {
        $this->verificaSessao();
        $dados['clique'] = $this->cliquesempresas->find($id);
        $this->load->model('usuarios_model', 'usuarios');
        $dados['usuarios'] = $this->usuarios->select();
        $this->load->model('empresas_model', 'empresas');
        $dados['empresas'] = $this->empresas->select();
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/cliquesempresas/update', $dados);
        $this->load->view('include/footer_admin');
    }

    public function grava_atualizacao($id) {
        $dados = $this->input->post();
        if ($this->cliquesempresas->update($dados, $id)) {
            $mensagem = "Clique em empresa atualizado com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Clique em empresa não foi atualizado.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/cliquesempresas');
    }

    public function excluir($id) {
        // verifica se usuário está logado
        $this->verificaSessao();
        // retorno para usuário em relação à exclusão ou não do dado no banco
        if ($this->cliquesempresas->delete($id)) {
            $mensagem = "Clique em empresa excluído com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Clique em empresa não foi excluído.";
            $tipo = 0;
        }
        // insere mensagem e tipo em dados flash
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        // redireciona para a página da lista de dados
        redirect('admin/cliquesempresas');
    }

}
