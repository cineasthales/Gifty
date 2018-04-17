<?php

class TiposEventos_Model extends CI_Model {

    public function select() {
        $sql = "SELECT * FROM tiposEventos ORDER BY id";
        $query = $this->db->query($sql);
        return $query->result(); // retorna vetor
    }

    public function find($id) {
        $sql = "SELECT * FROM tiposEventos WHERE id = $id";
        $query = $this->db->query($sql);
        return $query->row(); // retoreventosna registro obtido
    }

    public function insert($registro) {
        return $this->db->insert('tiposEventos', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('tiposEventos', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('tiposEventos', array('id' => $id));
    }

}
