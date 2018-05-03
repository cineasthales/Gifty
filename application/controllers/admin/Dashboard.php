<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function index() {
        if ($this->session->logado_admin == true) {
            $this->load->view('include/aside');
            $this->load->view('include/head');
            $this->load->view('include/header_admin');
            $this->load->view('admin/dashboard');
            $this->load->view('include/footer_admin');
        } else {
            redirect();
        }
    }

    public function backup() {
        $this->load->dbutil();
        $backup = $this->dbutil->backup();
        //$this->load->helper('file');
        //write_file(base_url(), $backup);
        $this->load->helper('download');
        force_download(date("d-m-Y") . '.zip', $backup);
    }

}
