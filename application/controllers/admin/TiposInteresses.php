<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TiposInteresses extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // carrega a model
        $this->load->model('tiposinteresses_model', 'tiposinteresses');
    }

    public function index() {
        $this->verificaSessao();
        $dados['tiposinteresses'] = $this->tiposinteresses->select();
        $this->load->view('include/aside');
        $this->load->view('include/head');
        $this->load->view('include/header_admin');
        $this->load->view('admin/tiposinteresses/list', $dados);
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
        if ($this->tiposinteresses->delete($id)) {
            $mensagem = "Tipo de interesse excluído com êxito.";
            $tipo = 1;
        } else {
            $mensagem = "Tipo de interesse não foi excluído.";
            $tipo = 0;
        }
        // insere mensagem e tipo em dados flash
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        // redireciona para a página da lista de dados
        redirect('admin/tiposinteresses');
    }

}
