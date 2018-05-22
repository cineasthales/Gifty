<?php

class AcoesUsuarios_Model extends CI_Model {

    public function select() {
        $this->db->order_by('id');
        return $this->db->get('acoesUsuarios')->result(); // retorna vetor
    }

    public function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('acoesUsuarios')->row(); // retorna registro obtido
    }

    public function searchId($id) {
        $this->db->where('id', $id);
        $this->db->order_by('id');
        return $this->db->get('acoesUsuarios')->result(); // retorna vetor
    }

    public function searchAcao($idAcaoUsuario) {
        $this->db->like('idAcaoUsuario', $idAcaoUsuario);
        $this->db->order_by('idAcaoUsuario');
        return $this->db->get('acoesUsuarios')->result(); // retorna vetor
    }

    public function insert($registro) {
        return $this->db->insert('acoesUsuarios', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('acoesUsuarios', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('acoesUsuarios', array('id' => $id));
    }

}
