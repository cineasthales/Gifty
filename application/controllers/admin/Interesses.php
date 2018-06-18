<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Interesses extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('interesses_model', 'interesses');
    }

    public function index() {
        $this->verificaSessao();
        $busca = $this->input->post('busca');
        if (!isset($busca)) {
            $dados['interesses'] = $this->interesses->select();
        } else {
            if ($this->input->post('filtro') == '0') {
                $mensagem = "Selecione um filtro de busca.";
                $tipo = 0;
                $this->session->set_flashdata('mensagem', $mensagem);
                $this->session->set_flashdata('tipo', $tipo);
                redirect('admin/interesses');
            } else if ($this->input->post('filtro') == '1') {
                $aux = explode(" ", $busca);
                $busca = $aux[0];
                $dados['interesses'] = $this->interesses->searchUsuario($busca);
            } else {
                $dados['interesses'] = $this->interesses->searchCategoria($busca);
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

    public function adicionar() {
        $this->verificaSessao();
        $this->load->model('usuarios_model', 'usuarios');
        $dados['usuarios'] = $this->usuarios->select();
        $this->load->model('categorias_model', 'categorias');
        $dados['categorias'] = $this->categorias->select();
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/interesses/create', $dados);
        $this->load->view('include/footer_admin');
    }

    public function grava_adicao() {
        $dados = $this->input->post();
        if ($this->interesses->insert($dados)) {
            $mensagem = "Interesse cadastrado com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Interesse não foi cadastrado.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/interesses');
    }

    public function atualizar($idUsuario, $idCategoria) {
        $this->verificaSessao();
        $dados['interesse'] = $this->interesses->find($idUsuario, $idCategoria);
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/interesses/update', $dados);
        $this->load->view('include/footer_admin');
    }

    public function grava_atualizacao($idUsuario, $idCategoria) {
        $dados = $this->input->post();
        if ($this->interesses->update($dados, $idUsuario, $idCategoria)) {
            $mensagem = "Interesse atualizado com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Interesse não foi atualizado.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/interesses');
    }

    public function excluir($idUsuario, $idCategoria) {
        $this->verificaSessao();
        if ($this->interesses->delete($idUsuario, $idCategoria)) {
            $mensagem = "Interesse excluído com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Interesse não foi excluído.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/interesses');
    }

}
