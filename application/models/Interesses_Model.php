<?php

class Interesses_Model extends CI_Model {

    public function select() {
        $sql = "SELECT * FROM interesses ORDER BY id";
        $query = $this->db->query($sql);
        return $query->result(); // retorna vetor
    }

    public function find($id) {
        $sql = "SELECT * FROM interesses WHERE id = $id";
        $query = $this->db->query($sql);
        return $query->row(); // retorna registro obtido
    }

    public function insert($registro) {
        return $this->db->insert('interesses', $registro);
    }

    public function delete($id) {
        return $this->db->delete('interesses', array('id' => $id));
    }

}
