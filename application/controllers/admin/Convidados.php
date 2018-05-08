<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Convidados extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // carrega a model
        $this->load->model('convidados_model', 'convidados');
    }

    public function index() {
        $this->verificaSessao();
        $dados['convidados'] = $this->convidados->select();
        $this->load->view('include/aside');
        $this->load->view('include/head');
        $this->load->view('include/header_admin');
        $this->load->view('admin/convidados/list', $dados);
        $this->load->view('include/footer_admin');
    }

    public function verificaSessao() {
        if (!$this->session->logado_admin) {
            redirect();
        }
    }

    public function excluir($idUsuario, $idEvento) {
        // verifica se usuário está logado
        $this->verificaSessao();
        // retorno para usuário em relação à exclusão ou não do dado no banco
        if ($this->convidados->delete($idUsuario, $idEvento)) {
            $mensagem = "Convidado excluído com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Convidado não foi excluído.";
            $tipo = 0;
        }
        // insere mensagem e tipo em dados flash
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        // redireciona para a página da lista de dados
        redirect('admin/convidados');
    }

}
