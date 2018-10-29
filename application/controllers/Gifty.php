<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gifty extends CI_Controller {

    public function index() {
        if ($this->session->logado == true) {
            redirect('usuario/inicio');
        } else if ($this->session->logado_admin == true) {
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
            if ($verifica->ativo == 1) {
                if ($verifica->nivel == 0) {
                    $sessao['logado'] = true;
                    $sessao['logado_admin'] = false;
                    // registra log de usuarios
                    $this->load->model('logusuarios_model', 'logusuarios');
                    $dadosLog['idUsuario'] = $verifica->id;
                    $dadosLog['idAcaoUsuario'] = 1;
                    $dadosLog['data'] = date("Y-m-d");
                    $dadosLog['hora'] = date("h:i:s");
                    $this->logusuarios->insert($dadosLog);
                } else {
                    $sessao['logado'] = false;
                    $sessao['logado_admin'] = true;
                }
                $sessao['id'] = $verifica->id;
                $sessao['nome'] = $verifica->nome;
                $sessao['genero'] = $verifica->genero;
                $this->session->set_userdata($sessao);
                // busca todos os interesses do usuario que logou
                $this->load->model('interesses_model', 'interesses');
                $interesses = $this->interesses->selectUsuarioAll($this->session->id);
                // se houver interesses cadastrados
                if (isset($interesses)) {
                    $hoje = date("y-m-d");
                    foreach ($interesses as $interesse) {
                        // se o interesse foi atualizado em mais de 90 dias, diminui peso e atualiza data
                        if (date_diff(date_create($interesse->data), date_create($hoje))->format('%d') > 90) {
                            $interesse->peso--;
                            $interesse->data = $hoje;
                            $this->interesses->update($interesse, $this->session->id, $interesse->idCategoria);
                        }
                    }
                }
                redirect();
            } else {
                $sessao['id'] = $verifica->id;
                $sessao['email'] = $verifica->email;
                $this->session->set_userdata($sessao);
                redirect('gifty/conta_desativada');
            }
        } else {
            $mensagem = "Nome de usuário, e-mail e/ou senha incorretos.";
            $tipo = 0;
            $this->session->set_flashdata('mensagem', $mensagem);
            $this->session->set_flashdata('tipo', $tipo);
            redirect();
        }
    }

    public function conta_desativada() {
        $dados['id'] = $this->session->id;
        $dados['email'] = $this->session->email;
        $this->session->sess_destroy();
        $this->load->view('include/head');
        $this->load->view('include/header_ext');
        $this->load->view('desativada', $dados);
        $this->load->view('include/footer');
    }

    public function reativar($idUsuario) {
        $this->load->model('usuarios_model', 'usuarios');
        $dados['ativo'] = 1;
        if ($this->usuarios->update($dados, $idUsuario)) {
            $mensagem = "Sua conta foi reativada. Favor refazer o login.";
            $tipo = 1;
        } else {
            $mensagem = "Sua conta não foi reativada.";
            $tipo = 0;
        }
        $this->session->set_flashdata('mensagem', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        redirect();
    }

    public function sair() {
        // registra log de usuarios
        $this->load->model('logusuarios_model', 'logusuarios');
        $dadosLog['idUsuario'] = $this->session->id;
        $dadosLog['idAcaoUsuario'] = 2;
        $dadosLog['data'] = date("Y-m-d");
        $dadosLog['hora'] = date("h:i:s");
        $this->logusuarios->insert($dadosLog);
        $this->session->sess_destroy();
        redirect();
    }

    public function esqueci_senha() {
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
            // faz upload da imagem
            $config['upload_path'] = './assets/img/profiles/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 10000;
            $config['max_width'] = 10000;
            $config['max_height'] = 10000;
            $config['encrypt_name'] = true;
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
                $dadosUsuario['nivel'] = 0;
                $dadosUsuario['ativo'] = 1;
                $dadosUsuario['tentaLogin'] = 0;
                if ($this->usuarios->insert($dadosUsuario)) {
                    $idUsuario = $this->usuarios->last()->id;
                    if ($this->input->post('categoria_1')) {
                        $this->cadastrar_interesses(1, 13, $idUsuario);
                    }
                    if ($this->input->post('categoria_2')) {
                        $this->cadastrar_interesses(14, 25, $idUsuario);
                    }
                    if ($this->input->post('categoria_3')) {
                        $this->cadastrar_interesses(26, 55, $idUsuario);
                    }
                    if ($this->input->post('categoria_4')) {
                        $this->cadastrar_interesses(56, 66, $idUsuario);
                    }
                    if ($this->input->post('categoria_5')) {
                        $this->cadastrar_interesses(67, 86, $idUsuario);
                    }
                    if ($this->input->post('categoria_6')) {
                        $this->cadastrar_interesses(87, 94, $idUsuario);
                    }
                    if ($this->input->post('categoria_7')) {
                        $this->cadastrar_interesses(95, 106, $idUsuario);
                    }
                    if ($this->input->post('categoria_8')) {
                        $this->cadastrar_interesses(107, 118, $idUsuario);
                    }
                    if ($this->input->post('categoria_9')) {
                        $this->cadastrar_interesses(119, 134, $idUsuario);
                    }
                    if ($this->input->post('categoria_10')) {
                        $this->cadastrar_interesses(135, 159, $idUsuario);
                    }
                    if ($this->input->post('categoria_11')) {
                        $this->cadastrar_interesses(160, 167, $idUsuario);
                    }
                    if ($this->input->post('categoria_12')) {
                        $this->cadastrar_interesses(168, 177, $idUsuario);
                    }
                    if ($this->input->post('categoria_13')) {
                        $this->cadastrar_interesses(178, 190, $idUsuario);
                    }
                    if ($this->input->post('categoria_14')) {
                        $this->cadastrar_interesses(191, 199, $idUsuario);
                    }
                    if ($this->input->post('categoria_15')) {
                        $this->cadastrar_interesses(200, 218, $idUsuario);
                    }
                    if ($this->input->post('categoria_16')) {
                        $this->cadastrar_interesses(219, 228, $idUsuario);
                    }
                    if ($this->input->post('categoria_17')) {
                        $this->cadastrar_interesses(229, 252, $idUsuario);
                    }
                    if ($this->input->post('categoria_18')) {
                        $this->cadastrar_interesses(253, 276, $idUsuario);
                    }
                    if ($this->input->post('categoria_19')) {
                        $this->cadastrar_interesses(277, 284, $idUsuario);
                    }
                    if ($this->input->post('categoria_20')) {
                        $this->cadastrar_interesses(285, 290, $idUsuario);
                    }
                    if ($this->input->post('categoria_21')) {
                        $this->cadastrar_interesses(291, 299, $idUsuario);
                    }
                    if ($this->input->post('categoria_22')) {
                        $this->cadastrar_interesses(300, 322, $idUsuario);
                    }
                    if ($this->input->post('categoria_23')) {
                        $this->cadastrar_interesses(323, 340, $idUsuario);
                    }
                    if ($this->input->post('categoria_24')) {
                        $this->cadastrar_interesses(341, 348, $idUsuario);
                    }
                    if ($this->input->post('categoria_25')) {
                        $this->cadastrar_interesses(349, 358, $idUsuario);
                    }
                    if ($this->input->post('categoria_26')) {
                        $this->cadastrar_interesses(359, 364, $idUsuario);
                    }
                    if ($this->input->post('categoria_27')) {
                        $this->cadastrar_interesses(365, 374, $idUsuario);
                    }
                    if ($this->input->post('categoria_28')) {
                        $this->cadastrar_interesses(376, 376, $idUsuario);
                    }
                    if ($this->input->post('categoria_29')) {
                        $this->cadastrar_interesses(377, 377, $idUsuario);
                    }
                    if ($this->input->post('categoria_30')) {
                        $this->cadastrar_interesses(378, 378, $idUsuario);
                    }
                    $mensagem = "Confirme seu cadastro no e-mail <strong>" . $dadosUsuario['email'] . "</strong>.";
                    $tipo = 1;
                } else {
                    $mensagem = "Dados de usuário não foram cadastrados.";
                    $tipo = 0;
                }
            } else {
                $mensagem = "Imagem não foi enviada.";
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

    public function cadastrar_interesses($inicio, $fim, $idUsuario) {
        $this->load->model('interesses_model', 'interesses');
        $i = 0;
        for ($i = $inicio; $i <= $fim; $i++) {
            $insere['idUsuario'] = $idUsuario;
            $insere['idCategoria'] = $i;
            $insere['peso'] = 0;
            $insere['data'] = date("y-m-d");
            $this->interesses->insert($insere, $idUsuario, $i);
        }
    }

    public function sobre() {
        if ($this->session->has_userdata('idEvento')) {
            $this->session->unset_userdata('idEvento');
        }
        $this->load->view('include/head');
        if ($this->session->logado == true) {
            $this->load->view('include/header_user');
        } else {
            $this->load->view('include/header_ext');
        }
        $this->load->view('sobre');
        $this->load->view('include/footer');
    }

    public function novidades() {
        if ($this->session->has_userdata('idEvento')) {
            $this->session->unset_userdata('idEvento');
        }
        $this->load->view('include/head');
        if ($this->session->logado == true) {
            $this->load->view('include/header_user');
        } else {
            $this->load->view('include/header_ext');
        }
        $this->load->view('novidades');
        $this->load->view('include/footer');
    }

    public function quemsomos() {
        if ($this->session->has_userdata('idEvento')) {
            $this->session->unset_userdata('idEvento');
        }
        $this->load->view('include/head');
        if ($this->session->logado == true) {
            $this->load->view('include/header_user');
        } else {
            $this->load->view('include/header_ext');
        }
        $this->load->view('quemsomos');
        $this->load->view('include/footer');
    }

    public function contato() {
        if ($this->session->has_userdata('idEvento')) {
            $this->session->unset_userdata('idEvento');
        }
        $this->load->view('include/head');
        if ($this->session->logado == true) {
            $this->load->view('include/header_user');
        } else {
            $this->load->view('include/header_ext');
        }
        $this->load->view('contato');
        $this->load->view('include/footer');
    }

}
