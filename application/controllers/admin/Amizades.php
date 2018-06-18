<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Amizades extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('amizades_model', 'amizades');
    }

    public function index() {
        $this->verificaSessao();
        $busca = $this->input->post('busca');
        if (!isset($busca)) {
            $dados['amizades'] = $this->amizades->select();
        } else {
            if ($this->input->post('filtro') == '0') {
                $mensagem = "Selecione um filtro de busca.";
                $tipo = 0;
                $this->session->set_flashdata('mensagem', $mensagem);
                $this->session->set_flashdata('tipo', $tipo);
                redirect('admin/amizades');
            } else if ($this->input->post('filtro') == '1') {
                $aux = explode(" ", $busca);
                $busca = $aux[0];
                $dados['amizades'] = $this->amizades->searchUsuario($busca);
            } else {
                $busca = str_replace("/", "", $busca);
                $dados['amizades'] = $this->amizades->searchData($busca);
            }
        }
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/amizades/list', $dados);
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
        $this->load->view('admin/amizades/create', $dados);
        $this->load->view('include/footer_admin');
    }

    public function grava_adicao() {
        $dados = $this->input->post();
        if ($this->input->post('ativa')) {
            $dados['ativa'] = 1;
        } else {
            $dados['ativa'] = 0;
        }
        if ($this->input->post('bloqueado1')) {
            $dados['bloqueado1'] = 1;
        } else {
            $dados['bloqueado1'] = 0;
        }
        if ($this->input->post('bloqueado2')) {
            $dados['bloqueado2'] = 1;
        } else {
            $dados['bloqueado2'] = 0;
        }
        if ($dados['idUsuario1'] != $dados['idUsuario2']) {
            $verifica = $this->amizades->find($dados['idUsuario1'], $dados['idUsuario2']);
            if (!isset($verifica)) {
                if ($this->amizades->insert($dados)) {
                    $mensagem = "Amizade cadastrada com êxito.";
                    $tipo = 1;
                } else {
                    $mensagem = "Amizade não foi cadastrada.";
                    $tipo = 0;
                }
                $this->session->set_flashdata('mensagem', $mensagem);
                $this->session->set_flashdata('tipo', $tipo);
                redirect('admin/amizades');
            } else {
                $mensagem = "Usuários já são amigos.";
                $tipo = 0;
                $this->session->set_flashdata('mensagem', $mensagem);
                $this->session->set_flashdata('tipo', $tipo);
                redirect('admin/amizades/adicionar');
            }
        } else {
            $mensagem = "Usuários devem ser diferentes.";
            $tipo = 0;
            $this->session->set_flashdata('mensagem', $mensagem);
            $this->session->set_flashdata('tipo', $tipo);
            redirect('admin/amizades/adicionar');
        }
    }

    public function atualizar($idUsuario1, $idUsuario2) {
        $this->verificaSessao();
        $dados['amizade'] = $this->amizades->find($idUsuario1, $idUsuario2);
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/amizades/update', $dados);
        $this->load->view('include/footer_admin');
    }

    public function grava_atualizacao($idUsuario1, $idUsuario2) {
        $dados = $this->input->post();
        if ($this->input->post('ativa')) {
            $dados['ativa'] = 1;
        } else {
            $dados['ativa'] = 0;
        }
        if ($this->input->post('bloqueado1')) {
            $dados['bloqueado1'] = 1;
        } else {
            $dados['bloqueado1'] = 0;
        }
        if ($this->input->post('bloqueado2')) {
            $dados['bloqueado2'] = 1;
        } else {
            $dados['bloqueado2'] = 0;
        }
        if ($this->amizades->update($dados, $idUsuario1, $idUsuario2)) {
            $mensagem = "Amizade atualizada com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Amizade não foi atualizada.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/amizades');
    }

    public function excluir($idUsuario1, $idUsuario2) {
        $this->verificaSessao();
        if ($this->amizades->delete($idUsuario1, $idUsuario2)) {
            $mensagem = "Amizade excluída com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Amizade não foi excluída.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('admin/amizades');
    }

}
