<?php

class Enderecos_Model extends CI_Model {

    public function select() {
        $this->db->order_by('id');
        return $this->db->get('enderecos')->result(); // retorna vetor
    }

    public function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('enderecos')->row(); // retorna registro obtido
    }
    
    public function insert($registro) {
        return $this->db->insert('enderecos', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('enderecos', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('enderecos', array('id' => $id));
    }

}
