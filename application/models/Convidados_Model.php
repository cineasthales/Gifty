<?php

class Convidados_Model extends CI_Model {

    public function select() {
        $this->db->select('c.*, u.nome AS nome, u.sobrenome AS snome, e.titulo AS evento, e.data AS data');
        $this->db->from('convidados c');
        $this->db->join('usuarios u', 'c.idUsuario = u.id', 'inner');
        $this->db->join('eventos e', 'c.idEvento = e.id', 'inner');
        $this->db->order_by('idEvento');
        return $this->db->get()->result(); // retorna vetor
    }

    public function find($idEvento, $idUsuario) {
        $this->db->where('idEvento', $idEvento);
        $this->db->where('idUsuario', $idUsuario);        
        return $this->db->get('convidados')->row(); // retorna registro obtido
    }

    public function insert($registro) {
        return $this->db->insert('convidados', $registro);
    }

    public function delete($idUsuario, $idEvento) {
        return $this->db->delete('convidados', array('idUsuario' => $idUsuario, 'idEvento' => $idEvento));
    }

}
