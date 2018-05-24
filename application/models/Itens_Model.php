<?php

class Itens_Model extends CI_Model {

    public function select() {
        $this->db->order_by('id DESC');
        return $this->db->get('itens')->result(); // retorna vetor
    }

    public function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('itens')->row(); // retorna registro obtido
    }

    public function searchId($id) {
        $this->db->where('id', $id);
        $this->db->order_by('id');
        return $this->db->get('itens')->result(); // retorna vetor
    }

    public function searchNome($nome) {
        $this->db->like('nome', $nome);
        $this->db->order_by('nome');
        return $this->db->get('itens')->result(); // retorna vetor
    }

    public function searchCategoria($categoria) {
        $this->db->like('categoria', $categoria);
        $this->db->order_by('categoria');
        return $this->db->get('itens')->result(); // retorna vetor
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
