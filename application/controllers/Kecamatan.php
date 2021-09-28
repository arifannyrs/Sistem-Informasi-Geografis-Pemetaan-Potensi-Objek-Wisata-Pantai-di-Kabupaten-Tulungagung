<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Kecamatan extends CI_Controller
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
        $this->load->model('kecamatan_model');
    }

    public function index()
    {
        $data['kecamatan'] = $this->kecamatan_model->get_all_kecamatan('desc')->result();
        $this->load->view('kecamatan/index', $data);
    }

    public function tambah()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required');
        $this->form_validation->set_rules('userfile', 'GeoJSON', 'callback_validasi_file');
        $this->form_validation->set_rules('warna', 'Warna', 'required');

        $this->form_validation->set_message('required', 'Isi dulu %s');

        if ($this->form_validation->run()) {
            $upload = $this->upload->data();
            $file_name = $upload['file_name'];
            $params = array(
                'kecamatan' => $this->input->post('kecamatan', TRUE),
                'geojson' => $file_name,
                'warna' => $this->input->post('warna', TRUE),
            );
            $this->kecamatan_model->add_kecamatan($params);

            $this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
            redirect('kecamatan/tambah');
        } else {
            $this->load->view('kecamatan/tambah');
        }
    }

    public function ubah($id_kecamatan = '')
    {
        $data['kecamatan'] = $this->kecamatan_model->get_kecamatan($id_kecamatan)->row();

        if (empty($data['kecamatan'])) {
            show_404();
        } else {
            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required');
            $userfile = isset($_FILES['userfile']['name']) ? $_FILES['userfile']['name'] : '';
            if (!empty($userfile)) {
                $this->form_validation->set_rules('userfile', 'GeoJSON', 'callback_validasi_file');
            }
            $this->form_validation->set_rules('warna', 'Warna', 'required');

            $this->form_validation->set_message('required', 'Isi dulu %s');

            if ($this->form_validation->run()) {
                $kecamatan = $data['kecamatan'];
                $file_name = $kecamatan->geojson;
                if (!empty($userfile)) {
                    if (!empty($file_name)) {
                        unlink('./public/file/geojson/' . $file_name);
                    }
                    $upload = $this->upload->data();
                    $file_name = $upload['file_name'];
                }
                $warna = $data['warna'];

                $params = array(
                    'kecamatan' => $this->input->post('kecamatan', TRUE),
                    'geojson' => $file_name,
                    'warna' => $this->input->post('warna', TRUE),
                );
                $this->kecamatan_model->update_kecamatan($id_kecamatan, $params);

                $this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
                redirect('kecamatan/ubah/' . $id_kecamatan);
            } else {
                $this->load->view('kecamatan/ubah', $data);
            }
        }
    }

    public function hapus($id_kecamatan = '')
    {
        $kecamatan = $this->kecamatan_model->get_kecamatan($id_kecamatan);
        if ($kecamatan->num_rows() > 0) {
            $kecamatan = $kecamatan->row();
            if (!empty($kecamatan->geojson)) {
                unlink('./public/file/geojson/' . $kecamatan->geojson);
            }
            $warna = $kecamatan->row();
            $this->kecamatan_model->delete_kecamatan($id_kecamatan);
            redirect('kecamatan');
        } else {
            show_404();
        }
    }

    public function validasi_file()
    {
        $config['upload_path'] = './public/file/geojson/';
        $config['allowed_types'] = '*';
        $config['max_size'] = 2048;
        $config['overwrite'] = FALSE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload()) {
            return TRUE;
        } else {
            $this->form_validation->set_message('validasi_file', $this->upload->display_errors());
            return FALSE;
        }
    }
}


/* End of file Kecamatan.php */
/* Location: ./application/controllers/Kecamatan.php */