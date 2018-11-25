<?php

class Usuarios_model extends CI_Model {

    public function select() {
        $this->db->order_by('id DESC');
        return $this->db->get('usuarios')->result(); // retorna vetor
    }

    public function last() {
        $this->db->order_by('id DESC');
        return $this->db->get('usuarios', 1)->row(); // retorna registro obtido        
    }

    public function findEndereco($idUsuario) {
        $this->db->select('u.*, e.cidade AS cidade, e.estado AS estado, e.logradouro AS logradouro');
        $this->db->select('e.numero AS numero, e.bairro AS bairro, e.cep AS cep, e.complemento AS complemento');
        $this->db->from('usuarios u');
        $this->db->join('enderecos e', 'u.idEndereco = e.id', 'inner');
        $this->db->where('u.id', $idUsuario);
        return $this->db->get()->row(); // retorna registro obtido
    }

    public function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('usuarios')->row(); // retorna registro obtido
    }

    public function findEmail($email) {
        $this->db->where('email', $email);
        return $this->db->get('usuarios')->row(); // retorna registro obtido
    }

    public function findNomeUsuario($nomeUsuario) {
        $this->db->where('nomeUsuario', $nomeUsuario);
        return $this->db->get('usuarios')->row(); // retorna registro obtido
    }

    public function findCpf($cpf) {
        $this->db->where('cpf', $cpf);
        return $this->db->get('usuarios')->row(); // retorna registro obtido
    }

    public function check($user, $senha) {
        $this->db->where('nomeUsuario', $user);
        $this->db->where('senha', $senha);
        $this->db->or_where('email', $user);
        $this->db->where('senha', $senha);
        return $this->db->get('usuarios')->row(); // retorna registro obtido
    }

    public function searchId($id) {
        $this->db->where('id', $id);
        $this->db->order_by('id');
        return $this->db->get('usuarios')->result(); // retorna vetor
    }

    public function searchNomeUsuario($nomeUsuario) {
        $this->db->like('nomeUsuario', $nomeUsuario);
        $this->db->order_by('nomeUsuario');
        return $this->db->get('usuarios')->result(); // retorna vetor
    }

    public function searchNome($nome) {
        $this->db->select('u.*, e.cidade AS cidade, e.estado AS estado');
        $this->db->from('usuarios u');
        $this->db->join('enderecos e', 'u.idEndereco = e.id', 'inner');
        $this->db->like('nome', $nome);
        $this->db->order_by('nome, sobrenome');
        return $this->db->get()->result(); // retorna vetor
    }

    public function searchEmail($email) {
        $this->db->like('email', $email);
        $this->db->order_by('email');
        return $this->db->get('usuarios')->result(); // retorna vetor
    }

    public function searchCPF($cpf) {
        $this->db->like('cpf', $cpf);
        $this->db->order_by('cpf');
        return $this->db->get('usuarios')->result(); // retorna vetor
    }

    public function ws($id) {
        $this->db->select('u.id AS id, u.nome AS nome');
        $this->db->from('usuarios u');
        $this->db->where('u.id', $id);
        return $this->db->get()->row(); // retorna registro obtido
    }

    public function graphGenero() {
        $this->db->select('genero, count(id) AS num');
        $this->db->where('ativo', 1);
        $this->db->group_by('genero');
        return $this->db->get('usuarios')->result();
    }
    
    public function relatorio() {
        $this->db->select('u.id AS id, u.dataNasc AS dataNasc, e.cidade AS cidade, e.estado AS estado, e.bairro AS bairro');
        $this->db->from('usuarios u');
        $this->db->join('enderecos e', 'u.idEndereco = e.id', 'inner');
        $this->db->where('u.ativo', 1);
        $this->db->order_by('e.estado, e.cidade, e.bairro, u.dataNasc DESC');
        return $this->db->get()->result();
    }

    public function insert($registro) {
        return $this->db->insert('usuarios', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('usuarios', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('usuarios', array('id' => $id));
    }

}
