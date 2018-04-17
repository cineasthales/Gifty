<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
	public function index()
	{
            $this->load->view('include/header_ext');
            $this->load->view('inicio');
            $this->load->view('include/footer');
	}
        
        public function cadastrar()
	{
            $this->load->view('include/header_ext');
            $this->load->view('cadastro');
            $this->load->view('include/footer');
	}
}
