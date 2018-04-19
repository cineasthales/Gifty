<?php

class Amizades_Model extends CI_Model {

    // busca todos os amigos de um usuário
    public function findAll($id) {        
        $this->db->where('idUsuario1', $id);
        $this->db->where('idUsuario2', $id);
        return $this->db->get('amizades')->result(); // retorna vetor
    }

    // busca amizade entre dois usuários específicos
    public function find($id1, $id2) {
        $this->db->where('idUsuario1', $id1);
        $this->db->where('idUsuario2', $id2);
        $this->db->or_where('idUsuario1', $id2);
        $this->db->where('idUsuario2', $id1);
        return $this->db->get('amizades')->row(); // retorna registro obtido
    }

    public function insert($registro) {
        return $this->db->insert('amizades', $registro);
    }

    public function delete($id) {
        return $this->db->delete('amizades', array('id' => $id));
    }

}
