<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Listas extends CI_Controller {

    public function index() {
        if ($this->session->logado == true) {
            if ($this->session->has_userdata('idEvento')) {
                $this->session->unset_userdata('idEvento');
            }
            $this->load->model('eventos_model', 'eventos');
            $dados['eventos'] = $this->eventos->findIdUsuarioActive($this->session->id);
            $this->load->model('convidados_model', 'convidados');
            $dados['convidados'] = $this->convidados->findIdUsuario($this->session->id);
            $this->load->view('include/head');
            $this->load->view('include/header_user');
            $this->load->view('user/listas', $dados);
            $this->load->view('include/footer');
        } else {
            redirect();
        }
    }

    public function detalhes($idEvento) {
        if ($this->session->logado == true) {
            $this->load->model('eventos_model', 'eventos');
            $dados['evento'] = $this->eventos->selectEvento($idEvento);
            $this->load->model('convidados_model', 'convidados');
            $dados['convidados'] = $this->convidados->selectEvento($idEvento);
            $this->load->model('listas_model', 'listas');
            $dados['listas'] = $this->listas->selectEvento($idEvento);
            $this->load->view('include/head');
            $this->load->view('include/header_user');
            $this->load->view('user/detalhes', $dados);
            $this->load->view('include/footer');
        } else {
            redirect();
        }
    }

    public function ver($idEvento) {
        if ($this->session->logado == true) {
            $this->load->model('eventos_model', 'eventos');
            $dados['evento'] = $this->eventos->selectEvento($idEvento);
            $this->load->model('listas_model', 'listas');
            $dados['listas'] = $this->listas->selectEvento($idEvento);
            $this->load->view('include/head');
            $this->load->view('include/header_user');
            $this->load->view('user/detalhes_convidado', $dados);
            $this->load->view('include/footer');
        } else {
            redirect();
        }
    }

}
