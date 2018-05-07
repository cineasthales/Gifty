<?php

class Anuncios_Model extends CI_Model {

    public function select() {
        $this->db->select('a.*, e.nomeFantasia AS empresa');
        $this->db->from('anuncios a');
        $this->db->join('empresas e', 'a.idEmpresa = e.id', 'inner');
        $this->db->order_by('id');
        return $this->db->get()->result(); // retorna vetor
    }
    public function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('anuncios')->row(); // retorna registro obtido
    }

    public function insert($registro) {
        return $this->db->insert('anuncios', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('anuncios', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('anuncios', array('id' => $id));
    }

}
