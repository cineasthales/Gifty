<?php

class Convidados_Model extends CI_Model {

    public function select() {
        $sql = "SELECT * FROM convidados ORDER BY id";
        $query = $this->db->query($sql);
        return $query->result(); // retorna vetor
    }

    public function find($id) {
        $sql = "SELECT * FROM convidados WHERE id = $id";
        $query = $this->db->query($sql);
        return $query->row(); // retorna registro obtido
    }

    public function insert($registro) {
        return $this->db->insert('convidados', $registro);
    }

    public function delete($id) {
        return $this->db->delete('convidados', array('id' => $id));
    }

}
