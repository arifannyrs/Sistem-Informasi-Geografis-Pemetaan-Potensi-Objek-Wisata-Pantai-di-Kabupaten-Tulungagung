<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{

    public function index()
    {
        $this->load->helper('form');
        $this->load->view('register');
    }

    public function proses_daftar()
    {
        $this->load->library('form_validation');
        $this->load->model('pengguna_model');

        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[login.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[login.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');

        $this->form_validation->set_message('required', 'Isi dulu %s');
        $this->form_validation->set_message('is_unique', '%s sudah digunakan');

        if ($this->form_validation->run()) {
            $params = array(
                'nama_lengkap' => $this->input->post('nama_lengkap', TRUE),
                'username' => $this->input->post('username', TRUE),
                'email' => $this->input->post('email', TRUE),
                'password' => password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT),
                'role' => $this->input->post('role', TRUE),
            );
            $this->pengguna_model->add_pengguna($params);

            $this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">Daftar berhasil silakan daftar!</div>');
            redirect('register');
        } else {
            $this->load->view('register');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

}


/* End of file Login.php */
/* Location: ./application/controllers/Login.php */