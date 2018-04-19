<?php

class CliquesAnuncios_Model extends CI_Model {

    public function select() {
        $this->db->order_by('id');
        return $this->db->get('cliquesAnuncios')->result(); // retorna vetor
    }

    public function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('cliquesAnuncios')->row(); // retorna registro obtido
    }

    public function insert($registro) {
        return $this->db->insert('cliquesAnuncios', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('cliquesAnuncios', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('cliquesAnuncios', array('id' => $id));
    }

}
