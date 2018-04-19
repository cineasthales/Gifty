<?php

class TiposEventos_Model extends CI_Model {

    public function select() {
        $this->db->order_by('id');
        return $this->db->get('tiposEventos')->result(); // retorna vetor
    }

    public function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('tiposEventos')->row(); // retorna registro obtido
    }

    public function insert($registro) {
        return $this->db->insert('tiposEventos', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('tiposEventos', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('tiposEventos', array('id' => $id));
    }

}
