<?php

class Amizades_Model extends CI_Model {

    public function select() {
        $sql = "SELECT * FROM amizades ORDER BY id";
        $query = $this->db->query($sql);
        return $query->result(); // retorna vetor
    }

    public function find($id) {
        $sql = "SELECT * FROM amizades WHERE id = $id";
        $query = $this->db->query($sql);
        return $query->row(); // retorna registro obtido
    }

    public function insert($registro) {
        return $this->db->insert('amizades', $registro);
    }

    public function delete($id) {
        return $this->db->delete('amizades', array('id' => $id));
    }

}
