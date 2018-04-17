<?php

class Telefones_Model extends CI_Model {

    public function select() {
        $sql = "SELECT * FROM telefones ORDER BY id";
        $query = $this->db->query($sql);
        return $query->result(); // retorna vetor
    }

    public function find($id) {
        $sql = "SELECT * FROM telefones WHERE id = $id";
        $query = $this->db->query($sql);
        return $query->row(); // retorna registro obtido
    }

    public function insert($registro) {
        return $this->db->insert('telefones', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('telefones', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('telefones', array('id' => $id));
    }

}
