<?php

class Logeventos_model extends CI_Model {

    public function select() {
        $this->db->select('l.*, e.titulo AS evento, a.descricao AS acao');
        $this->db->from('logEventos l');
        $this->db->join('eventos e', 'l.idEvento = e.id', 'inner');
        $this->db->join('acoesEventos a', 'l.idAcaoEvento = a.id', 'inner');
        $this->db->order_by('id DESC');
        return $this->db->get()->result(); // retorna vetor
    }

    public function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('logEventos')->row(); // retorna registro obtido
    }

    public function searchId($id) {
        $this->db->select('l.*, e.titulo AS evento, a.descricao AS acao');
        $this->db->from('logEventos l');
        $this->db->join('eventos e', 'l.idEvento = e.id', 'inner');
        $this->db->join('acoesEventos a', 'l.idAcaoEvento = a.id', 'inner');
        $this->db->where('l.id', $id);
        $this->db->order_by('l.id DESC');
        return $this->db->get()->result(); // retorna vetor
    }

    public function searchEvento($evento) {
        $this->db->select('l.*, e.titulo AS evento, a.descricao AS acao');
        $this->db->from('logEventos l');
        $this->db->join('eventos e', 'l.idEvento = e.id', 'inner');
        $this->db->join('acoesEventos a', 'l.idAcaoEvento = a.id', 'inner');
        $this->db->like('e.titulo', $evento);
        $this->db->order_by('e.titulo, l.data DESC, l.hora DESC');
        return $this->db->get()->result(); // retorna vetor
    }

    public function insert($registro) {
        return $this->db->insert('logEventos', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('logEventos', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('logEventos', array('id' => $id));
    }

}
