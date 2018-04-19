<?php

class Eventos_Model extends CI_Model {

    public function select() {
        $this->db->order_by('id');
        return $this->db->get('eventos')->result(); // retorna vetor
    }

    public function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('eventos')->row(); // retorna registro obtido
    }

    public function insert($registro) {
        return $this->db->insert('eventos', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('eventos', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('eventos', array('id' => $id));
    }

}
