<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // carrega a model
        $this->load->model('usuarios_model', 'usuarios');
    }

    public function index() {
        $this->verificaSessao();
        $busca = trim($this->input->post('busca'));
        if (!isset($busca)) {
            $dados['usuarios'] = $this->usuarios->select();
        } else {
            if ($this->input->post('filtro') == '1') {
                $dados['usuarios'] = $this->usuarios->searchId($busca);
            } else if ($this->input->post('filtro') == '2') {
                $dados['usuarios'] = $this->usuarios->searchNome($busca);
            } else if ($this->input->post('filtro') == '3') {
                $dados['usuarios'] = $this->usuarios->searchEmail($busca);
            } else if ($this->input->post('filtro') == '4') {
                $dados['usuarios'] = $this->usuarios->searchNomeUsuario($busca);
            } else {
                $dados['usuarios'] = $this->usuarios->searchCPF($busca);
            }
        }
        $this->load->view('include/aside');
        $this->load->view('include/head');
        $this->load->view('include/header_admin');
        $this->load->view('admin/usuarios/list', $dados);
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
        if ($this->usuarios->delete($id)) {
            $mensagem = "Usuário excluído com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Usuário não foi excluído.";
            $tipo = 0;
        }
        // insere mensagem e tipo em dados flash
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        // redireciona para a página da lista de dados
        redirect('admin/usuarios');
    }

}
