<?php

class Usuarios_Model extends CI_Model {

    public function select() {
        $this->db->order_by('id');
        return $this->db->get('usuarios')->result(); // retorna vetor
    }

    public function last() {
        $this->db->order_by('id DESC');
        return $this->db->get('usuarios', 1)->row(); // retorna registro obtido        
    }

    public function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('usuarios')->row(); // retorna registro obtido
    }

    public function findEmail($email) {
        $this->db->where('nomeUsuario', $email);
        return $this->db->get('usuarios')->row(); // retorna registro obtido
    }

    public function findNomeUsuario($nomeUsuario) {
        $this->db->where('nomeUsuario', $nomeUsuario);
        return $this->db->get('usuarios')->row(); // retorna registro obtido
    }

    public function findCpf($cpf) {
        $this->db->where('nomeUsuario', $cpf);
        return $this->db->get('usuarios')->row(); // retorna registro obtido
    }

    public function check($user, $senha) {
        $this->db->where('nomeUsuario', $user);
        $this->db->where('senha', $senha);
        $this->db->where('ativo', 1);
        $this->db->or_where('email', $user);
        $this->db->where('senha', $senha);
        $this->db->where('ativo', 1);
        return $this->db->get('usuarios')->row(); // retorna registro obtido
    }

    public function searchId($id) {
        $this->db->where('id', $id);
        $this->db->where('nivel', 0);
        $this->db->order_by('id');
        return $this->db->get('usuarios')->result(); // retorna vetor
    }

    public function searchNomeUsuario($nomeUsuario) {
        $this->db->like('nomeUsuario', $nomeUsuario);
        $this->db->order_by('nomeUsuario');
        return $this->db->get('usuarios')->result(); // retorna vetor
    }

    public function searchNome($nome) {
        $this->db->like('nome', $nome);
        $this->db->order_by('nome, sobrenome');
        return $this->db->get('usuarios')->result(); // retorna vetor
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
