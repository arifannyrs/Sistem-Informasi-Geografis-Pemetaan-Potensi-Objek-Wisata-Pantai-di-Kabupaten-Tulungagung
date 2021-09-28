<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pantai extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert">Anda harus login</div>');
            redirect('login');
        }
        $allowed = array('Admin', 'Pegawai', 'User');
        if (!in_array($this->session->userdata('role'), $allowed)) {
            redirect('home');
        }
        $this->load->model('pantai_model');
        $this->load->model('kriteria_model');
        $this->load->model('pantai_kriteria_model');
        $this->load->model('jenis_model');
        $this->load->model('kecamatan_model');
        $this->load->model('nilai_model');
    }

    public function index()
    {
        $data['pantai'] = $this->pantai_model->get_all_pantai('desc')->result();
        $this->load->view('pantai/index', $data);
    }

    public function tambah()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['kriteria'] = $this->kriteria_model->get_all_kriteria()->result();

        $this->form_validation->set_rules('id_jenis', 'Jenis Wisata', 'required');
        $this->form_validation->set_rules('nama_pantai', 'Nama Pantai', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('latitude', 'Latitude');
        $this->form_validation->set_rules('longitude', 'Longitude');
        $this->form_validation->set_rules('id_kecamatan', 'Kecamatan', 'required');
        foreach ($data['kriteria'] as $row) {
            $this->form_validation->set_rules('kriteria' . $row->id_kriteria, $row->nama_kriteria, 'required|numeric|less_than_equal_to[100]|greater_than_equal_to[1]');
        }
        $this->form_validation->set_rules('userfile', 'Foto', 'callback_validasi_file');
        $this->form_validation->set_rules('faslitas', 'Fasilitas');
        $this->form_validation->set_rules('tiket', 'Tiket');
        $this->form_validation->set_rules('akses', 'Akses');


        $this->form_validation->set_message('required', 'Isi dulu %s');
        $this->form_validation->set_message('numeric', '%s harus angka');
        $this->form_validation->set_message('less_than_equal_to', '%s maksimal 100');
        $this->form_validation->set_message('greater_than_equal_to', '%s minimal 1');

        if ($this->form_validation->run()) {
            $upload = $this->upload->data();
            $file_name = $upload['file_name'];
            $params = array(
                'nama_pantai' => $this->input->post('nama_pantai', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
                'latitude' => $this->input->post('latitude', TRUE),
                'longitude' => $this->input->post('longitude', TRUE),
                'id_kecamatan' => $this->input->post('id_kecamatan', TRUE),
                'id_jenis' => $this->input->post('id_jenis', TRUE),
                'foto' => $file_name,
                'faslitas' => $this->input->post('faslitas', TRUE),
                'tiket' => $this->input->post('tiket', TRUE),
                'akses' => $this->input->post('akses', TRUE),

            );
            $id_pantai = $this->pantai_model->add_pantai($params);

            foreach ($data['kriteria'] as $row) {
                $params2 = array(
                    'id_pantai' => $id_pantai,
                    'id_kriteria' => $row->id_kriteria,
                    'id_nilai' => $this->get_id_nilai($this->input->post('kriteria' . $row->id_kriteria, TRUE)),
                    'nilai' => $this->input->post('kriteria' . $row->id_kriteria, TRUE),
                );
                $this->pantai_kriteria_model->add_pantai_kriteria($params2);
            }

            $this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
            redirect('pantai/tambah');
        } else {
            $data['kecamatan'] = $this->kecamatan_model->get_all_kecamatan()->result();
            $data['jenis'] = $this->jenis_model->get_all_jenis()->result();
            $this->load->view('pantai/tambah', $data);
        }
    }

    public function ubah($id_pantai = '')
    {
        $data['pantai'] = $this->pantai_model->get_pantai($id_pantai)->row();
        $data['kriteria'] = $this->kriteria_model->get_all_kriteria()->result();

        if (empty($data['pantai'])) {
            show_404();
        } else {
            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('id_jenis', 'Jenis Wisata', 'required');
            $this->form_validation->set_rules('nama_pantai', 'Nama Pantai', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
            $this->form_validation->set_rules('latitude', 'Latitude');
            $this->form_validation->set_rules('longitude', 'Longitude');
            $this->form_validation->set_rules('id_kecamatan', 'Kecamatan', 'required');
            $this->form_validation->set_rules('peringkat', 'Peringkat');
            $this->form_validation->set_rules('peringkat_keindahan', 'Peringkat_keindahan');
            $this->form_validation->set_rules('peringkat_fasilitas', 'Peringkat_fasilitas');
            $this->form_validation->set_rules('peringkat_akses', 'Peringkat_akses');
            foreach ($data['kriteria'] as $row) {
                $this->form_validation->set_rules('kriteria' . $row->id_kriteria, $row->nama_kriteria, 'required|numeric|less_than_equal_to[100]|greater_than_equal_to[1]');
            }
            $userfile = isset($_FILES['userfile']['name']) ? $_FILES['userfile']['name'] : '';
            if (!empty($userfile)) {
                $this->form_validation->set_rules('userfile', 'Foto', 'callback_validasi_file');
            }
            $this->form_validation->set_rules('fasilitas', 'Fasilitas');
            $this->form_validation->set_rules('tiket', 'Tiket');
            $this->form_validation->set_rules('akses', 'Akses');


            $this->form_validation->set_message('required', 'Isi dulu %s');
            $this->form_validation->set_message('numeric', '%s harus angka');
            $this->form_validation->set_message('less_than_equal_to', '%s maksimal 100');
            $this->form_validation->set_message('greater_than_equal_to', '%s minimal 1');

            if ($this->form_validation->run()) {
                $pantai = $data['pantai'];
                $file_name = $pantai->foto;
                if (!empty($userfile)) {
                    if (!empty($file_name)) {
                        unlink('./public/file/' . $file_name);
                    }
                    $upload = $this->upload->data();
                    $file_name = $upload['file_name'];
                }

                $params = array(
                    'nama_pantai' => $this->input->post('nama_pantai', TRUE),
                    'alamat' => $this->input->post('alamat', TRUE),
                    'latitude' => $this->input->post('latitude', TRUE),
                    'longitude' => $this->input->post('longitude', TRUE),
                    'id_kecamatan' => $this->input->post('id_kecamatan', TRUE),
                    'id_jenis' => $this->input->post('id_jenis', TRUE),
                    'peringkat' => $this->input->post('peringkat', TRUE),
                    'peringkat_keindahan' => $this->input->post('peringkat_keindahan', TRUE),
                    'peringkat_fasilitas' => $this->input->post('peringkat_fasilitas', TRUE),
                    'peringkat_akses' => $this->input->post('peringkat_akses', TRUE),
                    'foto' => $file_name,
                    'fasilitas' => $this->input->post('fasilitas', TRUE),
                    'tiket' => $this->input->post('tiket', TRUE),
                    'akses' => $this->input->post('akses', TRUE),

                );
                $this->pantai_model->update_pantai($id_pantai, $params);

                foreach ($data['kriteria'] as $row) {
                    $pantai_kriteria = $this->pantai_kriteria_model->get_pantai_kriteria($id_pantai, $row->id_kriteria)->row();
                    if (empty($pantai_kriteria)) {
                        $params2 = array(
                            'id_pantai' => $id_pantai,
                            'id_kriteria' => $row->id_kriteria,
                            'id_nilai' => $this->get_id_nilai($this->input->post('kriteria' . $row->id_kriteria, TRUE)),
                            'nilai' => $this->input->post('kriteria' . $row->id_kriteria, TRUE),
                        );
                        $this->pantai_kriteria_model->add_pantai_kriteria($params2);
                    } else {
                        $params2 = array(
                            'id_nilai' => $this->get_id_nilai($this->input->post('kriteria' . $row->id_kriteria, TRUE)),
                            'nilai' => $this->input->post('kriteria' . $row->id_kriteria, TRUE),
                        );
                        $this->pantai_kriteria_model->update_pantai_kriteria($id_pantai, $row->id_kriteria, $params2);
                    }
                }

                $this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
                redirect('pantai/ubah/' . $id_pantai);
            } else {
                $nilai = array();
                foreach ($data['kriteria'] as $row) {
                    $pantai_kriteria = $this->pantai_kriteria_model->get_pantai_kriteria($id_pantai, $row->id_kriteria)->row();
                    $nilai[$row->id_kriteria] = empty($pantai_kriteria) ? '' : $pantai_kriteria->nilai;
                }
                $data['nilai'] = $nilai;
                $data['kecamatan'] = $this->kecamatan_model->get_all_kecamatan()->result();
                $data['jenis'] = $this->jenis_model->get_all_jenis()->result();
                $this->load->view('pantai/ubah', $data);
            }
        }
    }

    public function hapus($id_pantai = '')
    {
        $pantai = $this->pantai_model->get_pantai($id_pantai);

        if ($pantai->num_rows() > 0) {
            $pantai = $pantai->row();
            if (!empty($pantai->foto)) {
                unlink('./public/file/' . $pantai->foto);
            }
            $this->pantai_model->delete_pantai($id_pantai);
            redirect('pantai');
        } else {
            show_404();
        }
    }

    public function detail($id_pantai = '')
    {
        $data['pantai'] = $this->pantai_model->get_pantai($id_pantai)->row();

        if (empty($data['pantai'])) {
            show_404();
        } else {
            $kriteria = $this->kriteria_model->get_all_kriteria()->result();
            $nilai = array();
            foreach ($kriteria as $row) {
                $pantai_kriteria = $this->pantai_kriteria_model->get_pantai_kriteria($id_pantai, $row->id_kriteria)->row();
                $nilai[$row->id_kriteria] = empty($pantai_kriteria) ? '' : $pantai_kriteria->nilai;
            }
            $data['nilai'] = $nilai;
            $data['kriteria'] = $this->kriteria_model->get_all_kriteria()->result();
            $this->load->view('pantai/detail', $data);
        }
    }

    public function lihat($id_pantai = '')
    {
        $data['pantai'] = $this->pantai_model->get_pantai($id_pantai)->row();

        if (empty($data['pantai'])) {
            show_404();
        } else {
            $kriteria = $this->kriteria_model->get_all_kriteria()->result();
            $nilai = array();
            foreach ($kriteria as $row) {
                $pantai_kriteria = $this->pantai_kriteria_model->get_pantai_kriteria($id_pantai, $row->id_kriteria)->row();
                $nilai[$row->id_kriteria] = empty($pantai_kriteria) ? '' : $pantai_kriteria->nilai;
            }
            $data['nilai'] = $nilai;
            $data['kriteria'] = $this->kriteria_model->get_all_kriteria()->result();
            $this->load->view('pantai/lihat', $data);
        }
    }

    public function lihatUser($id_pantai = '')
    {
        $data['pantai'] = $this->pantai_model->get_pantai($id_pantai)->row();

        if (empty($data['pantai'])) {
            show_404();
        } else {
            $kriteria = $this->kriteria_model->get_all_kriteria()->result();
            $nilai = array();
            foreach ($kriteria as $row) {
                $pantai_kriteria = $this->pantai_kriteria_model->get_pantai_kriteria($id_pantai, $row->id_kriteria)->row();
                $nilai[$row->id_kriteria] = empty($pantai_kriteria) ? '' : $pantai_kriteria->nilai;
            }
            $data['nilai'] = $nilai;
            $data['kriteria'] = $this->kriteria_model->get_all_kriteria()->result();
            $this->load->view('user/lihat', $data);
        }
    }

    

    public function get_id_nilai($nilai)
    {
        $nilai = $this->nilai_model->get_rentang_nilai($nilai)->row();
        if (empty($nilai)) {
            return null;
        } else {
            return $nilai->id_nilai;
        }
    }

    public function validasi_file()
    {
        $config['upload_path'] = './public/file/';
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


/* End of file Pantai.php */
/* Location: ./application/controllers/Pantai.php */