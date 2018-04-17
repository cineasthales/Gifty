<?php

class Empresas_Model extends CI_Model {

    public function select() {
        $sql = "SELECT * FROM empresas ORDER BY id";
        $query = $this->db->query($sql);
        return $query->result(); // retorna vetor
    }

    public function find($id) {
        $sql = "SELECT * FROM empresas WHERE id = $id";
        $query = $this->db->query($sql);
        return $query->row(); // retorna registro obtido
    }

    public function insert($registro) {
        return $this->db->insert('empresas', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('empresas', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('empresas', array('id' => $id));
    }

}
