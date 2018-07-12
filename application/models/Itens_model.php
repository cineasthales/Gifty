<?php

class Itens_model extends CI_Model {

    public function select() {
        $this->db->select('i.*, c.descricao AS categoria');
        $this->db->from('itens i');
        $this->db->join('categorias c', 'i.idCategoria = c.id', 'inner');
        $this->db->order_by('i.id DESC');
        return $this->db->get()->result(); // retorna vetor
    }

    public function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('itens')->row(); // retorna registro obtido
    }

    public function last() {
        $this->db->order_by('id DESC');
        return $this->db->get('itens', 1)->row(); // retorna registro obtido        
    }

    public function searchId($id) {
        $this->db->select('i.*, c.descricao AS categoria');
        $this->db->from('itens i');
        $this->db->join('categorias c', 'i.idCategoria = c.id', 'inner');
        $this->db->where('i.id', $id);
        $this->db->order_by('i.id DESC');
        return $this->db->get()->result(); // retorna vetor
    }

    public function searchNome($nome) {
        $this->db->select('i.*, c.descricao AS categoria');
        $this->db->from('itens i');
        $this->db->join('categorias c', 'i.idCategoria = c.id', 'inner');
        $this->db->like('i.nome', $nome);
        $this->db->order_by('i.nome');
        return $this->db->get()->result(); // retorna vetor
    }

    public function searchCategoria($categoria) {
        $this->db->select('i.*, c.descricao AS categoria');
        $this->db->from('itens i');
        $this->db->join('categorias c', 'i.idCategoria = c.id', 'inner');
        $this->db->like('i.idCategoria', $categoria);
        $this->db->order_by('i.idCategoria');
        return $this->db->get()->result(); // retorna vetor
    }

    public function insert($registro) {
        return $this->db->insert('itens', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('itens', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('itens', array('id' => $id));
    }

}
