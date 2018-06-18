<?php

class Convidados_Model extends CI_Model {

    public function select() {
        $this->db->select('c.*, u.nome AS nome, u.sobrenome AS snome, e.titulo AS evento, e.data AS data');
        $this->db->from('convidados c');
        $this->db->join('usuarios u', 'c.idUsuario = u.id', 'inner');
        $this->db->join('eventos e', 'c.idEvento = e.id', 'inner');
        $this->db->order_by('c.idEvento DESC');
        return $this->db->get()->result(); // retorna vetor
    }

    public function find($idUsuario, $idEvento) {
        $this->db->select('c.*, u.nome AS nome, u.sobrenome AS snome, e.titulo AS evento, e.data AS data');
        $this->db->from('convidados c');
        $this->db->join('usuarios u', 'c.idUsuario = u.id', 'inner');
        $this->db->join('eventos e', 'c.idEvento = e.id', 'inner');
        $this->db->where('c.idEvento', $idEvento);
        $this->db->where('c.idUsuario', $idUsuario);
        return $this->db->get('convidados')->row(); // retorna registro obtido
    }

    public function searchEvento($evento) {
        $this->db->select('c.*, u.nome AS nome, u.sobrenome AS snome, e.titulo AS evento, e.data AS data');
        $this->db->from('convidados c');
        $this->db->join('usuarios u', 'c.idUsuario = u.id', 'inner');
        $this->db->join('eventos e', 'c.idEvento = e.id', 'inner');
        $this->db->like('e.titulo', $evento);
        $this->db->order_by('e.titulo, e.data DESC');
        return $this->db->get()->result(); // retorna vetor
    }

    public function searchUsuario($usuario) {
        $this->db->select('c.*, u.nome AS nome, u.sobrenome AS snome, e.titulo AS evento, e.data AS data');
        $this->db->from('convidados c');
        $this->db->join('usuarios u', 'c.idUsuario = u.id', 'inner');
        $this->db->join('eventos e', 'c.idEvento = e.id', 'inner');
        $this->db->like('u.nome', $usuario);
        $this->db->order_by('u.nome, u.sobrenome, e.data DESC');
        return $this->db->get()->result(); // retorna vetor
    }

    public function insert($registro) {
        return $this->db->insert('convidados', $registro);
    }

    public function update($registro, $idUsuario, $idEvento) {
        return $this->db->update('convidados', $registro, array('idUsuario' => $idUsuario, 'idEvento' => $idEvento));
    }

    public function delete($idUsuario, $idEvento) {
        return $this->db->delete('convidados', array('idUsuario' => $idUsuario, 'idEvento' => $idEvento));
    }

}
