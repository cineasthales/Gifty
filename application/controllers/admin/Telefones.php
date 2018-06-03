<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Telefones extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('telefones_model', 'telefones');
    }

    public function index() {
        $this->verificaSessao();
        $busca = $this->input->post('busca');
        if (!isset($busca)) {
            $dados['telefones'] = $this->telefones->select();
        } else {
            if ($this->input->post('filtro') == '0') {
                $mensagem = "Selecione um filtro de busca.";
                $tipo = 0;
                $this->session->set_flashdata('mensagem', $mensagem);
                $this->session->set_flashdata('tipo', $tipo);
                redirect('admin/telefones');
            } else if ($this->input->post('filtro') == '1') {
                $dados['telefones'] = $this->telefones->searchId($busca);
            } else if ($this->input->post('filtro') == '2') {
                $dados['telefones'] = $this->telefones->searchDDD($busca);
            } else {
                $busca = str_replace("-", "", $busca);
                $dados['telefones'] = $this->telefones->searchNumero($busca);
            }
        }
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/telefones/list', $dados);
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
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/telefones/create', $dados);
        $this->load->view('include/footer_admin');
    }

    public function grava_adicao() {
        $dados = $this->input->post();
        if ($this->telefones->insert($dados)) {
            $mensagem = "Telefone cadastrado com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Telefone não foi cadastrado.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/telefones');
    }

    public function atualizar($id) {
        $this->verificaSessao();
        $dados['telefone'] = $this->telefones->find($id);
        $this->load->model('usuarios_model', 'usuarios');
        $dados['usuarios'] = $this->usuarios->select();
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/telefones/update', $dados);
        $this->load->view('include/footer_admin');
    }

    public function grava_atualizacao($id) {
        $dados = $this->input->post();
        if ($this->telefones->update($dados, $id)) {
            $mensagem = "Telefone atualizado com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Telefone não foi atualizado.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/telefones');
    }

    public function excluir($id) {
        $this->verificaSessao();
        if ($this->telefones->delete($id)) {
            $mensagem = "Telefone excluído com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Telefone não foi excluído.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/telefones');
    }

}
