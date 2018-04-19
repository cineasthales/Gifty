<?php

class Itens_Model extends CI_Model {

    public function select() {
        $this->db->order_by('id');
        return $this->db->get('itens')->result(); // retorna vetor
    }

    public function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('itens')->row(); // retorna registro obtido
    }

    public function insert($registro) {
        return $this->db->insert('itens', $registro);
    }
    
    public function update($registro, $id) {
        return $this->db->update('itens', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('itens', array('id' => $id));
    }

}
