<?php

class Listas_Model extends CI_Model {

    public function select() {
        $sql = "SELECT * FROM listas ORDER BY id";
        $query = $this->db->query($sql);
        return $query->result(); // retorna vetor
    }

    public function find($id) {
        $sql = "SELECT * FROM listas WHERE id = $id";
        $query = $this->db->query($sql);
        return $query->row(); // retorna registro obtido
    }

    public function insert($registro) {
        return $this->db->insert('listas', $registro);
    }

    public function delete($id) {
        return $this->db->delete('listas', array('id' => $id));
    }

}
