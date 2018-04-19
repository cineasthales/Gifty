<?php

class Listas_Model extends CI_Model {

    public function select() {        
        $this->db->order_by('idEvento');
        return $this->db->get('listas')->result(); // retorna vetor
    }

    public function find($idEvento, $idItem) {
        $this->db->where('idEvento', $idEvento);
        $this->db->where('idItem', $idItem);        
        return $this->db->get('listas')->row(); // retorna registro obtido
    }

    public function insert($registro) {
        return $this->db->insert('listas', $registro);
    }

    public function delete($id) {
        return $this->db->delete('listas', array('id' => $id));
    }

}
