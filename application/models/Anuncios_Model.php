<?php

class Anuncios_Model extends CI_Model {

    public function select() {
        $this->db->select('a.*, e.nomeFantasia AS empresa');
        $this->db->from('anuncios a');
        $this->db->join('empresas e', 'a.idEmpresa = e.id', 'inner');
        $this->db->order_by('id DESC');
        return $this->db->get()->result(); // retorna vetor
    }

    public function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('anuncios')->row(); // retorna registro obtido
    }

    public function searchId($id) {
        $this->db->select('a.*, e.nomeFantasia AS empresa');
        $this->db->from('anuncios a');
        $this->db->join('empresas e', 'a.idEmpresa = e.id', 'inner');
        $this->db->where('a.id', $id);
        $this->db->order_by('a.id');
        return $this->db->get()->result(); // retorna vetor
    }

    public function searchEmpresa($empresa) {
        $this->db->select('a.*, e.nomeFantasia AS empresa');
        $this->db->from('anuncios a');
        $this->db->join('empresas e', 'a.idEmpresa = e.id', 'inner');
        $this->db->like('e.nomeFantasia', $empresa);
        $this->db->order_by('e.nomeFantasia');
        return $this->db->get()->result(); // retorna vetor
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
