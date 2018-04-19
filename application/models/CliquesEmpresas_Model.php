<?php

class CliquesEmpresas_Model extends CI_Model {

    public function select() {
        $this->db->order_by('id');
        return $this->db->get('cliquesEmpresas')->result(); // retorna vetor
    }

    public function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('cliquesEmpresas')->row(); // retorna registro obtido
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
