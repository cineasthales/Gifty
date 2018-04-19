<?php

class LogUsuarios_Model extends CI_Model {

    public function select() {
        $this->db->order_by('id');
        return $this->db->get('logUsuarios')->result(); // retorna vetor
    }

    public function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('logUsuarios')->row(); // retorna registro obtido
    }

    public function insert($registro) {
        return $this->db->insert('logUsuarios', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('logUsuarios', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('logUsuarios', array('id' => $id));
    }

}
