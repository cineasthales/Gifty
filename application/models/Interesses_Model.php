<?php

class Interesses_model extends CI_Model {

    public function select() {
        $this->db->select('i.*, c.descricao AS categoria, u.nome AS nome, u.sobrenome AS snome');
        $this->db->from('interesses i');
        $this->db->join('categorias c', 'i.idCategoria = c.id', 'inner');
        $this->db->join('usuarios u', 'i.idUsuario = u.id', 'inner');
        $this->db->order_by('idUsuario DESC');
        return $this->db->get()->result(); // retorna vetor
    }

    public function find($idUsuario, $idCategoria) {
        $this->db->select('i.*, c.descricao AS categoria, u.nome AS nome, u.sobrenome AS snome');
        $this->db->from('interesses i');
        $this->db->join('categorias c', 'i.idCategoria = c.id', 'inner');
        $this->db->join('usuarios u', 'i.idUsuario = u.id', 'inner');
        $this->db->where('idUsuario', $idUsuario);
        $this->db->where('idCategoria', $idCategoria);
        return $this->db->get()->row(); // retorna registro obtido
    }

    public function searchCategoria($categoria) {
        $this->db->select('i.*, c.descricao AS categoria, u.nome AS nome, u.sobrenome AS snome');
        $this->db->from('interesses i');
        $this->db->join('categorias c', 'i.idCategoria = c.id', 'inner');
        $this->db->join('usuarios u', 'i.idUsuario = u.id', 'inner');
        $this->db->like('c.descricao', $categoria);
        $this->db->order_by('c.descricao, u.nome, u.sobrenome');
        return $this->db->get()->result(); // retorna vetor
    }

    public function searchUsuario($usuario) {
        $this->db->select('i.*, c.descricao AS categoria, u.nome AS nome, u.sobrenome AS snome');
        $this->db->from('interesses i');
        $this->db->join('categorias c', 'i.idCategoria = c.id', 'inner');
        $this->db->join('usuarios u', 'i.idUsuario = u.id', 'inner');
        $this->db->like('u.nome', $usuario);
        $this->db->order_by('u.nome, u.sobrenome, c.descricao');
        return $this->db->get()->result(); // retorna vetor
    }

    public function insert($registro) {
        return $this->db->insert('interesses', $registro);
    }
    
    public function update($registro, $idUsuario, $idCategoria) {
        return $this->db->update('interesses', $registro, array('idUsuario' => $idUsuario, 'idCategoria' => $idCategoria));
    }

    public function delete($idUsuario, $idCategoria) {
        return $this->db->delete('interesses', array('idUsuario' => $idUsuario, 'idCategoria' => $idCategoria));
    }

}
