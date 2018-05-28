<?php

class Empresas_Model extends CI_Model {

    public function select() {
        $this->db->order_by('id');
        return $this->db->get('empresas')->result(); // retorna vetor
    }

    public function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('empresas')->row(); // retorna registro obtido
    }

    public function searchId($id) {
        $this->db->where('id', $id);
        $this->db->order_by('id');
        return $this->db->get('empresas')->result(); // retorna vetor
    }

    public function searchNomeFantasia($nomeFantasia) {
        $this->db->like('nomeFantasia', $nomeFantasia);
        $this->db->order_by('nomeFantasia');
        return $this->db->get('empresas')->result(); // retorna vetor
    }

    public function searchRazaoSocial($razaoSocial) {
        $this->db->like('razaoSocial', $razaoSocial);
        $this->db->order_by('razaoSocial');
        return $this->db->get('empresas')->result(); // retorna vetor
    }

    public function searchCNPJ($cnpj) {
        $this->db->like('cnpj', $cnpj);
        $this->db->order_by('cnpj');
        return $this->db->get('empresas')->result(); // retorna vetor
    }

    public function insert($registro) {
        return $this->db->insert('empresas', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('empresas', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('empresas', array('id' => $id));
    }

}
