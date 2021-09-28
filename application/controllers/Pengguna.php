<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pengguna extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert">Anda harus login</div>');
            redirect('login');
        }
        $allowed = array('Admin');
        if (!in_array($this->session->userdata('role'), $allowed)) {
            redirect('home');
        }
        $this->load->model('pengguna_model');
    }

    public function index()
    {
        $data['pengguna'] = $this->pengguna_model->get_all_pengguna()->result();
        $this->load->view('pengguna/index', $data);
    }

    public function tambah()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

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

            $this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan</div>');
            redirect('pengguna/tambah');
        } else {
            $this->load->view('pengguna/tambah');
        }
    }

    public function ubah($id_pengguna = '')
    {
        $data['pengguna'] = $this->pengguna_model->get_pengguna($id_pengguna)->row();

        if (empty($data['pengguna'])) {
            show_404();
        } else {
            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required|callback_cek_unik_username');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('role', 'Role', 'required');

            $this->form_validation->set_message('required', 'Isi dulu %s');

            if ($this->form_validation->run()) {
                $params = array(
                    'nama_lengkap' => $this->input->post('nama_lengkap', TRUE),
                    'username' => $this->input->post('username', TRUE),
                    'email' => $this->input->post('email', TRUE),
                    'password' => password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT),
                    'role' => $this->input->post('role', TRUE),
                );
                $this->pengguna_model->update_pengguna($id_pengguna, $params);

                $this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">Data berhasil diubah</div>');
                redirect('pengguna/ubah/' . $id_pengguna);
            } else {
                $this->load->view('pengguna/ubah', $data);
            }
        }
    }

    public function hapus($id_pengguna = '')
    {
        $pengguna = $this->pengguna_model->get_pengguna($id_pengguna);

        if ($pengguna->num_rows() > 0) {
            $this->pengguna_model->delete_pengguna($id_pengguna);
            redirect('pengguna');
        } else {
            show_404();
        }
    }

    public function cek_unik_username($username)
    {
        $query = $this->pengguna_model->cek_unik_username($username, $this->input->post('username_tmp'));
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('cek_unik_username', '{field} sudah digunakan');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}


/* End of file Pengguna.php */
/* Location: ./application/controllers/Pengguna.php */