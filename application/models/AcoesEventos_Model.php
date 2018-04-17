<?php

class AcoesEventos_Model extends CI_Model {

    public function select() {
        $sql = "SELECT * FROM acoesEventos ORDER BY id";
        $query = $this->db->query($sql);
        return $query->result(); // retorna vetor
    }

    public function find($id) {
        $sql = "SELECT * FROM acoesEventos WHERE id = $id";
        $query = $this->db->query($sql);
        return $query->row(); // retorna registro obtido
    }

    public function insert($registro) {
        return $this->db->insert('acoesEventos', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('acoesEventos', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('acoesEventos', array('id' => $id));
    }

}
