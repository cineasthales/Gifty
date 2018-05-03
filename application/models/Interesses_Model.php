<?php

class Interesses_Model extends CI_Model {

    public function select() {
        $this->db->select('i.*, t.descricao AS inter, u.nome AS nome, u.sobrenome AS snome');
        $this->db->from('interesses i');
        $this->db->join('tiposInteresses t', 'i.idTipoInteresse = t.id', 'inner');
        $this->db->join('usuarios u', 'i.idUsuario = u.id', 'inner');
        $this->db->order_by('idUsuario');
        return $this->db->get()->result(); // retorna vetor
    }

    public function find($idUsuario, $idTipoInteresse) {
        $this->db->where('idUsuario', $idUsuario);
        $this->db->where('idTipoInteresse', $idTipoInteresse);
        return $this->db->get('interesses')->row(); // retorna registro obtido
    }

    public function insert($registro) {
        return $this->db->insert('interesses', $registro);
    }

    public function delete($id) {
        return $this->db->delete('interesses', array('id' => $id));
    }

}
