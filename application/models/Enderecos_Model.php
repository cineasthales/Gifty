<?php

class Enderecos_Model extends CI_Model {

    public function select() {
        $sql = "SELECT * FROM enderecos ORDER BY id";
        $query = $this->db->query($sql);
        return $query->result(); // retorna vetor
    }

    public function find($id) {
        $sql = "SELECT * FROM enderecos WHERE id = $id";
        $query = $this->db->query($sql);
        return $query->row(); // retorna registro obtido
    }
    
    public function insert($registro) {
        return $this->db->insert('enderecos', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('enderecos', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('enderecos', array('id' => $id));
    }

}
