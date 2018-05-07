<?php

class LogUsuarios_Model extends CI_Model {

    public function select() {
        $this->db->select('l.*, u.nome AS nome, u.sobrenome AS snome, a.descricao AS acao');
        $this->db->from('logUsuarios l');
        $this->db->join('usuarios u', 'l.idUsuario = u.id', 'inner');
        $this->db->join('acoesUsuarios a', 'l.idAcaoUsuario = a.id', 'inner');
        $this->db->order_by('id');
        return $this->db->get()->result(); // retorna vetor
    }

    public function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('logUsuarios')->row(); // retorna registro obtido
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
