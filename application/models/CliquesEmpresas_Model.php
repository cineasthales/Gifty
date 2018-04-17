<?php

class CliquesEmpresas_Model extends CI_Model {

    public function select() {
        $sql = "SELECT * FROM cliquesEmpresas ORDER BY id";
        $query = $this->db->query($sql);
        return $query->result(); // retorna vetor
    }

    public function find($id) {
        $sql = "SELECT * FROM cliquesEmpresas WHERE id = $id";
        $query = $this->db->query($sql);
        return $query->row(); // retorna registro obtido
    }

    public function insert($registro) {
        return $this->db->insert('cliquesEmpresas', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('cliquesEmpresas', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('cliquesEmpresas', array('id' => $id));
    }

}
