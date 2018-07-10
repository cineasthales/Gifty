<?php

class Listas_model extends CI_Model {

    public function select() {
        $this->db->select('l.*, i.nome AS item, e.titulo AS evento');
        $this->db->from('listas l');
        $this->db->join('itens i', 'l.idItem = i.id', 'inner');
        $this->db->join('eventos e', 'l.idEvento = e.id', 'inner');
        $this->db->order_by('l.idEvento DESC, l.prioridade');
        return $this->db->get()->result(); // retorna vetor
    }

    public function find($idEvento, $idItem) {
        $this->db->select('l.*, i.nome AS item, e.titulo AS evento');
        $this->db->from('listas l');
        $this->db->join('itens i', 'l.idItem = i.id', 'inner');
        $this->db->join('eventos e', 'l.idEvento = e.id', 'inner');
        $this->db->where('l.idEvento', $idEvento);
        $this->db->where('l.idItem', $idItem);
        return $this->db->get('listas')->row(); // retorna registro obtido
    }

    public function searchEvento($evento) {
        $this->db->select('l.*, i.nome AS item, e.titulo AS evento');
        $this->db->from('listas l');
        $this->db->join('itens i', 'l.idItem = i.id', 'inner');
        $this->db->join('eventos e', 'l.idEvento = e.id', 'inner');
        $this->db->like('e.titulo', $evento);
        $this->db->order_by('e.titulo, l.prioridade');
        return $this->db->get()->result(); // retorna vetor
    }

    public function searchItem($item) {
        $this->db->select('l.*, i.nome AS item, e.titulo AS evento');
        $this->db->from('listas l');
        $this->db->join('itens i', 'l.idItem = i.id', 'inner');
        $this->db->join('eventos e', 'l.idEvento = e.id', 'inner');
        $this->db->like('i.nome', $item);
        $this->db->order_by('i.nome, e.titulo, l.prioridade');
        return $this->db->get()->result(); // retorna vetor
    }

    public function insert($registro) {
        return $this->db->insert('listas', $registro);
    }

    public function update($registro, $idEvento, $idItem) {
        return $this->db->update('listas', $registro, array('idEvento' => $idEvento, 'idItem' => $idItem));
    }

    public function delete($idEvento, $idItem) {
        return $this->db->delete('listas', array('idEvento' => $idEvento, 'idItem' => $idItem));
    }

}