<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

    public function index() {
        if ($this->session->logado == true) {
            if ($this->session->has_userdata('idEvento')) {
                $this->session->unset_userdata('idEvento');
            }
            // carrega anuncio
            $this->load->model('anuncios_model', 'anuncios');
            $dados['anuncio'] = $this->anuncios->find(1);
            // carrega views com anuncio
            $this->load->view('include/head');
            $this->load->view('include/header_user');         
            $this->load->view('user/inicio');
            $this->load->view('include/footer_ad', $dados);
        } else {
            redirect();
        }
    }

    public function cliqueanuncio($idAnuncio) {
        // dados para registrar clique no anúncio
        $dados['idAnuncio'] = $idAnuncio;
        $dados['idUsuario'] = $this->session->id;
        $dados['data'] = date("y-m-d");
        $dados['hora'] = date("h:i:s");
        $this->load->model('cliquesanuncios_model', 'cliquesanuncios');
        $this->cliquesanuncios->insert($dados);
        // busca categoria do anúncio
        $this->load->model('anuncios_model', 'anuncios');
        $idCategoria = $this->anuncios->find($idAnuncio)->idCategoria;
        // verifica se usuário tem interesse na categoria do anúncio
        $this->load->model('interesses_model', 'interesses');
        $interesse = $this->interesses->find($this->session->id, $idCategoria);
        // se tiver, atualiza o peso; se não tiver, cria interesse com peso 1
        if ($interesse != NULL) {
            if ($interesse->peso < 5) {
                $interesse->peso++;
            }
            $interesse->data = date("y-m-d");
            $this->interesses->update($interesse, $this->session->id, $idCategoria);
        } else {
            $insere['idUsuario'] = $this->session->id;
            $insere['idCategoria'] = $idCategoria;
            $insere['peso'] = 1;
            $insere['data'] = date("y-m-d");
            $this->interesses->insert($insere);
        }
        redirect();
    }

}
