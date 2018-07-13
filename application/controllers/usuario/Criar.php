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
                // busca interesses do usuário
                $this->load->model('interesses_model', 'interesses');
                $interesses = $this->interesses->selectUsuario($this->session->id);
                // verifica o interesse de maior peso
                $maior = -1;
                $idCategoria = 0;
                foreach ($interesses as $interesse) {
                    if ($interesse->peso > $maior){
                        $maior = $interesse->peso;
                        $idCategoria = $interesse->idCategoria;
                    }
                }
                // busca categoria com interesse de maior peso
                $this->load->model('categorias_model', 'categorias');
                $categoria = $this->categorias->find($idCategoria);
                // consulta da categoria na API, limite de 5 resultados e de lojas oficiais
                $url = "https://api.mercadolibre.com/sites/MLB/search?&official_store_id=all&limit=5&category=" . $categoria->idML;
                $pagina = curl_init();
                curl_setopt($pagina, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($pagina, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($pagina, CURLOPT_URL, $url);
                $resposta = curl_exec($pagina);
                curl_close($pagina);
                $dados['json'] = json_decode($resposta);
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

    // BUG: TODOS CADASTRAM COMO "OUTROS CATEGORIAS"!
    public function adicionar() {
        if ($this->session->logado == true) {
            if (isset($this->session->idEvento)) {
                // recupera dados do item escolhido
                $dadosItem = $this->input->post();
                // busca categoria no banco de dados
                $this->load->model('categorias_model', 'categorias');
                $retorno = $this->categorias->findIdML($dadosItem['idCategoria']);
                // se a categoria existir no banco, coloca o id correspondente; senão, coloca o de "outras categorias"
                if (isset($retorno)) {
                    $dadosItem['idCategoria'] = $retorno->id;
                } else {
                    $dadosItem['idCategoria'] = 380;
                }
                // verifica se usuário tem interesse nesta categoria
                $this->load->model('interesses_model', 'interesses');
                $interesse = $this->interesses->find($this->session->id, $dadosItem['idCategoria']);
                // se tiver, atualiza o peso; se não tiver, cria interesse com peso zero
                if (isset($interesse) && $interesse->peso < 5) {
                    $interesse->peso++;
                    $this->interesses->update($interesse, $this->session->id, $dadosItem['idCategoria']);
                } else {
                    $insere['idUsuario'] = $this->session->id;
                    $insere['idCategoria'] = $dadosItem['idCategoria'];
                    $insere['peso'] = 0;
                    $this->interesses->insert($insere);
                }
                // insere item no banco de dados
                $this->load->model('itens_model', 'itens');
                $this->itens->insert($dadosItem);
                // insere item na lista no banco de dados
                $this->load->model('listas_model', 'listas');
                $dadosLista['idItem'] = $this->itens->last()->id;
                $dadosLista['idEvento'] = $this->session->idEvento;
                $dadosLista['prioridade'] = $this->listas->count($this->session->idEvento) + 1;
                $dadosLista['dataAdicao'] = date("y-m-d");
                $this->listas->insert($dadosLista);
                // carrega lista de presentes
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
