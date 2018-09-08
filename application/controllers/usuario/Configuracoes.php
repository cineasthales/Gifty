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

    public function reativar($idUsuario) {
        $this->load->model('usuarios_model', 'usuarios');
        $dados['ativo'] = 1;
        if ($this->usuarios->update($dados, $idUsuario)) {
            $mensagem = "Sua conta foi reativada.";
            $tipo = 1;
        } else {
            $mensagem = "Sua conta não foi reativada.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect('usuario/inicio');
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
        if ($this->enderecos->update($dadosEndereco, $idEndereco)) {
            $this->load->model('usuarios_model', 'usuarios');
            $dadosUsuario['idEndereco'] = $idEndereco;
            $dadosUsuario['nomeUsuario'] = $this->input->post('nomeUsuario');
            $dadosUsuario['nome'] = $this->input->post('nome');
            $dadosUsuario['sobrenome'] = $this->input->post('sobrenome');
            $dadosUsuario['email'] = $this->input->post('email');
            if ($this->input->post('notificaEmail')) {
                $dadosUsuario['notificaEmail'] = 1;
            } else {
                $dadosUsuario['notificaEmail'] = 0;
            }
            $dadosUsuario['cpf'] = $this->input->post('cpf');
            $dadosUsuario['dataNasc'] = $this->input->post('dataNasc');
            $dadosUsuario['genero'] = $this->input->post('genero');
            $dadosUsuario['imagem'] = $this->session->id . '.jpg';
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
