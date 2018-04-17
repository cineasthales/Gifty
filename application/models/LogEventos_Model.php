<?php

class LogEventos_Model extends CI_Model {

    public function select() {
        $sql = "SELECT * FROM logEventos ORDER BY id";
        $query = $this->db->query($sql);
        return $query->result(); // retorna vetor
    }

    public function find($id) {
        $sql = "SELECT * FROM logEventos WHERE id = $id";
        $query = $this->db->query($sql);
        return $query->row(); // retorna registro obtido
    }

    public function insert($registro) {
        return $this->db->insert('logEventos', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('logEventos', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('logEventos', array('id' => $id));
    }

}
