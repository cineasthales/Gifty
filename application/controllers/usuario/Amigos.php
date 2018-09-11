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
                        $this->load->view('include/head');
                        $this->load->view('include/header_user');
                        $this->load->view('user/perfil_refaz', $dados);
                        $this->load->view('include/footer');
                    }
                } else {
                    $this->load->view('include/head');
                    $this->load->view('include/header_user');
                    $this->load->view('user/perfil_outros', $dados);
                    $this->load->view('include/footer');
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
            if ($amizade['idUsuario1'] == $this->session->id) {
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
            if ($amizade['idUsuario1'] == $this->session->id) {
                $dados['bloqueado2'] = 0;
                $acao = $this->amizades->update($dados, $this->session->id, $idUsuario);
            } else {
                $dados['bloqueado1'] = 0;
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

    // NAO ESTA PRONTO!!!!
    public function desfazer_amizade($idUsuario) {
        if ($this->session->logado == true) {
            $dados['ativa'] = 0;
            $this->load->model('amizades_model', 'amizades');            
            if ($this->amizades->update($dados, $this->session->id, $idUsuario)) {
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

    public function buscar() {
        if ($this->session->logado == true) {
            $busca = $this->input->post('busca');
            if (isset($busca)) {
                $this->load->model('usuarios_model', 'usuarios');
                $dados['usuarios'] = $this->usuarios->searchNome($busca);
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
