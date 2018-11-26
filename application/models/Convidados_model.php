<?php

class Convidados_model extends CI_Model {

    public function select() {
        $this->db->select('c.*, u.nome AS nome, u.sobrenome AS snome, e.titulo AS evento, e.data AS data');
        $this->db->from('convidados c');
        $this->db->join('usuarios u', 'c.idUsuario = u.id', 'inner');
        $this->db->join('eventos e', 'c.idEvento = e.id', 'inner');
        $this->db->order_by('c.idEvento DESC');
        return $this->db->get()->result(); // retorna vetor
    }
    
    public function notifyEmail($idEvento) {
        $this->db->select('u.email AS email');
        $this->db->from('convidados c');
        $this->db->join('usuarios u', 'c.idUsuario = u.id', 'inner');
        $this->db->where('c.idEvento', $idEvento);
        $this->db->where('u.notificaEmail', 1);
        return $this->db->get()->result(); // retorna vetor
    }

    public function selectEvento($idEvento) {
        $this->db->select('c.*, u.nome AS nome, u.sobrenome AS snome, u.imagem AS imagem');
        $this->db->from('convidados c');
        $this->db->join('usuarios u', 'c.idUsuario = u.id', 'inner');
        $this->db->where('c.idEvento', $idEvento);
        $this->db->order_by('u.nome, u.sobrenome');
        return $this->db->get()->result(); // retorna vetor
    }

    public function selectEventoNaoBloq($idEvento) {
        $this->db->select('c.*, u.nome AS nome, u.sobrenome AS snome, u.imagem AS imagem');
        $this->db->from('convidados c');
        $this->db->join('usuarios u', 'c.idUsuario = u.id', 'inner');
        $this->db->where('c.idEvento', $idEvento);
        $this->db->where('c.bloqueado', 0);
        $this->db->order_by('u.nome, u.sobrenome');
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

    public function findIdUsuario($idUsuario) {
        $this->db->select('c.*, e.titulo AS evento, e.data AS data, e.hora AS hora, e.idUsuario AS idAnf');
        $this->db->from('convidados c');
        $this->db->join('eventos e', 'c.idEvento = e.id', 'inner');
        $this->db->like('c.idUsuario', $idUsuario);
        $this->db->order_by('e.data DESC, e.hora DESC');
        return $this->db->get()->result(); // retorna vetor
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
    
    public function ws($id) {
        $this->db->select('c.comparecera AS comparecera, e.titulo AS titulo, e.data AS data');
        $this->db->select('e.hora AS hora, e.dataLimite AS dataLimite');
        $this->db->from('convidados c');
        $this->db->join('eventos e', 'c.idEvento = e.id', 'inner');
        $this->db->where('c.idUsuario', $id);
        $this->db->where('e.ativo', 1);
        $this->db->where('c.bloqueado', 0);
        $this->db->order_by('e.data DESC, e.hora DESC');
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
