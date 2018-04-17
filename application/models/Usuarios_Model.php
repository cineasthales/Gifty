<?php

class Usuarios_Model extends CI_Model {

    public function select() {
        $sql = "SELECT * FROM usuarios ORDER BY id";
        $query = $this->db->query($sql);
        return $query->result(); // retorna vetor
    }

    public function find($id) {
        $sql = "SELECT * FROM usuarios WHERE id = $id";
        $query = $this->db->query($sql);
        return $query->row(); // retorna registro obtido
    }

    public function findEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $query = $this->db->query($sql);
        $row = $query->row();
        return isset($row); // retorna true ou false
    }

    public function findNomeUsuario($nomeUsuario) {
        $sql = "SELECT * FROM usuarios WHERE nomeUsuario = '$nomeUsuario'";
        $query = $this->db->query($sql);
        $row = $query->row();
        return isset($row); // retorna true ou false
    }
    
    public function findCpf($cpf) {
        $sql = "SELECT * FROM usuarios WHERE cpf = '$cpf'";
        $query = $this->db->query($sql);
        $row = $query->row();
        return isset($row); // retorna true ou false
    }
    
    public function check($user, $senha) {
        $sql = "SELECT * FROM usuarios WHERE (email=? AND senha=? AND ativo=1) ";
        $sql .= "OR (nomeUsuario=? AND senha=? AND ativo=1)";
        $query = $this->db->query($sql, array($user, $senha, $user, $senha));
        $row = $query->row();
        return isset($row); // retorna true ou false
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
