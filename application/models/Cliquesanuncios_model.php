<?php

class Cliquesanuncios_model extends CI_Model {

    public function select() {
        $this->db->select('c.*, u.nome AS nome, u.sobrenome AS snome, a.url AS url');
        $this->db->from('cliquesAnuncios c');
        $this->db->join('usuarios u', 'c.idUsuario = u.id', 'inner');
        $this->db->join('anuncios a', 'c.idAnuncio = a.id', 'inner');
        $this->db->order_by('id DESC');
        return $this->db->get()->result(); // retorna vetor
    }

    public function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('cliquesAnuncios')->row(); // retorna registro obtido
    }

    public function searchId($id) {
        $this->db->select('c.*, u.nome AS nome, u.sobrenome AS snome, a.url AS url');
        $this->db->from('cliquesAnuncios c');
        $this->db->join('usuarios u', 'c.idUsuario = u.id', 'inner');
        $this->db->join('anuncios a', 'c.idAnuncio = a.id', 'inner');
        $this->db->where('c.id', $id);
        $this->db->order_by('c.id DESC');
        return $this->db->get()->result(); // retorna vetor
    }

    public function searchUsuario($usuario) {
        $this->db->select('c.*, u.nome AS nome, u.sobrenome AS snome, a.url AS url');
        $this->db->from('cliquesAnuncios c');
        $this->db->join('usuarios u', 'c.idUsuario = u.id', 'inner');
        $this->db->join('anuncios a', 'c.idAnuncio = a.id', 'inner');
        $this->db->like('u.nome', $usuario);
        $this->db->order_by('u.nome, u.sobrenome');
        return $this->db->get()->result(); // retorna vetor
    }

    public function relatorio() {
        $this->db->select('c.idAnuncio AS idAnuncio, c.data AS data, c.hora AS hora');
        $this->db->select('u.dataNasc AS dataNasc, u.genero AS genero, a.url AS url');
        $this->db->from('cliquesAnuncios c');
        $this->db->join('usuarios u', 'c.idUsuario = u.id', 'inner');
        $this->db->join('anuncios a', 'c.idAnuncio = a.id', 'inner');
        $this->db->order_by('a.url, c.data DESC, c.hora DESC');
        return $this->db->get()->result();
    }

    public function insert($registro) {
        return $this->db->insert('cliquesAnuncios', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('cliquesAnuncios', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('cliquesAnuncios', array('id' => $id));
    }

}
