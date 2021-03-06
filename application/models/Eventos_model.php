<?php

class Eventos_model extends CI_Model {

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

    public function selectEvento($id) {
        $this->db->select('e.*, u.nome AS nome, u.sobrenome AS snome, u.imagem AS imagem, t.descricao AS tipo');
        $this->db->select('end.logradouro, end.numero, end.complemento, end.bairro, end.cep, end.cidade, end.estado');
        $this->db->from('eventos e');
        $this->db->join('usuarios u', 'e.idUsuario = u.id', 'inner');
        $this->db->join('tiposEventos t', 'e.idTipoEvento = t.id', 'inner');
        $this->db->join('enderecos end', 'e.idEndereco = end.id', 'inner');
        $this->db->where('e.id', $id);
        return $this->db->get('eventos')->row(); // retorna registro obtido
    }

    public function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('eventos')->row(); // retorna registro obtido
    }

    public function last() {
        $this->db->order_by('id DESC');
        return $this->db->get('eventos', 1)->row(); // retorna registro obtido        
    }

    public function notify($idUsuario) {
        $this->db->select('e.*, u.nome AS nome, u.sobrenome AS snome, l.data AS logData');
        $this->db->select('l.hora AS logHora, l.idAcaoEvento AS idAcaoEvento');
        $this->db->from('eventos e');
        $this->db->join('usuarios u', 'e.idUsuario = u.id', 'inner');
        $this->db->join('logEventos l', 'l.idEvento = e.id', 'inner');
        $this->db->join('convidados c', 'c.idEvento = e.id', 'inner');
        $this->db->where('c.idUsuario', $idUsuario);
        $this->db->order_by('l.data DESC, l.hora DESC');
        return $this->db->get()->result(); // retorna vetor
    }

    public function findIdUsuario($idUsuario) {
        $this->db->select('e.*, t.descricao AS tipo');
        $this->db->from('eventos e');
        $this->db->join('tiposEventos t', 'e.idTipoEvento = t.id', 'inner');
        $this->db->like('e.idUsuario', $idUsuario);
        $this->db->order_by('e.data DESC, e.hora DESC');
        return $this->db->get()->result(); // retorna vetor
    }

    public function findConvites($idConvidado) {
        $this->db->select('e.*, t.descricao AS tipo, c.idUsuario AS idConvidado');
        $this->db->select('c.comparecera AS comparecera, u.nome AS nome, u.sobrenome AS snome, u.imagem AS imagem');
        $this->db->from('eventos e');
        $this->db->join('tiposEventos t', 'e.idTipoEvento = t.id', 'inner');
        $this->db->join('usuarios u', 'e.idUsuario = u.id', 'inner');
        $this->db->join('convidados c', 'e.id = c.idEvento', 'inner');
        $this->db->where('c.idUsuario', $idConvidado);
        $this->db->where('e.ativo', 1);
        $this->db->order_by('e.data DESC, e.hora DESC');
        return $this->db->get()->result(); // retorna vetor
    }

    public function findIdUsuarioActive($idUsuario) {
        $this->db->select('e.*, t.descricao AS tipo');
        $this->db->from('eventos e');
        $this->db->join('tiposEventos t', 'e.idTipoEvento = t.id', 'inner');
        $this->db->where('e.ativo', 1);
        $this->db->like('e.idUsuario', $idUsuario);
        $this->db->order_by('e.data DESC, e.hora DESC');
        return $this->db->get()->result(); // retorna vetor
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

    public function ws($id) {
        $this->db->select('e.titulo AS titulo, e.data AS data, e.hora AS hora');
        $this->db->select('count(c.idUsuario) AS numConvites');
        $this->db->from('eventos e');
        $this->db->join('convidados c', 'c.idEvento = e.id', 'inner');
        $this->db->where('e.idUsuario', $id);
        $this->db->where('e.ativo', 1);
        $this->db->order_by('e.data DESC, e.hora DESC');
        return $this->db->get()->result(); // retorna vetor
    }

    public function graphTipoEvento() {
        $this->db->select('count(e.id) AS num, t.descricao AS tipo');
        $this->db->from('eventos e');
        $this->db->join('tiposEventos t', 'e.idTipoEvento = t.id', 'inner');
        $this->db->where('e.ativo', 1);
        $this->db->group_by('t.descricao');
        return $this->db->get()->result();
    }

    public function graphEstadoEvento() {
        $this->db->select('count(e.id) AS num, end.estado AS estado');
        $this->db->from('eventos e');
        $this->db->join('enderecos end', 'e.idEndereco = end.id', 'inner');
        $this->db->where('e.ativo', 1);
        $this->db->group_by('end.estado');
        return $this->db->get()->result();
    }

    public function relatorio() {
        $this->db->select('ev.id AS id, ev.local AS local, e.cidade AS cidade, e.estado AS estado');
        $this->db->from('eventos ev');
        $this->db->join('enderecos e', 'ev.idEndereco = e.id', 'inner');
        $this->db->order_by('e.estado, e.cidade, ev.local');
        return $this->db->get()->result();
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
