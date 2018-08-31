<?php

class Telefones_model extends CI_Model {

    public function select() {
        $this->db->order_by('id DESC');
        return $this->db->get('telefones')->result(); // retorna vetor
    }

    public function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('telefones')->row(); // retorna registro obtido
    }

    public function findUsuario($idUsuario) {
        $this->db->where('idUsuario', $idUsuario);
        $this->db->order_by('id');
        return $this->db->get('telefones')->result(); // retorna vetor
    }

    public function searchId($id) {
        $this->db->where('id', $id);
        $this->db->order_by('id');
        return $this->db->get('telefones')->result(); // retorna vetor
    }

    public function searchDDD($ddd) {
        $this->db->like('ddd', $ddd);
        $this->db->order_by('ddd');
        return $this->db->get('telefones')->result(); // retorna vetor
    }

    public function searchNumero($numero) {
        $this->db->like('numero', $numero);
        $this->db->order_by('numero');
        return $this->db->get('telefones')->result(); // retorna vetor
    }

    public function insert($registro) {
        return $this->db->insert('telefones', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('telefones', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('telefones', array('id' => $id));
    }

}
