<?php

class Itens_Model extends CI_Model {

    public function select() {
        $sql = "SELECT * FROM itens ORDER BY id";
        $query = $this->db->query($sql);
        return $query->result(); // retorna vetor
    }

    public function find($id) {
        $sql = "SELECT * FROM itens WHERE id = $id";
        $query = $this->db->query($sql);
        return $query->row(); // retorna registro obtido
    }

    public function insert($registro) {
        return $this->db->insert('itens', $registro);
    }
    
    public function update($registro, $id) {
        return $this->db->update('itens', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('itens', array('id' => $id));
    }

}
