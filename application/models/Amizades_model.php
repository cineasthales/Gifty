<?php

class Amizades_model extends CI_Model {

    public function select() {
        $this->db->select('a.*, u1.nome AS nome1, u1.sobrenome AS snome1, u2.nome AS nome2, u2.sobrenome AS snome2');
        $this->db->from('amizades a');
        $this->db->join('usuarios u1', 'a.idUsuario1 = u1.id', 'inner');
        $this->db->join('usuarios u2', 'a.idUsuario2 = u2.id', 'inner');
        $this->db->order_by('a.data DESC');
        return $this->db->get()->result(); // retorna vetor
    }

    // busca todos os amigos de um usuário
    public function findAll($id) {
        $this->db->where('idUsuario1', $id);
        $this->db->or_where('idUsuario2', $id);
        return $this->db->get('amizades')->result(); // retorna vetor
    }

    // busca amizade entre dois usuários específicos
    public function find($id1, $id2) {
        $this->db->select('a.*, u1.nome AS nome1, u1.sobrenome AS snome1, u2.nome AS nome2, u2.sobrenome AS snome2');
        $this->db->from('amizades a');
        $this->db->join('usuarios u1', 'a.idUsuario1 = u1.id', 'inner');
        $this->db->join('usuarios u2', 'a.idUsuario2 = u2.id', 'inner');
        $this->db->where('a.idUsuario1', $id1);
        $this->db->where('a.idUsuario2', $id2);
        $this->db->or_where('a.idUsuario1', $id2);
        $this->db->where('a.idUsuario2', $id1);
        return $this->db->get()->row(); // retorna registro obtido
    }

    public function searchUsuario($usuario) {
        $this->db->select('a.*, u1.nome AS nome1, u1.sobrenome AS snome1, u2.nome AS nome2, u2.sobrenome AS snome2');
        $this->db->from('amizades a');
        $this->db->join('usuarios u1', 'a.idUsuario1 = u1.id', 'inner');
        $this->db->join('usuarios u2', 'a.idUsuario2 = u2.id', 'inner');
        $this->db->like('u1.nome', $usuario);
        $this->db->or_like('u2.nome', $usuario);
        $this->db->order_by('data DESC');
        return $this->db->get()->result(); // retorna vetor
    }

    public function searchData($data) {
        $this->db->select('a.*, u1.nome AS nome1, u1.sobrenome AS snome1, u2.nome AS nome2, u2.sobrenome AS snome2');
        $this->db->from('amizades a');
        $this->db->join('usuarios u1', 'a.idUsuario1 = u1.id', 'inner');
        $this->db->join('usuarios u2', 'a.idUsuario2 = u2.id', 'inner');
        $this->db->like('a.data', $data);
        $this->db->order_by('data DESC');
        return $this->db->get()->result(); // retorna vetor
    }

    public function insert($registro) {
        return $this->db->insert('amizades', $registro);
    }

    public function update($registro, $idUsuario1, $idUsuario2) {
        return $this->db->update('amizades', $registro, array('idUsuario1' => $idUsuario1, 'idUsuario2' => $idUsuario2));
    }

    public function delete($idUsuario1, $idUsuario2) {
        return $this->db->delete('amizades', array('idUsuario1' => $idUsuario1, 'idUsuario2' => $idUsuario2));
    }

}
