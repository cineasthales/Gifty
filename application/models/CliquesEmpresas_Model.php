<?php

class CliquesEmpresas_Model extends CI_Model {

    public function select() {
        $this->db->select('c.*, u.nome AS nome, u.sobrenome AS snome, e.nomeFantasia AS empresa');
        $this->db->from('cliquesEmpresas c');
        $this->db->join('usuarios u', 'c.idUsuario = u.id', 'inner');
        $this->db->join('empresas e', 'c.idEmpresa = e.id', 'inner');
        $this->db->order_by('id DESC');
        return $this->db->get()->result(); // retorna vetor
    }

    public function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('cliquesEmpresas')->row(); // retorna registro obtido
    }

    public function searchId($id) {
        $this->db->select('c.*, u.nome AS nome, u.sobrenome AS snome, e.nomeFantasia AS empresa');
        $this->db->from('cliquesEmpresas c');
        $this->db->join('usuarios u', 'c.idUsuario = u.id', 'inner');
        $this->db->join('empresas e', 'c.idEmpresa = e.id', 'inner');
        $this->db->where('c.id', $id);
        $this->db->order_by('c.id DESC');
        return $this->db->get()->result(); // retorna vetor
    }

    public function searchEmpresa($empresa) {
        $this->db->select('c.*, u.nome AS nome, u.sobrenome AS snome, e.nomeFantasia AS empresa');
        $this->db->from('cliquesEmpresas c');
        $this->db->join('usuarios u', 'c.idUsuario = u.id', 'inner');
        $this->db->join('empresas e', 'c.idEmpresa = e.id', 'inner');
        $this->db->like('e.nomeFantasia', $empresa);
        $this->db->order_by('e.nomeFantasia');
        return $this->db->get()->result(); // retorna vetor
    }

    public function searchUsuario($usuario) {
        $this->db->select('c.*, u.nome AS nome, u.sobrenome AS snome, e.nomeFantasia AS empresa');
        $this->db->from('cliquesEmpresas c');
        $this->db->join('usuarios u', 'c.idUsuario = u.id', 'inner');
        $this->db->join('empresas e', 'c.idEmpresa = e.id', 'inner');
        $this->db->like('u.nome', $usuario);
        $this->db->order_by('u.nome, u.sobrenome');
        return $this->db->get()->result(); // retorna vetor
    }

    public function insert($registro) {
        return $this->db->insert('cliquesEmpresas', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('cliquesEmpresas', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('cliquesEmpresas', array('id' => $id));
    }

}
