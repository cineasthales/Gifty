<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Convidados extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('convidados_model', 'convidados');
    }

    public function index() {
        $this->verificaSessao();
        $busca = $this->input->post('busca');
        if (!isset($busca)) {
            $dados['convidados'] = $this->convidados->select();
        } else {
            if ($this->input->post('filtro') == '0') {
                $mensagem = "Selecione um filtro de busca.";
                $tipo = 0;
                $this->session->set_flashdata('mensagem', $mensagem);
                $this->session->set_flashdata('tipo', $tipo);
                redirect('admin/convidados');
            } else if ($this->input->post('filtro') == '1') {
                $dados['convidados'] = $this->convidados->searchEvento($busca);
            } else {
                $aux = explode(" ", $busca);
                $busca = $aux[0];
                $dados['convidados'] = $this->convidados->searchUsuario($busca);
            }
        }
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/convidados/list', $dados);
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
        $this->load->model('eventos_model', 'eventos');
        $dados['eventos'] = $this->eventos->select();
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/convidados/create', $dados);
        $this->load->view('include/footer_admin');
    }

    public function grava_adicao() {
        $dados = $this->input->post();
        if ($this->input->post('comparecera')) {
            $dados['comparecera'] = 1;
        } else {
            $dados['comparecera'] = 0;
        }
        if ($this->input->post('compareceu')) {
            $dados['compareceu'] = 1;
        } else {
            $dados['compareceu'] = 0;
        }
        if ($this->input->post('bloqueado')) {
            $dados['bloqueado'] = 1;
        } else {
            $dados['bloqueado'] = 0;
        }
        if ($this->convidados->insert($dados)) {
            $mensagem = "Convidado cadastrado com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Convidado não foi cadastrado.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/convidados');
    }

    public function atualizar($idUsuario, $idEvento) {
        $this->verificaSessao();
        $dados['convidado'] = $this->convidados->find($idUsuario, $idEvento);
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/convidados/update', $dados);
        $this->load->view('include/footer_admin');
    }

    public function grava_atualizacao($idUsuario, $idEvento) {
        $dados = $this->input->post();
        if ($this->input->post('comparecera')) {
            $dados['comparecera'] = 1;
        } else {
            $dados['comparecera'] = 0;
        }
        if ($this->input->post('compareceu')) {
            $dados['compareceu'] = 1;
        } else {
            $dados['compareceu'] = 0;
        }
        if ($this->input->post('bloqueado')) {
            $dados['bloqueado'] = 1;
        } else {
            $dados['bloqueado'] = 0;
        }
        if ($this->convidados->update($dados, $idUsuario, $idEvento)) {
            $mensagem = "Convidado atualizado com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Convidado não foi atualizado.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/convidados');
    }

    public function excluir($idUsuario, $idEvento) {
        $this->verificaSessao();
        if ($this->convidados->delete($idUsuario, $idEvento)) {
            $mensagem = "Convidado excluído com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Convidado não foi excluído.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/convidados');
    }

}
