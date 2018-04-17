<?php

class LogUsuarios_Model extends CI_Model {

    public function select() {
        $sql = "SELECT * FROM logUsuarios ORDER BY id";
        $query = $this->db->query($sql);
        return $query->result(); // retorna vetor
    }

    public function find($id) {
        $sql = "SELECT * FROM logUsuarios WHERE id = $id";
        $query = $this->db->query($sql);
        return $query->row(); // retorna registro obtido
    }

    public function insert($registro) {
        return $this->db->insert('logUsuarios', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('logUsuarios', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('logUsuarios', array('id' => $id));
    }

}
