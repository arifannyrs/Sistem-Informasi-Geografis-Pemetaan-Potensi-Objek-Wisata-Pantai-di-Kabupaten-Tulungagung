<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        if ($this->session->userdata('role') == 'User'){
            $this->load->view('user/index');
        }else{
        $this->load->view('home');
        }
    }
}
