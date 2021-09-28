<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Hasil extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert">Anda harus login</div>');
            redirect('login');
        }
        $allowed = array('Admin','Pegawai','User');
        if (!in_array($this->session->userdata('role'), $allowed)) {
            redirect('home');
        }
        $this->load->model('kriteria_model');
        $this->load->model('pantai_model');
        $this->load->model('nilai_model');
        $this->load->model('pantai_kriteria_model');
        $this->load->model('hasil_model');
        $this->load->model('jenis_model');
    }

    public function index()
    {
        $this->load->helper('form');

        $id_jenis = isset($_GET['id_jenis']) ? $_GET['id_jenis'] : '';
        $data['id_jenis'] = $id_jenis;

        if(empty($id_jenis)){
            $data['jenis'] = $this->jenis_model->get_all_jenis()->result();
        }else{
            $this->hasil_model->delete_hasil($id_jenis);
            $data['pantai'] = $this->pantai_model->get_all_pantai('asc', $id_jenis)->result();
            $data['kriteria'] = $this->kriteria_model->get_all_kriteria()->result();
            $data['data_nilai'] = $this->nilai_model->get_all_nilai()->result();
            $nilai = array();
            $nilai_ahp = array();
            $nilai_prioritas = array();
            $hasil = array();
            foreach ($data['pantai'] as $row_pantai) {
                $nilai_total = 0;
                foreach ($data['kriteria'] as $row_kriteria) {
                    $pantai_kriteria = $this->pantai_kriteria_model->get_pantai_kriteria($row_pantai->id_pantai, $row_kriteria->id_kriteria)->row();
                    $nilai[$row_pantai->id_pantai][$row_kriteria->id_kriteria] = empty($pantai_kriteria) ? '' : $pantai_kriteria->nilai;

                    $result = $this->nilai_model->get_nilai($pantai_kriteria->id_nilai)->row();
                    $nilai_ahp[$row_pantai->id_pantai][$row_kriteria->id_kriteria] = empty($result) ? '' : $result->nama;

                    $prioritas = $row_kriteria->prioritas * $result->prioritas;
                    $nilai_prioritas[$row_pantai->id_pantai][$row_kriteria->id_kriteria] = number_format($prioritas, 5);

                    $nilai_total += $prioritas;
                }
                $hasil[] = array(
                    "id_pantai" => $row_pantai->id_pantai,
                    "nama_pantai" => $row_pantai->nama_pantai,
                    "nilai_hasil" => number_format($nilai_total, 5),
                );
                $params = array(
                    "id_pantai" => $row_pantai->id_pantai,
                    "nilai_hasil" => number_format($nilai_total, 5),
                    "id_jenis" => $id_jenis,
                );
                $this->hasil_model->add_hasil($params);
            }
            $this->array_sort_by_column($hasil, 'nilai_hasil');
            $data['nilai'] = $nilai;
            $data['nilai_ahp'] = $nilai_ahp;
            $data['nilai_prioritas'] = $nilai_prioritas;
            $data['hasil'] = $hasil;
        }
        $this->load->view('hasil/index', $data);
    }

    public function array_sort_by_column(&$arr, $col, $dir = SORT_DESC)
    {
        $sort_col = array();
        foreach ($arr as $key => $row) {
            $sort_col[$key] = $row[$col];
        }
        array_multisort($sort_col, $dir, $arr);
    }

    public function cetak($id_jenis)
    {
        $data['hasil'] = $this->hasil_model->get_by_nilai($id_jenis)->result();
        $data['jenis'] = $this->jenis_model->get_jenis($id_jenis)->row();
        $html = $this->load->view('hasil/cetak', $data, TRUE);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("laporan-hasil-penilaian.pdf", array("Attachment" => FALSE));
    }
}


/* End of file Hasil.php */
/* Location: ./application/controllers/Hasil.php */