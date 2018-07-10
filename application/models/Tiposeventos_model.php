<?php

class Tiposeventos_model extends CI_Model {

    public function select() {
        $this->db->order_by('descricao');
        return $this->db->get('tiposEventos')->result(); // retorna vetor
    }

    public function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('tiposEventos')->row(); // retorna registro obtido
    }

    public function searchId($id) {
        $this->db->where('id', $id);
        $this->db->order_by('id');
        return $this->db->get('tiposEventos')->result(); // retorna vetor
    }

    public function searchDescricao($descricao) {
        $this->db->like('descricao', $descricao);
        $this->db->order_by('descricao');
        return $this->db->get('tiposEventos')->result(); // retorna vetor
    }

    public function insert($registro) {
        return $this->db->insert('tiposEventos', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('tiposEventos', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('tiposEventos', array('id' => $id));
    }

}
