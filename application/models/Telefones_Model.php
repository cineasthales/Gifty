<?php

class Telefones_Model extends CI_Model {

    public function select() {
        $this->db->order_by('id');
        return $this->db->get('telefones')->result(); // retorna vetor
    }

    public function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('telefones')->row(); // retorna registro obtido
    }

    public function insert($registro) {
        return $this->db->insert('telefones', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('telefones', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('telefones', array('id' => $id));
    }

}
