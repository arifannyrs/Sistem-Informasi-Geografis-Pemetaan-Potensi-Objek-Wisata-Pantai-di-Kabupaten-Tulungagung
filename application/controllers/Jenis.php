<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Jenis extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert">Anda harus login</div>');
            redirect('login');
        }
        $allowed = array('Admin', 'Pegawai');
        if (!in_array($this->session->userdata('role'), $allowed)) {
            redirect('home');
        }
        $this->load->model('jenis_model');
    }

    public function index()
    {
        $data['jenis'] = $this->jenis_model->get_all_jenis()->result();
        $this->load->view('jenis/index', $data);
    }

    public function tambah()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('jenis_wisata', 'Jenis Wisata', 'required');

        $this->form_validation->set_message('required', 'Isi dulu %s');

        if ($this->form_validation->run()) {
            $params = array(
                'jenis_wisata' => $this->input->post('jenis_wisata', TRUE),
            );
            $this->jenis_model->add_jenis($params);

            $this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
            redirect('jenis/tambah');
        } else {
            $this->load->view('jenis/tambah');
        }
    }

    public function ubah($id_jenis = '')
    {
        $data['jenis'] = $this->jenis_model->get_jenis($id_jenis)->row();

        if (empty($data['jenis'])) {
            show_404();
        } else {
            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('jenis_wisata', 'Jenis Wisata', 'required');

            $this->form_validation->set_message('required', 'Isi dulu %s');

            if ($this->form_validation->run()) {
                $params = array(
                    'jenis_wisata' => $this->input->post('jenis_wisata', TRUE),
                );
                $this->jenis_model->update_jenis($id_jenis, $params);

                $this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
                redirect('jenis/ubah/' . $id_jenis);
            } else {
                $this->load->view('jenis/ubah', $data);
            }
        }
    }

    public function hapus($id_jenis = '')
    {
        $jenis = $this->jenis_model->get_jenis($id_jenis);

        if ($jenis->num_rows() > 0) {
            $this->jenis_model->delete_jenis($id_jenis);
            redirect('jenis');
        } else {
            show_404();
        }
    }
}


/* End of file Jenis.php */
/* Location: ./application/controllers/Jenis.php */