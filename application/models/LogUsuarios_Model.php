<?php

class LogUsuarios_Model extends CI_Model {

    public function select() {
        $this->db->select('l.*, u.nome AS nome, u.sobrenome AS snome, a.descricao AS acao');
        $this->db->from('logUsuarios l');
        $this->db->join('usuarios u', 'l.idUsuario = u.id', 'inner');
        $this->db->join('acoesUsuarios a', 'l.idAcaoUsuario = a.id', 'inner');
        $this->db->order_by('id DESC');
        return $this->db->get()->result(); // retorna vetor
    }

    public function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('logUsuarios')->row(); // retorna registro obtido
    }

    public function searchId($id) {
        $this->db->where('id', $id);
        $this->db->order_by('id');
        return $this->db->get('logUsuarios')->result(); // retorna vetor
    }

    public function searchUsuario($usuario) {
        $this->db->select('l.*, u.nome AS nome, u.sobrenome AS snome, a.descricao AS acao');
        $this->db->from('logUsuarios l');
        $this->db->join('usuarios u', 'l.idUsuario = u.id', 'inner');
        $this->db->join('acoesUsuarios a', 'l.idAcaoUsuario = a.id', 'inner');
        $this->db->like('u.nome', $usuario);
        $this->db->order_by('u.nome, u.sobrenome, l.data DESC, l.hora DESC');
        return $this->db->get()->result(); // retorna vetor
    }

    public function insert($registro) {
        return $this->db->insert('logUsuarios', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('logUsuarios', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('logUsuarios', array('id' => $id));
    }

}
