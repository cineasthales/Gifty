<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Amigos extends CI_Controller {

    public function index() {
        if ($this->session->logado == true) {
            if ($this->session->has_userdata('idEvento')) {
                $this->session->unset_userdata('idEvento');
            }
            $this->load->model('amizades_model', 'amizades');
            $dados['amizades'] = $this->amizades->findAll($this->session->id);
            $this->load->view('include/head');
            $this->load->view('include/header_user');
            $this->load->view('user/amigos', $dados);
            $this->load->view('include/footer');
        } else {
            redirect();
        }
    }

    public function perfil($idUsuario) {
        if ($this->session->logado == true) {
            if (isset($idUsuario) && $idUsuario != $this->session->id) {
                // busco usuario no banco de dados
                $this->load->model('usuarios_model', 'usuarios');
                $dados['usuario'] = $this->usuarios->findEndereco($idUsuario);
                // busca dados da amizade entre usuário e amigo
                $this->load->model('amizades_model', 'amizades');
                $amizade = $this->amizades->find($idUsuario, $this->session->id);
                // se forem amigos
                if (isset($amizade)) {
                    // se amizade não estiver sido desfeita
                    if ($amizade->ativa == 1) {
                        // conta amigos do amigo
                        $dados['numAmigos'] = count($this->amizades->findAll($idUsuario));
                        // resgata telefones do amigo
                        $this->load->model('telefones_model', 'telefones');
                        $dados['telefones'] = $this->telefones->findUsuario($idUsuario);
                        // se o usuario logado bloqueou o outro
                        if (($amizade->bloqueado1 && $amizade->idUsuario2 == $this->session->id) ||
                                ($amizade->bloqueado2 && $amizade->idUsuario1 == $this->session->id)) {
                            $dados['amizade'] = $amizade;
                            $this->load->view('include/head');
                            $this->load->view('include/header_user');
                            $this->load->view('user/perfil_bloq', $dados);
                            $this->load->view('include/footer');
                        } else {
                            $dados['amizade'] = $amizade;
                            $this->load->view('include/head');
                            $this->load->view('include/header_user');
                            $this->load->view('user/perfil_amigo', $dados);
                            $this->load->view('include/footer');
                        }
                    } else {
                        redirect('usuario/amigos');
                    }
                } else {
                    redirect('usuario/amigos');
                }
            } else {
                redirect('usuario/amigos');
            }
        } else {
            redirect();
        }
    }

    public function bloquear($idUsuario) {
        if ($this->session->logado == true) {
            $this->load->model('amizades_model', 'amizades');
            $amizade = $this->amizades->find($this->session->id, $idUsuario);
            $acao = false;
            if ($amizade->idUsuario1 == $this->session->id) {
                $dados['bloqueado2'] = 1;
                $acao = $this->amizades->update($dados, $this->session->id, $idUsuario);
            } else {
                $dados['bloqueado1'] = 1;
                $acao = $this->amizades->update($dados, $idUsuario, $this->session->id);
            }
            if ($acao) {
                $mensagem = "Amigo bloqueado.";
                $tipo = 1;
            } else {
                $mensagem = "Amigo não foi bloqueado.";
                $tipo = 0;
            }
            $this->session->set_flashdata('mensagem', $mensagem);
            $this->session->set_flashdata('tipo', $tipo);
            redirect('usuario/amigos');
        } else {
            redirect();
        }
    }

    public function desbloquear($idUsuario) {
        if ($this->session->logado == true) {
            $this->load->model('amizades_model', 'amizades');
            $amizade = $this->amizades->find($this->session->id, $idUsuario);
            $acao = false;
            if ($amizade->idUsuario1 == $this->session->id) {
                $dados['bloqueado2'] = 0;
                $acao = $this->amizades->update($dados, $this->session->id, $idUsuario);
            } else {
                $dados['bloqueado1'] = 0;
                $acao = $this->amizades->update($dados, $idUsuario, $this->session->id);
            }
            if ($acao) {
                $mensagem = "Amigo desbloqueado.";
                $tipo = 1;
            } else {
                $mensagem = "Amigo não foi desbloqueado.";
                $tipo = 0;
            }
            $this->session->set_flashdata('mensagem', $mensagem);
            $this->session->set_flashdata('tipo', $tipo);
            redirect('usuario/amigos');
        } else {
            redirect();
        }
    }

    public function desfazer_amizade($idUsuario) {
        if ($this->session->logado == true) {
            $dados['ativa'] = 0;
            $this->load->model('amizades_model', 'amizades');
            $amizade = $this->amizades->find($this->session->id, $idUsuario);
            if ($amizade->idUsuario1 == $this->session->id) {
                if ($this->amizades->update($dados, $this->session->id, $idUsuario)) {
                    $mensagem = "Amizade desfeita.";
                    $tipo = 1;
                } else {
                    $mensagem = "Amizade não foi desfeita.";
                    $tipo = 0;
                }
            } else {
                if ($this->amizades->update($dados, $idUsuario, $this->session->id)) {
                    $mensagem = "Amizade desfeita.";
                    $tipo = 1;
                } else {
                    $mensagem = "Amizade não foi desfeita.";
                    $tipo = 0;
                }
            }
            $this->session->set_flashdata('mensagem', $mensagem);
            $this->session->set_flashdata('tipo', $tipo);
            redirect('usuario/amigos');
        } else {
            redirect();
        }
    }

    public function adicionar($idUsuario) {
        if ($this->session->logado == true) {
            $this->load->model('amizades_model', 'amizades');
            $amizade = $this->amizades->find($this->session->id, $idUsuario);
            if (isset($amizade)) {
                $dados['ativa'] = 1;
                if ($amizade->idUsuario1 == $this->session->id) {
                    if ($this->amizades->update($dados, $this->session->id, $idUsuario)) {
                        $mensagem = "Solicitação de amizade enviada.";
                        $tipo = 1;
                    } else {
                        $mensagem = "Solicitação de amizade não foi enviada.";
                        $tipo = 0;
                    }
                } else {
                    if ($this->amizades->update($dados, $idUsuario, $this->session->id)) {
                        $mensagem = "Solicitação de amizade enviada.";
                        $tipo = 1;
                    } else {
                        $mensagem = "Solicitação de amizade não foi enviada.";
                        $tipo = 0;
                    }
                }
            } else {
                $dados['idUsuario1'] = $this->session->id;
                $dados['idUsuario2'] = $idUsuario;
                $dados['bloqueado1'] = 0;
                $dados['bloqueado2'] = 0;
                $dados['ativa'] = 1;
                $dados['data'] = date('Y-m-d');
                if ($this->amizades->insert($dados)) {
                    $mensagem = "Solicitação de amizade enviada.";
                    $tipo = 1;
                } else {
                    $mensagem = "Solicitação de amizade não foi enviada.";
                    $tipo = 0;
                }
            }
            $this->session->set_flashdata('mensagem', $mensagem);
            $this->session->set_flashdata('tipo', $tipo);
            redirect('usuario/amigos');
        } else {
            redirect();
        }
    }

    public function buscar() {
        if ($this->session->logado == true) {
            $busca = $this->input->post('busca');
            if (isset($busca)) {
                $this->load->model('usuarios_model', 'usuarios');
                $usuarios = $this->usuarios->searchNome($busca);
                $this->load->model('amizades_model', 'amizades');
                $amizades = $this->amizades->findAll($this->session->id);
                $amigo = 0;
                $dados['usuarios'] = array();
                // verifica se usuarios ja sao amigos
                foreach ($usuarios as $usuario) {
                    foreach ($amizades as $amizade) {
                        if ($usuario->id == $amizade->idUsuario1 || $usuario->id == $amizade->idUsuario2) {
                            $amigo = 1;
                            break;
                        }
                    }
                    if (!$amigo) {
                        array_push($dados['usuarios'], $usuario);
                    }
                    $amigo = 0;
                }                            
                $dados['busca'] = $busca;
                $this->load->view('include/head');
                $this->load->view('include/header_user');
                $this->load->view('user/busca_amigos', $dados);
                $this->load->view('include/footer');
            } else {
                redirect('usuario/amigos');
            }
        } else {
            redirect();
        }
    }

}
