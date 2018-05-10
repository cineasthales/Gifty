<?php

class TiposInteresses_Model extends CI_Model {

    public function select() {
        $this->db->order_by('id');
        return $this->db->get('tiposInteresses')->result(); // retorna vetor
    }

    public function selectByName() {
        $this->db->order_by('descricao');
        return $this->db->get('tiposInteresses')->result(); // retorna vetor
    }
    
    public function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('tiposInteresses')->row(); // retorna registro obtido
    }

    public function insert($registro) {
        return $this->db->insert('tiposInteresses', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('tiposInteresses', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('tiposInteresses', array('id' => $id));
    }

}
