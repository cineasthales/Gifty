<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
    
	public function index()
	{
            $this->load->model('usuarios_model', 'usuarios');            
            // $dados['usuario'] = $this->usuarios->find($this->session->userdata('id'));
            $dados['usuario'] = $this->usuarios->find(1);   
            $this->load->view('include/header');
            $this->load->view('session/perfil', $dados);
            $this->load->view('include/footer');
	}
        
}
