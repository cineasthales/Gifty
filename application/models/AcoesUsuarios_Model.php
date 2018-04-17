<?php

class AcoesUsuarios_Model extends CI_Model {

    public function select() {
        $sql = "SELECT * FROM acoesUsuarios ORDER BY id";
        $query = $this->db->query($sql);
        return $query->result(); // retorna vetor
    }

    public function find($id) {
        $sql = "SELECT * FROM acoesUsuarios WHERE id = $id";
        $query = $this->db->query($sql);
        return $query->row(); // retorna registro obtido
    }

    public function insert($registro) {
        return $this->db->insert('acoesUsuarios', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('acoesUsuarios', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('acoesUsuarios', array('id' => $id));
    }

}
