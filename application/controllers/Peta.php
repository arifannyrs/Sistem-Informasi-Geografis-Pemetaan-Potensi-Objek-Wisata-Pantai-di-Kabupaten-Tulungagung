<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Peta extends CI_Controller
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
        $this->load->model('hasil_model');
    }

    public function index()
    {
        $data['kecamatan'] = $this->kecamatan_model->get_geojson();
        $data['peta'] = $this->pantai_model->get_all_marker();
        if ($this->session->userdata('role') == 'User'){
            $this->load->view('user/peta', $data);
        }else{
        $this->load->view('peta/index', $data);
        }
    }

    public function keindahan()
    {
        $data['kecamatan'] = $this->kecamatan_model->get_geojson();
        $data['peta'] = $this->pantai_model->get_all_marker();
        if ($this->session->userdata('role') == 'User'){
            $this->load->view('user/keindahan', $data);
        }else{
        $this->load->view('peta/keindahan', $data);
        }
    }

    public function fasilitas()
    {
        $data['kecamatan'] = $this->kecamatan_model->get_geojson();
        $data['peta'] = $this->pantai_model->get_all_marker();
        if ($this->session->userdata('role') == 'User'){
            $this->load->view('user/fasilitas', $data);
        }else{
        $this->load->view('peta/fasilitas', $data);
        }
    }

    public function akses()
    {
        $data['kecamatan'] = $this->kecamatan_model->get_geojson();
        $data['peta'] = $this->pantai_model->get_all_marker();
        if ($this->session->userdata('role') == 'User'){
            $this->load->view('user/akses', $data);
        }else{
        $this->load->view('peta/akses', $data);
        }
    }
}