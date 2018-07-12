<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Criar extends CI_Controller {

    public function index() {
        if ($this->session->logado == true) {
            redirect(base_url('usuario/criar/evento'));
        } else {
            redirect();
        }
    }

    public function evento() {
        if ($this->session->logado == true) {
            $this->load->model('tiposeventos_model', 'tiposeventos');
            $dados['tiposeventos'] = $this->tiposeventos->select();
            $this->load->view('include/head');
            $this->load->view('include/header_user');
            $this->load->view('user/criar/evento', $dados);
            $this->load->view('include/footer_user');
        } else {
            redirect();
        }
    }

    public function convidados() {
        if ($this->session->logado == true) {
            if ($this->input->post('cep') != NULL) {
                $this->load->model('enderecos_model', 'enderecos');
                $dadosEndereco['cep'] = $this->input->post('cep');
                $dadosEndereco['logradouro'] = $this->input->post('logradouro');
                $dadosEndereco['numero'] = $this->input->post('numero');
                $dadosEndereco['complemento'] = $this->input->post('complemento');
                $dadosEndereco['bairro'] = $this->input->post('bairro');
                $dadosEndereco['cidade'] = $this->input->post('cidade');
                $dadosEndereco['estado'] = $this->input->post('estado');
                if ($this->enderecos->insert($dadosEndereco)) {
                    $this->load->model('eventos_model', 'eventos');
                    $dadosEvento['idEndereco'] = $this->enderecos->last()->id;
                    $dadosEvento['titulo'] = $this->input->post('titulo');
                    $dadosEvento['data'] = $this->input->post('data');
                    $dadosEvento['hora'] = $this->input->post('hora');
                    $dadosEvento['idTipoEvento'] = $this->input->post('idTipoEvento');
                    $dadosEvento['maxItens'] = $this->input->post('maxItens');
                    $dadosEvento['dataLimite'] = $this->input->post('dataLimite');
                    $dadosEvento['descricao'] = $this->input->post('descricao');
                    $dadosEvento['local'] = $this->input->post('local');
                    $dadosEvento['idUsuario'] = $this->session->id;
                    $dadosEvento['ativo'] = 1;
                    $this->eventos->insert($dadosEvento);
                    $sessao['idEvento'] = $this->eventos->last()->id;
                    $this->session->set_userdata($sessao);
                    $this->load->model('amizades_model', 'amizades');
                    $dados['amizades'] = $this->amizades->findAll($this->session->id);
                    $this->load->view('include/head');
                    $this->load->view('include/header_user');
                    $this->load->view('user/criar/convidados', $dados);
                    $this->load->view('include/footer_user');
                }
            } else {
                redirect(base_url('usuario/criar/evento'));
            }
        } else {
            redirect();
        }
    }

    public function lista() {
        if ($this->session->logado == true) {
            if (isset($this->session->idEvento)) {
                $this->load->model('convidados_model', 'convidados');
                $dados = $this->input->post();
                foreach ($dados as $id => $dado) {
                    if ($dado) {
                        $dadosConvite['comparecera'] = 0;
                        $dadosConvite['compareceu'] = 0;
                        $dadosConvite['bloqueado'] = 0;
                        $dadosConvite['idEvento'] = $this->session->idEvento;
                        $dadosConvite['idUsuario'] = $id;
                        $this->convidados->insert($dadosConvite);
                    }
                }
                $dados['itens'] = NULL;
                $this->load->view('include/head');
                $this->load->view('include/header_user');
                $this->load->view('user/criar/lista', $dados);
                $this->load->view('include/footer_user');
            } else {
                redirect(base_url('usuario/criar/evento'));
            }
        } else {
            redirect();
        }
    }

    public function finalizar() {
        // gravar os dados da lista
        $this->session->unset_userdata('idEvento');
        redirect(base_url('usuario/listas'));
    }

}
