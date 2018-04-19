<?php

class Usuarios_Model extends CI_Model {

    public function select() {
        $this->db->order_by('id');
        return $this->db->get('usuarios')->result(); // retorna vetor
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
