<?php

class Listas_Model extends CI_Model {

    public function select() {
        $this->db->select('l.*, i.nome AS item, e.titulo AS evento');
        $this->db->from('listas l');
        $this->db->join('itens i', 'l.idItem = i.id', 'inner');
        $this->db->join('eventos e', 'l.idEvento = e.id', 'inner');
        $this->db->order_by('idEvento DESC, prioridade');
        return $this->db->get()->result(); // retorna vetor
    }

    public function find($idEvento, $idItem) {
        $this->db->where('idEvento', $idEvento);
        $this->db->where('idItem', $idItem);
        return $this->db->get('listas')->row(); // retorna registro obtido
    }

    public function searchEvento($idEvento) {
        $this->db->like('idEvento', $idEvento);
        $this->db->order_by('idEvento');
        return $this->db->get('listas')->result(); // retorna vetor
    }

    public function searchItem($idItem) {
        $this->db->like('idItem', $idItem);
        $this->db->order_by('idItem');
        return $this->db->get('listas')->result(); // retorna vetor
    }

    public function insert($registro) {
        return $this->db->insert('listas', $registro);
    }

    public function delete($idEvento, $idItem) {
        return $this->db->delete('listas', array('idEvento' => $idEvento, 'idItem' => $idItem));
    }

}
