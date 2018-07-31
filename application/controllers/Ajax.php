<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

    public function validaEmail() {
        $email = htmlspecialchars(trim($_GET["email"]));
        $this->load->model('Usuarios_model', 'usuarios');
        if ($this->usuarios->findEmail($email)) {
            echo '(e-mail já cadastrado)';
        }
    }

    public function validaNomeUsuario() {
        $nomeUsuario = htmlspecialchars(trim($_GET["nomeUsuario"]));
        $this->load->model('Usuarios_model', 'usuarios');
        if ($this->usuarios->findNomeUsuario($nomeUsuario)) {
            echo '(nome de usuário já cadastrado)';
        }
    }

    public function validaCpf() {
        $cpf = htmlspecialchars(trim($_GET["cpf"]));
        $this->load->model('Usuarios_model', 'usuarios');
        if ($this->usuarios->findCpf($cpf)) {
            echo '(cpf já cadastrado)';
        }
    }

//    public function validaSenha() {
//        $senha = htmlspecialchars(trim($_GET["senha"]));
//        $confirmarsenha = htmlspecialchars(trim($_GET["confirmarsenha"]));
//        if ($senha != $confirmarsenha) {
//            echo 'SENHAS: ' . $senha . ' e ' . $confirmarsenha . '(senhas não correspondem)';
//        }
//    }

}
