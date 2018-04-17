<?php

class Eventos_Model extends CI_Model {

    public function select() {
        $sql = "SELECT * FROM eventos ORDER BY id";
        $query = $this->db->query($sql);
        return $query->result(); // retorna vetor
    }

    public function find($id) {
        $sql = "SELECT * FROM eventos WHERE id = $id";
        $query = $this->db->query($sql);
        return $query->row(); // retoreventosna registro obtido
    }

    public function insert($registro) {
        return $this->db->insert('eventos', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('eventos', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('eventos', array('id' => $id));
    }

}
