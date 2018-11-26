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
            // verifica se for anfitriao do evento
            $this->load->model('eventos_model', 'eventos');
            $verifica = $this->eventos->find($idEvento);
            if ($verifica->idUsuario == $this->session->id) {
                $this->load->model('tiposeventos_model', 'tiposeventos');
                $dados['tiposeventos'] = $this->tiposeventos->select();
                $this->load->model('eventos_model', 'eventos');
                $dados['evento'] = $this->eventos->selectEvento($idEvento);
                $this->load->view('include/head');
                $this->load->view('include/header_user');
                $this->load->view('user/atualizar/evento', $dados);
                $this->load->view('include/footer');
            } else {
                redirect('usuario/listas');
            }
        } else {
            redirect();
        }
    }

    public function atualiza_evento($idEvento, $idEndereco) {
        if ($this->session->logado == true) {
            // verifica se for anfitriao do evento
            $this->load->model('eventos_model', 'eventos');
            $verifica = $this->eventos->find($idEvento);
            if ($verifica->idUsuario == $this->session->id) {
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
                    $confere = $this->enderecos->find($idEndereco);
                    $this->load->model('logeventos_model', 'logeventos');
                    $atualizacoes = array();
                    if (($dadosEndereco['cep'] != $confere->cep) ||
                            ($dadosEndereco['numero'] != $confere->numero) ||
                            ($dadosEndereco['complemento'] != $confere->complemento)) {
                        array_push($atualizacoes, 5);
                        // registra log de eventos                    
                        $dadosLog['idEvento'] = $idEvento;
                        $dadosLog['idAcaoEvento'] = 5;
                        $dadosLog['data'] = date("Y-m-d");
                        $dadosLog['hora'] = date("h:i:s");
                        $this->logeventos->insert($dadosLog);
                    }
                    if ($this->enderecos->update($dadosEndereco, $idEndereco)) {
                        // atualiza evento
                        $this->load->model('eventos_model', 'eventos');
                        $confereEvento = $this->eventos->find($idEvento);
                        $dadosEvento['titulo'] = $this->input->post('titulo');
                        $dadosEvento['data'] = $this->input->post('data');
                        $dadosEvento['hora'] = $this->input->post('hora');
                        $dadosEvento['idTipoEvento'] = $this->input->post('idTipoEvento');
                        $dadosEvento['maxItens'] = $this->input->post('maxItens');
                        $dadosEvento['dataLimite'] = $this->input->post('dataLimite');
                        $dadosEvento['descricao'] = $this->input->post('descricao');
                        $dadosEvento['local'] = $this->input->post('local');
                        if ($dadosEvento['titulo'] != $confereEvento->titulo) {
                            array_push($atualizacoes, 11);
                            // registra log de eventos
                            $dadosLog['idEvento'] = $idEvento;
                            $dadosLog['idAcaoEvento'] = 11;
                            $dadosLog['data'] = date("Y-m-d");
                            $dadosLog['hora'] = date("h:i:s");
                            $this->logeventos->insert($dadosLog);
                        }
                        if ($dadosEvento['data'] != $confereEvento->data) {
                            array_push($atualizacoes, 2);
                            // registra log de eventos
                            $dadosLog['idEvento'] = $idEvento;
                            $dadosLog['idAcaoEvento'] = 2;
                            $dadosLog['data'] = date("Y-m-d");
                            $dadosLog['hora'] = date("h:i:s");
                            $this->logeventos->insert($dadosLog);
                        }
                        if ($dadosEvento['hora'] != $confereEvento->hora) {
                            array_push($atualizacoes, 3);
                            // registra log de eventos
                            $dadosLog['idEvento'] = $idEvento;
                            $dadosLog['idAcaoEvento'] = 3;
                            $dadosLog['data'] = date("Y-m-d");
                            $dadosLog['hora'] = date("h:i:s");
                            $this->logeventos->insert($dadosLog);
                        }
                        if ($dadosEvento['idTipoEvento'] != $confereEvento->idTipoEvento) {
                            array_push($atualizacoes, 12);
                            // registra log de eventos
                            $dadosLog['idEvento'] = $idEvento;
                            $dadosLog['idAcaoEvento'] = 12;
                            $dadosLog['data'] = date("Y-m-d");
                            $dadosLog['hora'] = date("h:i:s");
                            $this->logeventos->insert($dadosLog);
                        }
                        if ($dadosEvento['maxItens'] != $confereEvento->maxItens) {
                            array_push($atualizacoes, 7);
                            // registra log de eventos
                            $dadosLog['idEvento'] = $idEvento;
                            $dadosLog['idAcaoEvento'] = 7;
                            $dadosLog['data'] = date("Y-m-d");
                            $dadosLog['hora'] = date("h:i:s");
                            $this->logeventos->insert($dadosLog);
                        }
                        if ($dadosEvento['dataLimite'] != $confereEvento->dataLimite) {
                            array_push($atualizacoes, 6);
                            // registra log de eventos
                            $dadosLog['idEvento'] = $idEvento;
                            $dadosLog['idAcaoEvento'] = 6;
                            $dadosLog['data'] = date("Y-m-d");
                            $dadosLog['hora'] = date("h:i:s");
                            $this->logeventos->insert($dadosLog);
                        }
                        if ($dadosEvento['descricao'] != $confereEvento->descricao) {
                            array_push($atualizacoes, 13);
                            // registra log de eventos
                            $dadosLog['idEvento'] = $idEvento;
                            $dadosLog['idAcaoEvento'] = 13;
                            $dadosLog['data'] = date("Y-m-d");
                            $dadosLog['hora'] = date("h:i:s");
                            $this->logeventos->insert($dadosLog);
                        }
                        if ($dadosEvento['local'] != $confereEvento->local) {
                            array_push($atualizacoes, 4);
                            // registra log de eventos
                            $dadosLog['idEvento'] = $idEvento;
                            $dadosLog['idAcaoEvento'] = 4;
                            $dadosLog['data'] = date("Y-m-d");
                            $dadosLog['hora'] = date("h:i:s");
                            $this->logeventos->insert($dadosLog);
                        }
                        $this->eventos->update($dadosEvento, $idEvento);
                        $this->notificar_email($idEvento, $atualizacoes);
                        redirect(base_url('usuario/listas'));
                    }
                } else {
                    redirect(base_url('usuario/listas'));
                }
            } else {
                redirect(base_url('usuario/listas'));
            }
        } else {
            redirect();
        }
    }

    public function notificar_email($idEvento, $atualizacoes) {
        if ($this->session->logado == true) {
            $this->load->model('convidados_model', 'convidados');
            $emails = $this->convidados->notifyEmail($idEvento);
            $this->load->model('acoeseventos_model', 'acoeseventos');
            $notificacoes = array();
            foreach ($atualizacoes as $atualizacao) {
                array_push($notificacoes, $this->acoeseventos->find($atualizacao));
            }
            $this->load->model('eventos_model', 'eventos');
            $evento = $this->eventos->selectEvento($idEvento);
            $this->load->library('email');
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'cineasthales@gmail.com',
                'smtp_pass' => 'fnaccm666',
                'mailtype' => 'html',
                'charset' => 'utf-8'
            );
            foreach ($emails as $email) {
                $this->email->initialize($config);
                $this->email->set_mailtype("html");
                $this->email->set_newline("\r\n");
                $htmlContent = '<h1>Novidades no evento!</h1>';
                $htmlContent .= '<p>O evento ' . $evento->titulo . ' de ' . $evento->nome . ' '
                        . $evento->snome . ' recentemente teve as seguintes ações:<ul>';
                foreach ($notificacoes as $notificacao) {
                    $htmlContent .= '<li>' . $notificacao->descricao . '</li>';
                }
                $htmlContent .= '</ul></p><p>Entre no <a href="thalescastro.16mb.com">'
                        . 'Gifty</a> e confira estas novidades!';
                $htmlContent .= '<p>Atenciosamente,</p>';
                $htmlContent .= '<p><b>Equipe do Gifty</b></p><br>';
                $htmlContent .= '<small>Esta é uma mensagem automática. Favor não responder.</small><br>';
                $htmlContent .= '<small>Se você deseja parar de receber estas notificações, favor desmarcar a opção'
                        . ' nas configurações de seu cadastro no Gifty.</small>';
                $this->email->to($email->email);
                $this->email->from('cineasthales@gmail.com', 'Equipe do Gifty');
                $this->email->subject('Atualizações no Evento de ' . $evento->nome . ' ' . $evento->snome);
                $this->email->message($htmlContent);
                $this->email->send();
            }
        } else {
            redirect();
        }
    }

    public function convidados($idEvento) {
        if ($this->session->logado == true) {
            // verifica se for anfitriao do evento
            $this->load->model('eventos_model', 'eventos');
            $verifica = $this->eventos->find($idEvento);
            if ($verifica->idUsuario == $this->session->id) {
                $this->load->model('convidados_model', 'convidados');
                $dados['convidados'] = $this->convidados->selectEventoNaoBloq($idEvento);
                $this->load->model('amizades_model', 'amizades');
                $dados['amizades'] = $this->amizades->findAll($this->session->id);
                $dados['idEvento'] = $idEvento;
                $this->load->view('include/head');
                $this->load->view('include/header_user');
                $this->load->view('user/atualizar/convidados', $dados);
                $this->load->view('include/footer');
            } else {
                redirect('usuario/listas');
            }
        } else {
            redirect();
        }
    }

    public function convidar($idEvento, $idUsuario) {
        if ($this->session->logado == true) {
            // verifica se for anfitriao do evento
            $this->load->model('eventos_model', 'eventos');
            $verifica = $this->eventos->find($idEvento);
            if ($verifica->idUsuario == $this->session->id) {
                $dados['idEvento'] = $idEvento;
                $dados['idUsuario'] = $idUsuario;
                $dados['comparecera'] = 0;
                $dados['compareceu'] = 0;
                $dados['bloqueado'] = 0;
                $this->load->model('convidados_model', 'convidados');
                if ($this->convidados->insert($dados)) {
                    // registra log de eventos
                    $this->load->model('logeventos_model', 'logeventos');
                    $dadosLog['idEvento'] = $idEvento;
                    $dadosLog['idAcaoEvento'] = 9;
                    $dadosLog['data'] = date("Y-m-d");
                    $dadosLog['hora'] = date("h:i:s");
                    $this->logeventos->insert($dadosLog);
                    $mensagem = "Convite enviado.";
                    $tipo = 1;
                } else {
                    $mensagem = "Convite não foi enviado.";
                    $tipo = 0;
                }
                $this->session->set_flashdata('mensagem', $mensagem);
                $this->session->set_flashdata('tipo', $tipo);
                redirect('usuario/atualizar/convidados/' . $idEvento);
            } else {
                redirect('usuario/listas');
            }
        } else {
            redirect();
        }
    }

    public function desfazer_convite($idEvento, $idUsuario) {
        if ($this->session->logado == true) {
            // verifica se for anfitriao do evento
            $this->load->model('eventos_model', 'eventos');
            $verifica = $this->eventos->find($idEvento);
            if ($verifica->idUsuario == $this->session->id) {
                $this->load->model('convidados_model', 'convidados');
                if ($this->convidados->delete($idUsuario, $idEvento)) {
                    // registra log de eventos
                    $this->load->model('logeventos_model', 'logeventos');
                    $dadosLog['idEvento'] = $idEvento;
                    $dadosLog['idAcaoEvento'] = 9;
                    $dadosLog['data'] = date("Y-m-d");
                    $dadosLog['hora'] = date("h:i:s");
                    $this->logeventos->insert($dadosLog);
                    $mensagem = "Convite desfeito.";
                    $tipo = 1;
                } else {
                    $mensagem = "Convite não foi desfeito.";
                    $tipo = 0;
                }
                $this->session->set_flashdata('mensagem', $mensagem);
                $this->session->set_flashdata('tipo', $tipo);
                redirect('usuario/atualizar/convidados/' . $idEvento);
            } else {
                redirect('usuario/listas');
            }
        } else {
            redirect();
        }
    }

    public function convidar_email() {
        if ($this->session->logado == true) {
            $email = $this->input->post('email');
            $idEvento = $this->input->post('idEvento');
            $this->load->model('usuarios_model', 'usuarios');
            $verifica = $this->usuarios->findEmail($email);
            if (!isset($verifica)) {
                $this->load->model('eventos_model', 'eventos');
                $evento = $this->eventos->selectEvento($idEvento);
                $this->load->library('email');
                $config = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => 465,
                    'smtp_user' => 'cineasthales@gmail.com',
                    'smtp_pass' => 'fnaccm666',
                    'mailtype' => 'html',
                    'charset' => 'utf-8'
                );
                $this->email->initialize($config);
                $this->email->set_mailtype("html");
                $this->email->set_newline("\r\n");
                $htmlContent = '<h1>Você tem um novo convite!</h1>';
                $htmlContent .= '<p>' . $evento->nome . ' ' . $evento->snome .
                        ' está convidando você para o evento ' . $evento->titulo . '!</p>';
                $htmlContent .= '<ul><li>Data: ' . date_format(date_create($evento->data), 'd/m/Y') . '</li>';
                $htmlContent .= '<li>Hora: ' . substr($evento->hora, 0, 5) . '</li>';
                $htmlContent .= '<li>Local: ' . $evento->local . ' (' . $evento->logradouro .
                        ', ' . $evento->numero;
                if ($evento->complemento != "") {
                    $htmlContent .= ' - ' . $evento->complemento;
                }
                $htmlContent .= ' - ' . $evento->bairro;
                $htmlContent .= ' - ' . substr($evento->cep, 0, 2) . '.' . substr($evento->cep, 2, 3) . '-'
                        . substr($evento->cep, 5, 3);
                $htmlContent .= ' - ' . $evento->cidade . ' / ' . $evento->estado . ')</li></ul>';
                $htmlContent .= '<p>Cadastre-se hoje mesmo no <a href="thalescastro.16mb.com">'
                        . 'Gifty</a> para ter acesso à lista de presentes e aos detalhes'
                        . ' deste evento! É grátis!';
                $htmlContent .= '<p>E não esqueça de confirmar presença até o dia '
                        . date_format(date_create($evento->dataLimite), 'd/m/Y') . '!</p>';
                $htmlContent .= '<p>Esperamos por você! :)</p>';
                $htmlContent .= '<p><b>Equipe do Gifty</b></p>';
                $htmlContent .= '<small>Esta é uma mensagem automática. Favor não responder.</small>';
                $this->email->to($email);
                $this->email->from('cineasthales@gmail.com', 'Equipe do Gifty');
                $this->email->subject('Convite para Evento de ' . $evento->nome . ' ' . $evento->snome);
                $this->email->message($htmlContent);
                if ($this->email->send()) {
                    $mensagem = "Convite enviado para o e-mail <b>" . $email . "</b>";
                    $tipo = 1;
                } else {
                    $mensagem = "Convite por e-mail não foi enviado.";
                    $tipo = 0;
                }
                $this->session->set_flashdata('mensagem', $mensagem);
                $this->session->set_flashdata('tipo', $tipo);
                redirect('usuario/atualizar/convidados/' . $idEvento);
            } else {
                $mensagem = "Este usuário já está cadastrado no Gifty.";
                $tipo = 0;
                $this->session->set_flashdata('mensagem', $mensagem);
                $this->session->set_flashdata('tipo', $tipo);
                redirect('usuario/atualizar/convidados/' . $idEvento);
            }
        } else {
            redirect();
        }
    }

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

    public function lista($idEvento) {
        if ($this->session->logado == true) {
            // verifica se for anfitriao do evento
            $this->load->model('eventos_model', 'eventos');
            $verifica = $this->eventos->find($idEvento);
            if ($verifica->idUsuario == $this->session->id) {
                // busca interesses do usuário
                $this->load->model('interesses_model', 'interesses');
                $interesses = $this->interesses->selectUsuario($this->session->id);
                // se tiver pelo menos um interesse, recebera recomendacoes
                if (count($interesses) > 0) {
                    // recupera todos os itens da lista do evento
                    $this->load->model('listas_model', 'listas');
                    $itens = $this->listas->selectEvento($idEvento);
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
                    // transforma vetor em objeto
                    $dados['json'] = (object) $dados['json'];
                } else {
                    $dados['json'] = NULL;
                }
                // carrega lista do evento
                $this->load->model('listas_model', 'listas');
                $dados['itens'] = $this->listas->selectEvento($idEvento);
                $dados['idEvento'] = $idEvento;
                $this->load->view('include/head');
                $this->load->view('include/header_user');
                $this->load->view('user/atualizar/lista', $dados);
                $this->load->view('include/footer');
            } else {
                redirect('usuario/listas');
            }
        } else {
            redirect();
        }
    }

    public function busca($idEvento) {
        if ($this->session->logado == true) {
            // verifica se for anfitriao do evento
            $this->load->model('eventos_model', 'eventos');
            $verifica = $this->eventos->find($idEvento);
            if ($verifica->idUsuario == $this->session->id) {

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
                    $dados['idEvento'] = $idEvento;
                    $this->load->view('include/head');
                    $this->load->view('include/header_user');
                    $this->load->view('user/atualizar/busca', $dados);
                    $this->load->view('include/footer');
                } else {
                    redirect(base_url('usuario/atualizar/lista' . $idEvento));
                }
            } else {
                redirect('usuario/listas');
            }
        } else {
            redirect();
        }
    }

    public function adicionar($idEvento) {
        if ($this->session->logado == true) {
            // verifica se for anfitriao do evento
            $this->load->model('eventos_model', 'eventos');
            $verifica = $this->eventos->find($idEvento);
            if ($verifica->idUsuario == $this->session->id) {
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
                // registra log de eventos
                $this->load->model('logeventos_model', 'logeventos');
                $dadosLog['idEvento'] = $idEvento;
                $dadosLog['idAcaoEvento'] = 8;
                $dadosLog['data'] = date("Y-m-d");
                $dadosLog['hora'] = date("h:i:s");
                $this->logeventos->insert($dadosLog);
                // insere item na lista no banco de dados
                $this->load->model('listas_model', 'listas');
                $dadosLista['idItem'] = $this->itens->last()->id;
                $dadosLista['idEvento'] = $idEvento;
                $dadosLista['prioridade'] = $this->listas->count($idEvento) + 1;
                $dadosLista['dataAdicao'] = date("y-m-d");
                $this->listas->insert($dadosLista);
                // carrega lista de presentes
                redirect(base_url('usuario/atualizar/lista/' . $idEvento));
            } else {
                redirect('usuario/listas');
            }
        } else {
            redirect();
        }
    }

    public function descer($idItem, $idEvento) {
        if ($this->session->logado == true) {
            // verifica se for anfitriao do evento
            $this->load->model('eventos_model', 'eventos');
            $verifica = $this->eventos->find($idEvento);
            if ($verifica->idUsuario == $this->session->id) {
                $this->load->model('listas_model', 'listas');
                $item = $this->listas->find($idEvento, $idItem);
                $antiga = $item->prioridade;
                $nova = $item->prioridade + 1;
                $troca = $this->listas->findPrioridade($idEvento, $nova);
                $item->prioridade = $nova;
                $troca->prioridade = $antiga;
                $this->listas->update($item, $idEvento, $item->idItem);
                $this->listas->update($troca, $idEvento, $troca->idItem);
                redirect(base_url('usuario/atualizar/lista/' . $idEvento));
            } else {
                redirect('usuario/listas');
            }
        } else {
            redirect();
        }
    }

    public function subir($idItem, $idEvento) {
        if ($this->session->logado == true) {
            // verifica se for anfitriao do evento
            $this->load->model('eventos_model', 'eventos');
            $verifica = $this->eventos->find($idEvento);
            if ($verifica->idUsuario == $this->session->id) {
                $this->load->model('listas_model', 'listas');
                $item = $this->listas->find($idEvento, $idItem);
                $antiga = $item->prioridade;
                $nova = $item->prioridade - 1;
                $troca = $this->listas->findPrioridade($idEvento, $nova);
                $item->prioridade = $nova;
                $troca->prioridade = $antiga;
                $this->listas->update($item, $idEvento, $item->idItem);
                $this->listas->update($troca, $idEvento, $troca->idItem);
                redirect(base_url('usuario/atualizar/lista/' . $idEvento));
            } else {
                redirect('usuario/listas');
            }
        } else {
            redirect();
        }
    }

    public function finalizar() {
        redirect(base_url('usuario/listas'));
    }

    public function excluir_item($idEvento, $idItem) {
        if ($this->session->logado == true) {
            // verifica se for anfitriao do evento
            $this->load->model('eventos_model', 'eventos');
            $verifica = $this->eventos->find($idEvento);
            if ($verifica->idUsuario == $this->session->id) {
                $this->load->model('listas_model', 'listas');
                $this->listas->delete($idEvento, $idItem);
                $lista = $this->listas->selectEvento($idEvento);
                $i = 1;                
                foreach ($lista as $item) {
                    $dados['prioridade'] = $i;
                    $this->listas->update($dados, $idEvento, $item->idItem);
                    ++$i;
                }
                redirect('usuario/atualizar/lista/' . $idEvento);
            } else {
                redirect('usuario/listas');
            }
        } else {
            redirect();
        }
    }

    public function excluir($idEvento) {
        if ($this->session->logado == true) {
            // verifica se for anfitriao do evento
            $this->load->model('eventos_model', 'eventos');
            $verifica = $this->eventos->find($idEvento);
            if ($verifica->idUsuario == $this->session->id) {
                $evento['ativo'] = 0;
                $this->load->model('eventos_model', 'eventos');
                if ($this->eventos->update($evento, $idEvento)) {
                    // registra log de eventos
                    $this->load->model('logeventos_model', 'logeventos');
                    $dadosLog['idEvento'] = $idEvento;
                    $dadosLog['idAcaoEvento'] = 10;
                    $dadosLog['data'] = date("Y-m-d");
                    $dadosLog['hora'] = date("h:i:s");
                    if ($this->logeventos->insert($dadosLog)) {
                        $mensagem = "Evento cancelado.";
                        $tipo = 1;
                    }
                } else {
                    $mensagem = "Evento não foi cancelado.";
                    $tipo = 0;
                }
                $this->session->set_flashdata('mensagem', $mensagem);
                $this->session->set_flashdata('tipo', $tipo);
                redirect('usuario/listas');
            } else {
                redirect('usuario/listas');
            }
        } else {
            redirect();
        }
    }

    public function confirmar_presenca($idUsuario, $idEvento) {
        if ($this->session->logado == true) {
            $convite['comparecera'] = 1;
            $this->load->model('convidados_model', 'convidados');
            if ($this->convidados->update($convite, $idUsuario, $idEvento)) {
                $mensagem = "Presença confirmada.";
                $tipo = 1;
            } else {
                $mensagem = "Confirmação de presença não foi registrada.";
                $tipo = 0;
            }
            $this->session->set_flashdata('mensagem', $mensagem);
            $this->session->set_flashdata('tipo', $tipo);
            redirect('usuario/listas');
        } else {
            redirect();
        }
    }

    public function desconfirmar_presenca($idUsuario, $idEvento) {
        if ($this->session->logado == true) {
            $convite['comparecera'] = 0;
            $this->load->model('convidados_model', 'convidados');
            if ($this->convidados->update($convite, $idUsuario, $idEvento)) {
                $this->load->model('listas_model', 'listas');
                $itens = $this->listas->selectEvento($idEvento);
                $dados['idComprador'] = 0;
                foreach ($itens as $item) {
                    if ($item->idComprador == $this->session->id) {
                        $this->listas->update($dados, $idEvento, $item->idItem);
                    }
                }
                $mensagem = "Presença desconfirmada.";
                $tipo = 1;
            } else {
                $mensagem = "Desconfirmação de presença não foi registrada.";
                $tipo = 0;
            }
            $this->session->set_flashdata('mensagem', $mensagem);
            $this->session->set_flashdata('tipo', $tipo);
            redirect('usuario/listas');
        } else {
            redirect();
        }
    }

    public function confirmar_presenca_lista($idUsuario, $idEvento) {
        if ($this->session->logado == true) {
            $convite['comparecera'] = 1;
            $this->load->model('convidados_model', 'convidados');
            if ($this->convidados->update($convite, $idUsuario, $idEvento)) {
                $mensagem = "Presença confirmada.";
                $tipo = 1;
            } else {
                $mensagem = "Confirmação de presença não foi registrada.";
                $tipo = 0;
            }
            $this->session->set_flashdata('mensagem', $mensagem);
            $this->session->set_flashdata('tipo', $tipo);
            redirect('usuario/listas/ver/' . $idEvento);
        } else {
            redirect();
        }
    }

    public function desconfirmar_presenca_lista($idUsuario, $idEvento) {
        if ($this->session->logado == true) {
            $convite['comparecera'] = 0;
            $this->load->model('convidados_model', 'convidados');
            if ($this->convidados->update($convite, $idUsuario, $idEvento)) {
                $this->load->model('listas_model', 'listas');
                $itens = $this->listas->selectEvento($idEvento);
                $dados['idComprador'] = NULL;
                foreach ($itens as $item) {
                    if ($item->idComprador == $this->session->id) {
                        $this->listas->update($dados, $idEvento, $item->idItem);
                    }
                }
                $mensagem = "Presença desconfirmada.";
                $tipo = 1;
            } else {
                $mensagem = "Desconfirmação de presença não foi registrada.";
                $tipo = 0;
            }
            $this->session->set_flashdata('mensagem', $mensagem);
            $this->session->set_flashdata('tipo', $tipo);
            redirect('usuario/listas/ver/' . $idEvento);
        } else {
            redirect();
        }
    }

    public function marcar($idEvento, $idItem) {
        if ($this->session->logado == true) {
            $this->load->model('listas_model', 'listas');
            $numeroItens = $this->listas->countUsuario($idEvento, $this->session->id);
            $this->load->model('eventos_model', 'eventos');
            $maxItens = $this->eventos->find($idEvento)->maxItens;
            if ($numeroItens < $maxItens) {
                $convite['idComprador'] = $this->session->id;
                if ($this->listas->update($convite, $idEvento, $idItem)) {
                    $mensagem = "Você marcou o item como comprado.";
                    $tipo = 1;
                } else {
                    $mensagem = "Não foi possível marcar o item como comprado.";
                    $tipo = 0;
                }
            } else {
                $mensagem = "Você já marcou o número máximo de itens por convidado.";
                $tipo = 0;
            }
            $this->session->set_flashdata('mensagem', $mensagem);
            $this->session->set_flashdata('tipo', $tipo);
            redirect('usuario/listas/ver/' . $idEvento);
        } else {
            redirect();
        }
    }

    public function desmarcar($idEvento, $idItem) {
        if ($this->session->logado == true) {
            $convite['idComprador'] = 0;
            $this->load->model('listas_model', 'listas');
            if ($this->listas->update($convite, $idEvento, $idItem)) {
                $mensagem = "Você desmarcou a compra do item.";
                $tipo = 1;
            } else {
                $mensagem = "Não foi possível desmarcar a compra do item.";
                $tipo = 0;
            }
            $this->session->set_flashdata('mensagem', $mensagem);
            $this->session->set_flashdata('tipo', $tipo);
            redirect('usuario/listas/ver/' . $idEvento);
        } else {
            redirect();
        }
    }

}
