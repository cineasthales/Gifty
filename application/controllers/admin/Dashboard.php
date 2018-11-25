<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function index() {
        $this->verificaSessao();
        $this->load->model('Usuarios_model', 'usuarios');
        $this->load->model('Eventos_model', 'eventos');
        $this->load->model('Anuncios_model', 'anuncios');
        $dados['usuarios'] = $this->usuarios->graphGenero();
        $dados['eventos'] = $this->eventos->graphTipoEvento();
        $dados['eventos2'] = $this->eventos->graphEstadoEvento();
        $dados['cliques'] = $this->anuncios->graphCliques();
        $this->load->view('include/head');
        $this->load->view('include/aside');
        $this->load->view('include/header_admin');
        $this->load->view('admin/dashboard', $dados);
        $this->load->view('include/footer_admin');
    }

    public function verificaSessao() {
        if (!$this->session->logado_admin) {
            redirect();
        }
    }

    public function backup() {
        $this->verificaSessao();
        $this->load->dbutil();
        $backup = $this->dbutil->backup();
        $this->load->helper('file');
        write_file(base_url(), $backup);
        $this->load->helper('download');
        force_download(date("d-m-Y_h-i") . '.zip', $backup);
    }

    public function relatorio_usuarios() {
        $this->load->library('Pdf');
        $this->load->model('Usuarios_model', 'usuarios');
        $this->load->model('Amizades_model', 'amizades');
        $dados = $this->usuarios->relatorio();
        foreach ($dados as $dado) {
            $dado->numAmigos = count($this->amizades->findAll($dado->id));
        }
        $this->pdf->setTitulo(utf8_decode('Relatório de Usuários Ativos por Região e por Idade - ' . date('d/m/Y')));
        $this->pdf->setColunas(array(
            'Estado' => 20,
            'Cidade' => 60,
            'Bairro' => 60,
            'Idade' => 20,
            'Quant Amigos' => 30
        ));
        $this->pdf->AliasNbPages();
        $this->pdf->AddPage();
        foreach ($dados as $linha) {
            $idade = floor(date('Y') - date_format(date_create($linha->dataNasc), 'Y'));
            $this->pdf->Cell(20, 8, $linha->estado);
            $this->pdf->Cell(60, 8, utf8_decode($linha->cidade));
            $this->pdf->Cell(60, 8, utf8_decode($linha->bairro));
            $this->pdf->Cell(20, 8, $idade);
            $this->pdf->Cell(30, 8, $linha->numAmigos, 0, 1);
        }
        $this->pdf->Output();
    }

    public function relatorio_eventos() {
        $this->load->library('Pdf');
        $this->load->model('Eventos_model', 'eventos');
        $this->load->model('Convidados_model', 'convites');
        $this->load->model('Listas_model', 'listas');
        $dados = $this->eventos->relatorio();
        foreach ($dados as $dado) {
            $dado->numConvites = count($this->convites->selectEvento($dado->id));
            $dado->numItens = count($this->listas->selectEvento($dado->id));
        }
        $this->pdf->setTitulo(utf8_decode('Relatório de Eventos por Local - ' . date('d/m/Y')));
        $this->pdf->setColunas(array(
            'Estado' => 20,
            'Cidade' => 60,
            'Local do Evento' => 60,
            'Quant Convites' => 30,
            'Quant Itens' => 30
        ));
        $this->pdf->AliasNbPages();
        $this->pdf->AddPage();
        foreach ($dados as $linha) {
            $this->pdf->Cell(20, 8, $linha->estado);
            $this->pdf->Cell(60, 8, utf8_decode($linha->cidade));
            $this->pdf->Cell(60, 8, utf8_decode($linha->local));
            $this->pdf->Cell(30, 8, $linha->numConvites);
            $this->pdf->Cell(30, 8, $linha->numItens, 0, 1);
        }
        $this->pdf->Output();
    }

    public function relatorio_categorias() {
        $this->load->library('Pdf');
        $this->load->model('Categorias_model', 'categorias');
        $this->load->model('Itens_model', 'itens');
        $this->load->model('Interesses_model', 'interesses');
        $dados = $this->categorias->select();
        foreach ($dados as $dado) {            
            $dado->numItens = count($this->itens->selectCategoria($dado->id));
            $dado->numInteresses = count($this->interesses->selectCategoria($dado->id));
        }
        $this->pdf->setTitulo(utf8_decode('Relatório de Categorias por Itens e por Interessados - ' . date('d/m/Y')));
        $this->pdf->setColunas(array(
            'Categoria' => 120,
            'Quant Itens' => 30,
            'Quant Interessados' => 30
        ));
        $this->pdf->AliasNbPages();
        $this->pdf->AddPage();
        foreach ($dados as $linha) {
            $this->pdf->Cell(120, 8, utf8_decode($linha->descricao));
            $this->pdf->Cell(30, 8, $linha->numItens);
            $this->pdf->Cell(30, 8, $linha->numInteresses, 0, 1);
        }
        $this->pdf->Output();
    }
    
    public function relatorio_cliques() {
        $this->load->library('Pdf');
        $this->load->model('Cliquesanuncios_model', 'cliques');
        $dados = $this->cliques->relatorio();
        $this->pdf->setTitulo(utf8_decode('Relatório de Cliques em Anúncios por Idade e por Gênero - ' . date('d/m/Y')));
        $this->pdf->setColunas(array(
            'URL' => 100,
            'Data' => 30,
            'Hora' => 20,
            'Idade' => 20,
            utf8_decode('Gênero') => 30
        ));
        $this->pdf->AliasNbPages();
        $this->pdf->AddPage();
        foreach ($dados as $linha) {
            $idade = floor(date('Y') - date_format(date_create($linha->dataNasc), 'Y'));
            $this->pdf->Cell(100, 8, utf8_decode($linha->url));
            $this->pdf->Cell(30, 8, date_format(date_create($linha->data), 'd/m/Y'));
            $this->pdf->Cell(20, 8, substr($linha->hora, 0, 5));
            $this->pdf->Cell(20, 8, $idade);
            $this->pdf->Cell(30, 8, $linha->genero, 0, 1);
        }
        $this->pdf->Output();
    }

}
