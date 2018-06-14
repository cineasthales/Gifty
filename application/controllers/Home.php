<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index() {
        if ($this->session->logado == true) {
            redirect('usuario/inicio');
        } else
        if ($this->session->logado_admin == true) {
            redirect('admin/dashboard');
        } else {
            $this->load->view('include/head');
            $this->load->view('include/header_ext');
            $this->load->view('home');
            $this->load->view('include/footer');
        }
    }

    public function logar() {
        $this->load->model('usuarios_model', 'usuarios');
        $user = $this->input->post('user');
        $senha = $this->input->post('senha');
        $verifica = $this->usuarios->check($user, md5($senha));
        if (isset($verifica)) {
            if ($verifica->nivel == 0) {
                $sessao['logado'] = true;
                $sessao['logado_admin'] = false;
            } else {
                $sessao['logado'] = false;
                $sessao['logado_admin'] = true;
            }
            $sessao['id'] = $verifica->id;
            $sessao['nome'] = $verifica->nome;
            $this->session->set_userdata($sessao);
        } else {
            $mensagem = "Nome de usuário, e-mail e/ou senha incorretos.";
            $tipo = 0;
            $this->session->set_flashdata('mensagem', $mensagem);
            $this->session->set_flashdata('tipo', $tipo);
        }
        redirect();
    }

    public function sair() {
        $this->session->sess_destroy();
        redirect();
    }

    public function esqueciSenha() {
        $this->session->sess_destroy();
        $this->load->view('include/head');
        $this->load->view('include/header_ext');
        $this->load->view('esquecisenha');
        $this->load->view('include/footer');
    }

    public function cadastrar() {
        $this->session->sess_destroy();
        $this->load->model('categorias_model', 'categorias');
        $dados['categorias'] = $this->categorias->selectByName();
        $this->load->view('include/head');
        $this->load->view('include/header_ext');
        $this->load->view('cadastro', $dados);
        $this->load->view('include/footer');
    }

    public function grava_cadastro() {
        $this->load->model('enderecos_model', 'enderecos');
        $dadosEndereco['cep'] = $this->input->post('cep');
        $dadosEndereco['logradouro'] = $this->input->post('logradouro');
        $dadosEndereco['numero'] = $this->input->post('numero');
        $dadosEndereco['complemento'] = $this->input->post('complemento');
        $dadosEndereco['bairro'] = $this->input->post('bairro');
        $dadosEndereco['cidade'] = $this->input->post('cidade');
        $dadosEndereco['estado'] = $this->input->post('estado');
        if ($this->enderecos->insert($dadosEndereco)) {
            $this->load->model('usuarios_model', 'usuarios');
            $dadosUsuario['idEndereco'] = $this->enderecos->last()->id;
            $dadosUsuario['nomeUsuario'] = $this->input->post('nomeUsuario');
            $dadosUsuario['senha'] = md5($this->input->post('senha'));
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
            //$dadosUsuario['imagem'] = $this->input->post('imagem');
            $dadosUsuario['nivel'] = 0;
            $dadosUsuario['ativo'] = 1;
            $dadosUsuario['tentaLogin'] = 0;
            if ($this->usuarios->insert($dadosUsuario)) {
                $registro['idUsuario'] = $this->usuarios->last()->id;
                $this->load->model('interesses_model', 'interesses');
                for ($i = 0; $i < 36; $i++) {
                    if ($this->input->post('categoria_' . $i)) {
                        $registro['idCategoria'] = $i;
                        $this->interesses->insert($registro);
                    }
                }
                $mensagem = "Confirme seu cadastro no e-mail <strong>" . $dadosUsuario['email'] . "</strong>.";
                $tipo = 1;
            } else {
                $mensagem = "Dados de usuário não foram cadastrados.";
                $tipo = 0;
            }
        } else {
            $mensagem = "Dados de endereço e de usuário não foram cadastrados.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect();
    }

}
