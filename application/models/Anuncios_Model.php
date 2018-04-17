<?php

class Anuncios_Model extends CI_Model {

    public function select() {
        $sql = "SELECT * FROM anuncios ORDER BY id";
        $query = $this->db->query($sql);
        return $query->result(); // retorna vetor
    }

    public function find($id) {
        $sql = "SELECT * FROM anuncios WHERE id = $id";
        $query = $this->db->query($sql);
        return $query->row(); // retorna registro obtido
    }

    public function insert($registro) {
        return $this->db->insert('anuncios', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('anuncios', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('anuncios', array('id' => $id));
    }

}
