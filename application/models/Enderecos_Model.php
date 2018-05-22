<?php

class Enderecos_Model extends CI_Model {

    public function select() {
        $this->db->order_by('id');
        return $this->db->get('enderecos')->result(); // retorna vetor
    }

    public function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('enderecos')->row(); // retorna registro obtido
    }

    public function last() {
        $this->db->order_by('id DESC');
        return $this->db->get('enderecos', 1)->row(); // retorna registro obtido        
    }

    public function searchId($id) {
        $this->db->where('id', $id);
        $this->db->order_by('id');
        return $this->db->get('enderecos')->result(); // retorna vetor
    }

    public function searchLogradouro($logradouro) {
        $this->db->like('logradouro', $logradouro);
        $this->db->order_by('logradouro');
        return $this->db->get('enderecos')->result(); // retorna vetor
    }

    public function searchBairro($bairro) {
        $this->db->like('bairro', $bairro);
        $this->db->order_by('bairro');
        return $this->db->get('enderecos')->result(); // retorna vetor
    }

    public function searchCidade($cidade) {
        $this->db->like('cidade', $cidade);
        $this->db->order_by('cidade');
        return $this->db->get('enderecos')->result(); // retorna vetor
    }

    public function searchEstado($estado) {
        $this->db->like('estado', $estado);
        $this->db->order_by('estado');
        return $this->db->get('enderecos')->result(); // retorna vetor
    }

    public function insert($registro) {
        return $this->db->insert('enderecos', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('enderecos', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('enderecos', array('id' => $id));
    }

}
