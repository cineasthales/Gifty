<?php

class Convidados_Model extends CI_Model {

    public function select() {        
        $this->db->order_by('idEvento');
        return $this->db->get('convidados')->result(); // retorna vetor
    }

    public function find($idEvento, $idUsuario) {
        $this->db->where('idEvento', $idEvento);
        $this->db->where('idUsuario', $idUsuario);        
        return $this->db->get('convidados')->row(); // retorna registro obtido
    }

    public function insert($registro) {
        return $this->db->insert('convidados', $registro);
    }

    public function delete($id) {
        return $this->db->delete('convidados', array('id' => $id));
    }

}
