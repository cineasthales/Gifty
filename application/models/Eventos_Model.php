<?php

class Eventos_Model extends CI_Model {

    public function select() {
        $this->db->select('e.*, u.nome AS nome, u.sobrenome AS snome, t.descricao AS tipo');
        $this->db->select('end.logradouro, end.numero, end.complemento, end.bairro, end.cep, end.cidade, end.estado');
        $this->db->from('eventos e');
        $this->db->join('usuarios u', 'e.idUsuario = u.id', 'inner');
        $this->db->join('tiposEventos t', 'e.idTipoEvento = t.id', 'inner');
        $this->db->join('enderecos end', 'e.idEndereco = end.id', 'inner');
        $this->db->order_by('e.id DESC');
        return $this->db->get()->result(); // retorna vetor
    }

    public function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('eventos')->row(); // retorna registro obtido
    }

    public function searchId($id) {
        $this->db->select('e.*, u.nome AS nome, u.sobrenome AS snome, t.descricao AS tipo');
        $this->db->select('end.logradouro, end.numero, end.complemento, end.bairro, end.cep, end.cidade, end.estado');
        $this->db->from('eventos e');
        $this->db->join('usuarios u', 'e.idUsuario = u.id', 'inner');
        $this->db->join('tiposEventos t', 'e.idTipoEvento = t.id', 'inner');
        $this->db->join('enderecos end', 'e.idEndereco = end.id', 'inner');
        $this->db->where('e.id', $id);
        $this->db->order_by('e.id');
        return $this->db->get()->result(); // retorna vetor
    }

    public function searchTitulo($titulo) {
        $this->db->select('e.*, u.nome AS nome, u.sobrenome AS snome, t.descricao AS tipo');
        $this->db->select('end.logradouro, end.numero, end.complemento, end.bairro, end.cep, end.cidade, end.estado');
        $this->db->from('eventos e');
        $this->db->join('usuarios u', 'e.idUsuario = u.id', 'inner');
        $this->db->join('tiposEventos t', 'e.idTipoEvento = t.id', 'inner');
        $this->db->join('enderecos end', 'e.idEndereco = end.id', 'inner');
        $this->db->like('e.titulo', $titulo);
        $this->db->order_by('e.titulo, e.data DESC');
        return $this->db->get()->result(); // retorna vetor
    }

    public function searchData($data) {
        $this->db->select('e.*, u.nome AS nome, u.sobrenome AS snome, t.descricao AS tipo');
        $this->db->select('end.logradouro, end.numero, end.complemento, end.bairro, end.cep, end.cidade, end.estado');
        $this->db->from('eventos e');
        $this->db->join('usuarios u', 'e.idUsuario = u.id', 'inner');
        $this->db->join('tiposEventos t', 'e.idTipoEvento = t.id', 'inner');
        $this->db->join('enderecos end', 'e.idEndereco = end.id', 'inner');
        $this->db->like('e.data', $data);
        $this->db->order_by('e.data DESC');
        return $this->db->get()->result(); // retorna vetor
    }

    public function searchLocal($local) {
        $this->db->select('e.*, u.nome AS nome, u.sobrenome AS snome, t.descricao AS tipo');
        $this->db->select('end.logradouro, end.numero, end.complemento, end.bairro, end.cep, end.cidade, end.estado');
        $this->db->from('eventos e');
        $this->db->join('usuarios u', 'e.idUsuario = u.id', 'inner');
        $this->db->join('tiposEventos t', 'e.idTipoEvento = t.id', 'inner');
        $this->db->join('enderecos end', 'e.idEndereco = end.id', 'inner');
        $this->db->like('e.local', $local);
        $this->db->order_by('e.local, e.data DESC');
        return $this->db->get()->result(); // retorna vetor
    }

    public function searchUsuario($usuario) {
        $this->db->select('e.*, u.nome AS nome, u.sobrenome AS snome, t.descricao AS tipo');
        $this->db->select('end.logradouro, end.numero, end.complemento, end.bairro, end.cep, end.cidade, end.estado');
        $this->db->from('eventos e');
        $this->db->join('usuarios u', 'e.idUsuario = u.id', 'inner');
        $this->db->join('tiposEventos t', 'e.idTipoEvento = t.id', 'inner');
        $this->db->join('enderecos end', 'e.idEndereco = end.id', 'inner');
        $this->db->like('u.nome', $usuario);
        $this->db->order_by('u.nome, u.sobrenome, e.data DESC');
        return $this->db->get()->result(); // retorna vetor
    }

    public function searchTipoEvento($tipoEvento) {
        $this->db->select('e.*, u.nome AS nome, u.sobrenome AS snome, t.descricao AS tipo');
        $this->db->select('end.logradouro, end.numero, end.complemento, end.bairro, end.cep, end.cidade, end.estado');
        $this->db->from('eventos e');
        $this->db->join('usuarios u', 'e.idUsuario = u.id', 'inner');
        $this->db->join('tiposEventos t', 'e.idTipoEvento = t.id', 'inner');
        $this->db->join('enderecos end', 'e.idEndereco = end.id', 'inner');
        $this->db->like('t.descricao', $tipoEvento);
        $this->db->order_by('t.descricao, e.data DESC');
        return $this->db->get()->result(); // retorna vetor
    }

    public function insert($registro) {
        return $this->db->insert('eventos', $registro);
    }

    public function update($registro, $id) {
        return $this->db->update('eventos', $registro, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('eventos', array('id' => $id));
    }

}
