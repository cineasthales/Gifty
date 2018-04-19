<?php

class Interesses_Model extends CI_Model {

    public function select() {        
        $this->db->order_by('idUsuario');
        return $this->db->get('interesses')->result(); // retorna vetor
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
