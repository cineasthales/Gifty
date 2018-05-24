<?php

class CliquesAnuncios_Model extends CI_Model {

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
        $this->db->where('id', $id);
        $this->db->order_by('id');
        return $this->db->get('cliquesAnuncios')->result(); // retorna vetor
    }

    public function searchUsuario($idUsuario) {
        $this->db->like('idUsuario', $idUsuario);
        $this->db->order_by('idUsuario');
        return $this->db->get('cliquesAnuncios')->result(); // retorna vetor
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
