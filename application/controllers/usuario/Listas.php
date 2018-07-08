<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Listas extends CI_Controller {

    public function index() {
        if ($this->session->logado == true) {
            $this->load->view('include/head');
            $this->load->view('include/header_user');
            $this->load->view('user/listas');
            $this->load->view('include/footer_user');
        } else {
            redirect();
        }
    }

    public function criar_evento() {
        if ($this->session->logado == true) {
            $this->load->view('include/head');
            $this->load->view('include/header_user');
            $this->load->view('user/criar/evento');
            $this->load->view('include/footer_user');
        } else {
            redirect();
        }
    }

    public function criar_convidados() {
        if ($this->session->logado == true) {
            $this->load->view('include/head');
            $this->load->view('include/header_user');
            $this->load->view('user/criar/convidados');
            $this->load->view('include/footer_user');
        } else {
            redirect();
        }
    }

    public function criar_lista() {
        if ($this->session->logado == true) {
            $this->load->view('include/head');
            $this->load->view('include/header_user');
            $this->load->view('user/criar/lista');
            $this->load->view('include/footer_user');
        } else {
            redirect();
        }
    }

}
