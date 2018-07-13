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
                $this->load->model('listas_model', 'listas');
                $dados['itens'] = $this->listas->selectEvento($this->session->idEvento);
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

    public function busca() {
        if ($this->session->logado == true) {
            if (isset($this->session->idEvento)) {
                $busca = $this->input->post("busca");
                if (isset($busca)) {
                    // obtém o id passado pelo form
                    $consulta = str_replace(" ", "%20", htmlspecialchars($busca));
                    // indica a url a ser carregada
                    $url = "https://api.mercadolibre.com/sites/MLB/search?q=" . $consulta;
                    // inicializa a biblioteca curl que permite que uma página seja carregada
                    $pagina = curl_init();
                    // define as configurações da chamada (basicamente que
                    // o retorno seja transferido para uma variável)
                    curl_setopt($pagina, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($pagina, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($pagina, CURLOPT_URL, $url);
                    // atribui para a variável o conteúdo retornado pela chamada curl à url
                    $resposta = curl_exec($pagina);
                    curl_close($pagina);
                    // converte a resposta json para um objeto
                    $dados['json'] = json_decode($resposta);
                    $this->load->view('include/head');
                    $this->load->view('include/header_user');
                    $this->load->view('user/criar/busca', $dados);
                    $this->load->view('include/footer_user');
                } else {
                    redirect(base_url('usuario/criar/lista'));
                }
            } else {
                redirect(base_url('usuario/criar/evento'));
            }
        } else {
            redirect();
        }
    }

    public function adicionar() {
        if ($this->session->logado == true) {
            if (isset($this->session->idEvento)) {
                $dadosItem = $this->input->post();
                $this->load->model('itens_model', 'itens');
                $this->load->model('listas_model', 'listas');
                $this->itens->insert($dadosItem);
                $dadosLista['idItem'] = $this->itens->last()->id;
                $dadosLista['idEvento'] = $this->session->idEvento;
                $dadosLista['prioridade'] = $this->listas->count($this->session->idEvento) + 1;
                $dadosLista['dataAdicao'] = date("y-m-d");
                $this->load->model('listas_model', 'listas');
                $this->listas->insert($dadosLista);
                redirect(base_url('usuario/criar/lista'));
            } else {
                redirect(base_url('usuario/criar/evento'));
            }
        } else {
            redirect();
        }
    }

    public function descer($idItem) {
        if ($this->session->logado == true) {
            if (isset($this->session->idEvento)) {
                $this->load->model('listas_model', 'listas');
                $item = $this->listas->find($this->session->idEvento, $idItem);
                $antiga = $item->prioridade;
                $nova = $item->prioridade + 1;
                $troca = $this->listas->findPrioridade($this->session->idEvento, $nova);
                $item->prioridade = $nova;
                $troca->prioridade = $antiga;                
                $this->listas->update($item, $this->session->idEvento, $item->idItem);
                $this->listas->update($troca, $this->session->idEvento, $troca->idItem);
                redirect(base_url('usuario/criar/lista'));
            } else {
                redirect(base_url('usuario/criar/evento'));
            }
        } else {
            redirect();
        }
    }

    public function subir($idItem) {
        if ($this->session->logado == true) {
            if (isset($this->session->idEvento)) {
                $this->load->model('listas_model', 'listas');
                $item = $this->listas->find($this->session->idEvento, $idItem);
                $antiga = $item->prioridade;
                $nova = $item->prioridade - 1;
                $troca = $this->listas->findPrioridade($this->session->idEvento, $nova);
                $item->prioridade = $nova;
                $troca->prioridade = $antiga;                
                $this->listas->update($item, $this->session->idEvento, $item->idItem);
                $this->listas->update($troca, $this->session->idEvento, $troca->idItem);
                redirect(base_url('usuario/criar/lista'));
            } else {
                redirect(base_url('usuario/criar/evento'));
            }
        } else {
            redirect();
        }
    }

    public function finalizar() {
        // mudar itens da lista como ativos
        $this->session->unset_userdata('idEvento');
        redirect(base_url('usuario/listas'));
    }

}
