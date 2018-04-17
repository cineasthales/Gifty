<?php

class CliquesAnuncios_Model extends CI_Model {

    public function select() {
        $sql = "SELECT * FROM cliquesAnuncios ORDER BY id";
        $query = $this->db->query($sql);
        return $query->result(); // retorna vetor
    }

    public function find($id) {
        $sql = "SELECT * FROM cliquesAnuncios WHERE id = $id";
        $query = $this->db->query($sql);
        return $query->row(); // retorna registro obtido
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
