<?php

class Empresas_Model extends CI_Model {

    public function select() {
        $this->db->order_by('id');
        return $this->db->get('empresas')->result(); // retorna vetor
    }

    public function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('empresas')->row(); // retorna registro obtido
    }

    public function insert($registro) {
        return $this->db->insert('empresas', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('empresas', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('empresas', array('id' => $id));
    }

}
