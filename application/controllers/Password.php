<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Password extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert">Anda harus login</div>');
            redirect('login');
        }
    }

    public function index()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('password', 'Password Lama', 'trim|required|callback_cek_password_lama', array('required' => 'Isi dulu %s',));
        $this->form_validation->set_rules('password_baru', 'Password Baru', 'trim|required', array('required' => 'Isi dulu %s',));
        $this->form_validation->set_rules('ulangi', 'Ulangi Password Baru', 'trim|required|matches[password_baru]', array('required' => 'Isi dulu %s', 'matches' => '%s tidak sama',));

        if ($this->form_validation->run() === FALSE) {
            if ($this->session->userdata('role') == 'User'){
                $this->load->view('user/password');
            }else{
                $this->load->view('password');
            }
        } else {
            $password_baru = $this->input->post('ulangi', TRUE);
            $params = array(
                'password' => password_hash($password_baru, PASSWORD_DEFAULT),
            );
            $this->load->model('pengguna_model');
            $this->pengguna_model->update_pengguna($this->session->userdata('id_pengguna'), $params);
            $this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">Password berhasil diubah</div>');
            redirect('password');
        }
    }

    public function cek_password_lama($password = '')
    {
        if ($password != '') {
            $this->load->model('pengguna_model');
            $query = $this->pengguna_model->get_pengguna($this->session->userdata('id_pengguna'));
            if ($query->num_rows() > 0) {
                $result = $query->row_array();
                if (password_verify($password, $result['password'])) {
                    return TRUE;
                } else {
                    $this->form_validation->set_message('cek_password_lama', '{field} anda salah');
                    return FALSE;
                }
            }
        }
    }
}


/* End of file Password.php */
/* Location: ./application/controllers/Password.php */