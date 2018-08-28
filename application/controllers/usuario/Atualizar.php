<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Atualizar extends CI_Controller {

    public function index() {
        if ($this->session->logado == true) {
            redirect(base_url('usuario/listas'));
        } else {
            redirect();
        }
    }

    public function evento($idEvento) {
        if ($this->session->logado == true) {
            $this->load->model('tiposeventos_model', 'tiposeventos');
            $dados['tiposeventos'] = $this->tiposeventos->select();
            $this->load->model('eventos_model', 'eventos');
            $dados['evento'] = $this->eventos->find($idEvento);
            $this->load->view('include/head');
            $this->load->view('include/header_user');
            $this->load->view('user/atualizar/evento', $dados);
            $this->load->view('include/footer');
        } else {
            redirect();
        }
    }

    public function atualiza_evento($idEvento, $idEndereco) {
        if ($this->session->logado == true) {
            if ($this->input->post('cep') != NULL) {
                // atualiza endereço do evento
                $this->load->model('enderecos_model', 'enderecos');
                $dadosEndereco['cep'] = $this->input->post('cep');
                $dadosEndereco['logradouro'] = $this->input->post('logradouro');
                $dadosEndereco['numero'] = $this->input->post('numero');
                $dadosEndereco['complemento'] = $this->input->post('complemento');
                $dadosEndereco['bairro'] = $this->input->post('bairro');
                $dadosEndereco['cidade'] = $this->input->post('cidade');
                $dadosEndereco['estado'] = $this->input->post('estado');
                if ($this->enderecos->update($dadosEndereco, $idEndereco)) {
                    // atualiza evento
                    $this->load->model('eventos_model', 'eventos');
                    $dadosEvento['titulo'] = $this->input->post('titulo');
                    $dadosEvento['data'] = $this->input->post('data');
                    $dadosEvento['hora'] = $this->input->post('hora');
                    $dadosEvento['idTipoEvento'] = $this->input->post('idTipoEvento');
                    $dadosEvento['maxItens'] = $this->input->post('maxItens');
                    $dadosEvento['dataLimite'] = $this->input->post('dataLimite');
                    $dadosEvento['descricao'] = $this->input->post('descricao');
                    $dadosEvento['local'] = $this->input->post('local');
                    $this->eventos->update($dadosEvento, $idEvento);
                    redirect(base_url('usuario/listas'));
                }
            } else {
                redirect(base_url('usuario/listas'));
            }
        } else {
            redirect();
        }
    }

    public function convidados($idEvento) {
        if ($this->session->logado == true) {
            // busca amigos do usuário logado que não foram convidados
            $this->load->model('amizades_model', 'amizades');
            $dados['amizades'] = $this->amizades->findAll($this->session->id);
            // carrega convidados
            $this->load->model('convidados_model', 'convidados');
            $dados['convidados'] = $this->convidados->findEvento($idEvento);
            $this->load->view('include/head');
            $this->load->view('include/header_user');
            $this->load->view('user/atualizar/convidados', $dados);
            $this->load->view('include/footer');
        } else {
            redirect();
        }
    }

    public function atualiza_convidados($idEvento) {
        if ($this->session->logado == true) {
            $this->load->model('convidados_model', 'convidados');
            $entradas = $this->input->post();
            // verifica novos amigos selecionados e cadastra seus convites
            foreach ($entradas as $id => $dado) {
                if ($dado) {
                    $dadosConvite['comparecera'] = 0;
                    $dadosConvite['compareceu'] = 0;
                    $dadosConvite['bloqueado'] = 0;
                    $dadosConvite['idEvento'] = $idEvento;
                    $dadosConvite['idUsuario'] = $id;
                    $this->convidados->insert($dadosConvite);
                }
            }
            redirect(base_url('usuario/listas'));
        } else {
            redirect();
        }
    }

    public function bloqueia_convite($idUsuario, $idEvento) {
        if ($this->session->logado == true) {
            $dadosConvite['bloqueado'] = 1;
            $this->load->model('convidados_model', 'convidados');
            $this->convidados->update($dadosConvite, $idUsuario, $idEvento);
            redirect(base_url('usuario/atualizar/convidados/' . idEvento));
        } else {
            redirect();
        }
    }

    public function desbloqueia_convite($idUsuario, $idEvento) {
        if ($this->session->logado == true) {
            $dadosConvite['bloqueado'] = 0;
            $this->load->model('convidados_model', 'convidados');
            $this->convidados->update($dadosConvite, $idUsuario, $idEvento);
            redirect(base_url('usuario/atualizar/convidados/' . idEvento));
        } else {
            redirect();
        }
    }
    
    ////////////////////////////////////////////////////////////////////////////

    public function buscaAPI($idCategoria) {
        // busca categoria do interesse
        $this->load->model('categorias_model', 'categorias');
        $categoria = $this->categorias->find($idCategoria)->idML;
        // consulta da categoria na API
        $url = "https://api.mercadolibre.com/sites/MLB/search?&category=" . $categoria;
        $pagina = curl_init();
        curl_setopt($pagina, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($pagina, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($pagina, CURLOPT_URL, $url);
        $resposta = curl_exec($pagina);
        curl_close($pagina);
        return json_decode($resposta);
    }

    public function buscaLimiteAPI($idCategoria, $limite) {
        // busca categoria do interesse
        $this->load->model('categorias_model', 'categorias');
        $categoria = $this->categorias->find($idCategoria)->idML;
        // consulta da categoria na API com limite de resultados
        $url = "https://api.mercadolibre.com/sites/MLB/search?&limit=" . $limite . "&category=" . $categoria;
        $pagina = curl_init();
        curl_setopt($pagina, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($pagina, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($pagina, CURLOPT_URL, $url);
        $resposta = curl_exec($pagina);
        curl_close($pagina);
        return json_decode($resposta);
    }

    public function lista() {
        if ($this->session->logado == true) {
            if (isset($this->session->idEvento)) {
                $this->load->model('convidados_model', 'convidados');
                $entradas = $this->input->post();
                // verifica amigos selecionados e cadastra seus convites
                foreach ($entradas as $id => $dado) {
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
                // se tiver pelo menos um interesse, recebera recomendacoes
                if (count($interesses) > 0) {
                    // recupera todos os itens da lista do evento
                    $this->load->model('listas_model', 'listas');
                    $itens = $this->listas->selectEvento($this->session->idEvento);
                    // cria vetor de resultados
                    $dados['json'] = array();
                    // se tiver itens na lista, deve verificar similaridade
                    if (count($itens) > 0) {
                        // busca na API itens na categoria de maior peso
                        $json = $this->buscaAPI($interesses[0]->idCategoria);
                        // cria flag
                        $adiciona = true;
                        // zera contador de itens
                        $qnt = 0;
                        // inicializa porcentagem
                        $percent = 0;
                        // para cada resultado do json, percorre cada item ja na lista
                        foreach ($json->results as $produto) {
                            foreach ($itens as $item) {
                                // verifica similaridade entre o titulo do item e do resultado; se parecidos, muda a flag
                                similar_text($produto->title, $item->nome, $percent);
                                if ($percent > 29.99) {
                                    $adiciona = false;
                                    break;
                                }
                            }
                            // se nao encontrou itens parecidos na lista, adiciona nos itens sugeridos
                            if ($adiciona && $qnt < 4) {
                                array_push($dados['json'], $produto);
                                ++$qnt;
                                if ($qnt == 4) {
                                    break;
                                }
                            }
                            // reinicia flag
                            $adiciona = true;
                        }
                        // se tiver pelo menos dois interesses
                        if (count($interesses) > 1) {
                            // busca na API itens na categoria de segundo maior peso
                            $json = $this->buscaAPI($interesses[1]->idCategoria);
                            // contador de itens
                            $qnt = 0;
                            // para cada resultado do json, percorre cada item ja na lista
                            foreach ($json->results as $produto) {
                                foreach ($itens as $item) {
                                    // verifica similaridade entre o titulo do item e do resultado; se parecidos, muda a flag
                                    similar_text($produto->title, $item->nome, $percent);
                                    if ($percent > 29.99) {
                                        $adiciona = false;
                                        break;
                                    }
                                }
                                // se nao encontrou itens parecidos na lista, adiciona nos itens sugeridos
                                if ($adiciona && $qnt < 2) {
                                    array_push($dados['json'], $produto);
                                    ++$qnt;
                                    if ($qnt == 2) {
                                        break;
                                    }
                                }
                                // reinicia flag
                                $adiciona = true;
                            }
                            // se tiver pelo menos três interesses
                            if (count($interesses) > 2) {
                                // busca na API itens na categoria de terceiro maior peso
                                $json = $this->buscaAPI($interesses[2]->idCategoria);
                                // contador de itens
                                $qnt = 0;
                                // para cada resultado do json, percorre cada item ja na lista
                                foreach ($json->results as $produto) {
                                    foreach ($itens as $item) {
                                        // verifica similaridade entre o titulo do item e do resultado; se parecidos, muda a flag
                                        similar_text($produto->title, $item->nome, $percent);
                                        if ($percent > 29.99) {
                                            $adiciona = false;
                                            break;
                                        }
                                    }
                                    // se nao encontrou itens parecidos na lista, adiciona nos itens sugeridos
                                    if ($adiciona && $qnt < 2) {
                                        array_push($dados['json'], $produto);
                                        ++$qnt;
                                        if ($qnt == 2) {
                                            break;
                                        }
                                    }
                                    // reinicia flag
                                    $adiciona = true;
                                }
                            }
                        }
                        // se nao tiver itens na lista, nao precisa verificar similaridades
                    } else {
                        // busca na API itens na categoria de maior peso
                        $json = $this->buscaLimiteAPI($interesses[0]->idCategoria, 4);
                        foreach ($json->results as $produto) {
                            array_push($dados['json'], $produto);
                        }
                        // se tiver pelo menos dois interesses
                        if (count($interesses) > 1) {
                            // busca na API itens na categoria de segundo maior peso
                            $json = $this->buscaLimiteAPI($interesses[1]->idCategoria, 2);
                            foreach ($json->results as $produto) {
                                array_push($dados['json'], $produto);
                            }
                            if (count($interesses) > 2) {
                                // busca na API itens na categoria de terceiro maior peso
                                $json = $this->buscaLimiteAPI($interesses[2]->idCategoria, 2);
                                foreach ($json->results as $produto) {
                                    array_push($dados['json'], $produto);
                                }
                            }
                        }
                    }
                    // randomiza a ordem dos elementos no vetor
                    shuffle($dados['json']);
                    // tranforma vetor em objeto
                    $dados['json'] = (object) $dados['json'];
                } else {
                    $dados['json'] = NULL;
                }
                // carrega lista do evento
                $dados['itens'] = $this->listas->selectEvento($this->session->idEvento);
                $this->load->view('include/head');
                $this->load->view('include/header_user');
                $this->load->view('user/criar/lista', $dados);
                $this->load->view('include/footer');
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
                    $this->load->view('include/footer');
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
                // recupera dados do item escolhido
                $dadosItem = $this->input->post();
                // busca idML do segundo nível de categorias do item                
                $url = "https://api.mercadolibre.com/categories/" . $dadosItem['idCategoria'];
                $pagina = curl_init();
                curl_setopt($pagina, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($pagina, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($pagina, CURLOPT_URL, $url);
                $resposta = curl_exec($pagina);
                curl_close($pagina);
                $json = json_decode($resposta);
                $dadosItem['idCategoria'] = $json->path_from_root[1]->id;
                // busca categoria no banco de dados
                $this->load->model('categorias_model', 'categorias');
                $retorno = $this->categorias->findIdML($dadosItem['idCategoria']);
                // se a categoria existir no banco, coloca o id correspondente; senão, coloca o de "outras categorias"
                if ($retorno != NULL) {
                    $dadosItem['idCategoria'] = $retorno->id;
                } else {
                    $dadosItem['idCategoria'] = 380;
                }
                // verifica se usuário tem interesse nesta categoria
                $this->load->model('interesses_model', 'interesses');
                $interesse = $this->interesses->find($this->session->id, $dadosItem['idCategoria']);
                // se tiver, atualiza o peso; se não tiver, cria interesse com peso 1
                if ($interesse != NULL) {
                    if ($interesse->peso < 5) {
                        $interesse->peso++;
                    }
                    $interesse->data = date("y-m-d");
                    $this->interesses->update($interesse, $this->session->id, $dadosItem['idCategoria']);
                } else {
                    $insere['idUsuario'] = $this->session->id;
                    $insere['idCategoria'] = $dadosItem['idCategoria'];
                    $insere['peso'] = 1;
                    $insere['data'] = date("y-m-d");
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
        // implementar: mudar itens da lista como ativos
        $this->session->unset_userdata('idEvento');
        redirect(base_url('usuario/listas'));
    }

}