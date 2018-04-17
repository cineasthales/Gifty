<?php

class TiposInteresses_Model extends CI_Model {

    public function select() {
        $sql = "SELECT * FROM tiposInteresses ORDER BY id";
        $query = $this->db->query($sql);
        return $query->result(); // retorna vetor
    }

    public function find($id) {
        $sql = "SELECT * FROM tiposInteresses WHERE id = $id";
        $query = $this->db->query($sql);
        return $query->row(); // retorna registro obtido
    }

    public function insert($registro) {
        return $this->db->insert('tiposInteresses', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('tiposInteresses', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('tiposInteresses', array('id' => $id));
    }

}
