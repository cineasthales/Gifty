<?php

class Acoeseventos_model extends CI_Model {

    public function select() {
        $this->db->order_by('id');
        return $this->db->get('acoesEventos')->result(); // retorna vetor
    }

    public function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('acoesEventos')->row(); // retorna registro obtido
    }

    public function searchId($id) {
        $this->db->where('id', $id);
        $this->db->order_by('id');
        return $this->db->get('acoesEventos')->result(); // retorna vetor
    }

    public function searchDescricao($descricao) {
        $this->db->like('descricao', $descricao);
        $this->db->order_by('descricao');
        return $this->db->get('acoesEventos')->result(); // retorna vetor
    }

    public function insert($registro) {
        return $this->db->insert('acoesEventos', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('acoesEventos', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('acoesEventos', array('id' => $id));
    }

}
