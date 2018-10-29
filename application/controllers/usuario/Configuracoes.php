<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracoes extends CI_Controller {

    public function index() {
        $this->verificaSessao();
        $this->load->model('usuarios_model', 'usuarios');
        $dados['usuario'] = $this->usuarios->findEndereco($this->session->id);
        $this->load->model('telefones_model', 'telefones');
        $dados['telefones'] = $this->telefones->findUsuario($this->session->id);
        $this->load->view('include/head');
        $this->load->view('include/header_user');
        $this->load->view('user/configuracoes', $dados);
        $this->load->view('include/footer');
    }

    public function verificaSessao() {
        if (!$this->session->logado) {
            redirect();
        }
    }

    public function desativar() {
        $this->verificaSessao();
        $this->load->model('usuarios_model', 'usuarios');
        $dados['ativo'] = 0;
        if ($this->usuarios->update($dados, $this->session->id)) {
            // registra log de usuarios
            $this->load->model('logusuarios_model', 'logusuarios');
            $dadosLog['idUsuario'] = $this->session->id;
            $dadosLog['idAcaoUsuario'] = 4;
            $dadosLog['data'] = date("Y-m-d");
            $dadosLog['hora'] = date("h:i:s");
            $this->logusuarios->insert($dadosLog);
            $mensagem = "Sua conta foi desativada.";
            $tipo = 1;
        } else {
            $mensagem = "Sua conta não foi desativada.";
            $tipo = 0;
        }
        $this->session->sess_destroy();
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect();
    }

    public function atualizar_dados() {
        $this->verificaSessao();
        $this->load->model('usuarios_model', 'usuarios');
        $dados['usuario'] = $this->usuarios->findEndereco($this->session->id);
        $this->load->view('include/head');
        $this->load->view('include/header_user');
        $this->load->view('user/atualizar/cadastro', $dados);
        $this->load->view('include/footer');
    }

    public function grava_atualizacao_dados() {
        $this->verificaSessao();
        $this->load->model('enderecos_model', 'enderecos');
        $idEndereco = $this->input->post('idEndereco');
        $dadosEndereco['cep'] = $this->input->post('cep');
        $dadosEndereco['logradouro'] = $this->input->post('logradouro');
        $dadosEndereco['numero'] = $this->input->post('numero');
        $dadosEndereco['complemento'] = $this->input->post('complemento');
        $dadosEndereco['bairro'] = $this->input->post('bairro');
        $dadosEndereco['cidade'] = $this->input->post('cidade');
        $dadosEndereco['estado'] = $this->input->post('estado');
        $confereEnd = $this->enderecos->find($idEndereco);
        if (($dadosEndereco['cep'] != $confereEnd->cep) ||
                ($dadosEndereco['numero'] != $confereEnd->numero) ||
                ($dadosEndereco['complemento'] != $confereEnd->complemento)) {
            // registra log de usuarios
            $this->load->model('logusuarios_model', 'logusuarios');
            $dadosLog['idUsuario'] = $this->session->id;
            $dadosLog['idAcaoUsuario'] = 10;
            $dadosLog['data'] = date("Y-m-d");
            $dadosLog['hora'] = date("h:i:s");
            $this->logusuarios->insert($dadosLog);
        }
        if ($this->enderecos->update($dadosEndereco, $idEndereco)) {
            $dadosUsuario = array();
            $this->load->model('usuarios_model', 'usuarios');
            $confere = $this->usuarios->find($this->session->id);
            $config['upload_path'] = './assets/img/profiles/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 10000;
            $config['max_width'] = 10000;
            $config['max_height'] = 10000;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('imagem')) {
                $arquivo = $this->upload->data();
                $this->load->library('image_lib');
                $this->image_lib->clear();
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/img/profiles/' . $arquivo['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = 100;
                // se nao for quadrada a imagem, corta o excesso
                if ($arquivo['image_width'] > $arquivo['image_height']) {
                    $config['width'] = $arquivo['image_height'];
                    $config['height'] = $arquivo['image_height'];
                    $config['x_axis'] = ($arquivo['image_width'] - $arquivo['image_height']) / 2;
                    $config['y_axis'] = 0;
                    $this->image_lib->initialize($config);
                    $this->image_lib->crop();
                    $this->image_lib->clear();
                } else if ($arquivo['image_height'] > $arquivo['image_width']) {
                    $config['width'] = $arquivo['image_width'];
                    $config['height'] = $arquivo['image_width'];
                    $config['y_axis'] = ($arquivo['image_height'] - $arquivo['image_width']) / 2;
                    $config['x_axis'] = 0;
                    $this->image_lib->initialize($config);
                    $this->image_lib->crop();
                    $this->image_lib->clear();
                }
                // redimensiona
                $config['width'] = 300;
                $config['height'] = 300;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $dadosUsuario['imagem'] = $arquivo['file_name'];
                // apaga imagem anterior
                unlink('./assets/img/profiles/' . $confere->imagem);
                // registra log de usuarios
                $this->load->model('logusuarios_model', 'logusuarios');
                $dadosLog['idUsuario'] = $this->session->id;
                $dadosLog['idAcaoUsuario'] = 6;
                $dadosLog['data'] = date("Y-m-d");
                $dadosLog['hora'] = date("h:i:s");
                $this->logusuarios->insert($dadosLog);
            } else {
                $dadosUsuario['imagem'] = $confere->imagem;
            }
            $dadosUsuario['idEndereco'] = $idEndereco;
            $dadosUsuario['nomeUsuario'] = $this->input->post('nomeUsuario');
            $dadosUsuario['nome'] = $this->input->post('nome');
            $dadosUsuario['sobrenome'] = $this->input->post('sobrenome');
            $dadosUsuario['email'] = $this->input->post('email');
            if ($dadosUsuario['email'] != $confere->email) {
                // registra log de usuarios
                $this->load->model('logusuarios_model', 'logusuarios');
                $dadosLog['idUsuario'] = $this->session->id;
                $dadosLog['idAcaoUsuario'] = 7;
                $dadosLog['data'] = date("Y-m-d");
                $dadosLog['hora'] = date("h:i:s");
                $this->logusuarios->insert($dadosLog);
            }
            if ($this->input->post('notificaEmail')) {
                $dadosUsuario['notificaEmail'] = 1;
            } else {
                $dadosUsuario['notificaEmail'] = 0;
            }
            if ($dadosUsuario['notificaEmail'] != $confere->notificaEmail) {
                if ($dadosUsuario['notificaEmail'] == 1) {
                    // registra log de usuarios
                    $this->load->model('logusuarios_model', 'logusuarios');
                    $dadosLog['idUsuario'] = $this->session->id;
                    $dadosLog['idAcaoUsuario'] = 8;
                    $dadosLog['data'] = date("Y-m-d");
                    $dadosLog['hora'] = date("h:i:s");
                    $this->logusuarios->insert($dadosLog);
                } else {
                    // registra log de usuarios
                    $this->load->model('logusuarios_model', 'logusuarios');
                    $dadosLog['idUsuario'] = $this->session->id;
                    $dadosLog['idAcaoUsuario'] = 9;
                    $dadosLog['data'] = date("Y-m-d");
                    $dadosLog['hora'] = date("h:i:s");
                    $this->logusuarios->insert($dadosLog);
                }
            }
            $dadosUsuario['cpf'] = $this->input->post('cpf');
            $dadosUsuario['dataNasc'] = $this->input->post('dataNasc');
            $dadosUsuario['genero'] = $this->input->post('genero');
            if ($this->usuarios->update($dadosUsuario, $this->session->id)) {
                $mensagem = "Seus dados foram atualizados.";
                $tipo = 1;
            } else {
                $mensagem = "Seus dados não foram atualizados.";
                $tipo = 0;
            }
        } else {
            $mensagem = "Seus dados não foram atualizados.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('usuario/configuracoes');
    }

    public function gerenciar_telefones() {
        $this->verificaSessao();
        $this->load->model('telefones_model', 'telefones');
        $dados['telefones'] = $this->telefones->findUsuario($this->session->id);
        $this->load->view('include/head');
        $this->load->view('include/header_user');
        $this->load->view('user/atualizar/telefones', $dados);
        $this->load->view('include/footer');
    }

    public function grava_telefone() {
        $this->verificaSessao();
        $this->load->model('telefones_model', 'telefones');
        $dados = $this->input->post();
        $dados['idUsuario'] = $this->session->id;
        if ($this->telefones->insert($dados)) {
            // registra log de usuarios
            $this->load->model('logusuarios_model', 'logusuarios');
            $dadosLog['idUsuario'] = $this->session->id;
            $dadosLog['idAcaoUsuario'] = 11;
            $dadosLog['data'] = date("Y-m-d");
            $dadosLog['hora'] = date("h:i:s");
            $this->logusuarios->insert($dadosLog);
            $mensagem = "Telefone adicionado.";
            $tipo = 1;
        } else {
            $mensagem = "Telefone não foi adicionado.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('usuario/configuracoes/gerenciar_telefones');
    }

    public function excluir_telefone($id) {
        $this->verificaSessao();
        $this->load->model('telefones_model', 'telefones');
        if ($this->telefones->delete($id)) {
            // registra log de usuarios
            $this->load->model('logusuarios_model', 'logusuarios');
            $dadosLog['idUsuario'] = $this->session->id;
            $dadosLog['idAcaoUsuario'] = 11;
            $dadosLog['data'] = date("Y-m-d");
            $dadosLog['hora'] = date("h:i:s");
            $this->logusuarios->insert($dadosLog);
            $mensagem = "Telefone excluído.";
            $tipo = 1;
        } else {
            $mensagem = "Telefone não foi excluído.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('usuario/configuracoes/gerenciar_telefones');
    }

    public function trocar_senha() {
        $this->verificaSessao();
        $this->load->view('include/head');
        $this->load->view('include/header_user');
        $this->load->view('user/atualizar/senha');
        $this->load->view('include/footer');
    }

    public function grava_troca_senha() {
        $this->verificaSessao();
        $dados = $this->input->post();
        $this->load->model('usuarios_model', 'usuarios');
        $senha = $this->usuarios->find($this->session->id)->senha;
        if ($senha == md5($dados['senhaAtual'])) {
            if ($dados['senha'] == $dados['senhaRep']) {
                $dadosUsuario['senha'] = md5($dados['senha']);
                if ($this->usuarios->update($dadosUsuario, $this->session->id)) {
                    // registra log de usuarios
                    $this->load->model('logusuarios_model', 'logusuarios');
                    $dadosLog['idUsuario'] = $this->session->id;
                    $dadosLog['idAcaoUsuario'] = 3;
                    $dadosLog['data'] = date("Y-m-d");
                    $dadosLog['hora'] = date("h:i:s");
                    $this->logusuarios->insert($dadosLog);
                    $mensagem = "Senha atualizada.";
                    $tipo = 1;
                } else {
                    $mensagem = "Senha não atualizada.";
                    $tipo = 0;
                }
                $this->session->set_flashdata('mensagem', $mensagem);
                $this->session->set_flashdata('tipo', $tipo);
                redirect('usuario/configuracoes');
            } else {
                $mensagem = "Senhas não correspondem.";
                $tipo = 0;
                $this->session->set_flashdata('mensagem', $mensagem);
                $this->session->set_flashdata('tipo', $tipo);
                redirect('usuario/configuracoes/trocar_senha');
            }
        } else {
            $mensagem = "Senha atual não corresponde.";
            $tipo = 0;
            $this->session->set_flashdata('mensagem', $mensagem);
            $this->session->set_flashdata('tipo', $tipo);
            redirect('usuario/configuracoes/trocar_senha');
        }
    }

}
