<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Kriteria extends CI_Controller
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
        $this->load->model('kriteria_model');
        $this->load->model('kriteria_ahp_model');
    }

    public function index()
    {
        $data['kriteria'] = $this->kriteria_model->get_all_kriteria()->result();
        $this->load->view('kriteria/index', $data);
    }

    public function tambah()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('kode_kriteria', 'Kode Kriteria', 'required');
        $this->form_validation->set_rules('nama_kriteria', 'nama Kriteria', 'required');

        $this->form_validation->set_message('required', 'Isi dulu %s');

        if ($this->form_validation->run()) {
            $params = array(
                'kode_kriteria' => $this->input->post('kode_kriteria', TRUE),
                'nama_kriteria' => $this->input->post('nama_kriteria', TRUE),
            );
            $this->kriteria_model->add_kriteria($params);

            $this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
            redirect('kriteria/tambah');
        } else {
            $this->load->view('kriteria/tambah');
        }
    }

    public function ubah($id_kriteria = '')
    {
        $data['kriteria'] = $this->kriteria_model->get_kriteria($id_kriteria)->row();

        if (empty($data['kriteria'])) {
            show_404();
        } else {
            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('kode_kriteria', 'Kode Kriteria', 'required');
            $this->form_validation->set_rules('nama_kriteria', 'nama Kriteria', 'required');

            $this->form_validation->set_message('required', 'Isi dulu %s');

            if ($this->form_validation->run()) {
                $params = array(
                    'kode_kriteria' => $this->input->post('kode_kriteria', TRUE),
                    'nama_kriteria' => $this->input->post('nama_kriteria', TRUE),
                );
                $this->kriteria_model->update_kriteria($id_kriteria, $params);

                $this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
                redirect('kriteria/ubah/' . $id_kriteria);
            } else {
                $this->load->view('kriteria/ubah', $data);
            }
        }
    }

    public function hapus($id_kriteria = '')
    {
        $kriteria = $this->kriteria_model->get_kriteria($id_kriteria);

        if ($kriteria->num_rows() > 0) {
            $this->kriteria_model->delete_kriteria($id_kriteria);
            redirect('kriteria');
        } else {
            show_404();
        }
    }

    public function prioritas()
    {
        $this->load->helper('form');
        $query_kriteria = $this->kriteria_model->get_all_kriteria();
        $data['kriteria'] = $query_kriteria->result();

        if (isset($_POST['save'])) {
            $this->kriteria_ahp_model->delete_kriteria_ahp();
            $i = 0;
            foreach ($data['kriteria'] as $row1) {
                $ii = 0;
                foreach ($data['kriteria'] as $row2) {
                    if ($i < $ii) {
                        $nilai_input = $this->input->post('nilai_' . $row1->id_kriteria . '_' . $row2->id_kriteria);
                        $nilai_1 = 0;
                        $nilai_2 = 0;
                        if ($nilai_input < 1) {
                            $nilai_1 = abs($nilai_input);
                            $nilai_2 = number_format(1 / abs($nilai_input), 5);
                        } elseif ($nilai_input > 1) {
                            $nilai_1 = number_format(1 / abs($nilai_input), 5);
                            $nilai_2 = abs($nilai_input);
                        } elseif ($nilai_input == 1) {
                            $nilai_1 = 1;
                            $nilai_2 = 1;
                        }
                        $params = array(
                            'id_kriteria_1' => $row1->id_kriteria,
                            'id_kriteria_2' => $row2->id_kriteria,
                            'nilai_1' => $nilai_1,
                            'nilai_2' => $nilai_2,
                        );
                        $this->kriteria_ahp_model->add_kriteria_ahp($params);
                    }
                    $ii++;
                }
                $i++;
            }
            $this->session->set_flashdata('pesan_sukses', '<div class="alert alert-success" role="alert">Nilai perbandingan kriteria berhasil disimpan</div>');
        }

        if (isset($_POST['check'])) {
            if ($query_kriteria->num_rows() < 3) {
                $this->session->set_flashdata('pesan_error', '<div class="alert alert-danger" role="alert">Jumlah kriteria kurang, minimal 3</div>');
            } else {
                $id_kriteria = array();
                foreach ($data['kriteria'] as $row)
                    $id_kriteria[] = $row->id_kriteria;
            }

            // perhitungan metode AHP
            $matrik_kriteria = $this->ahp_get_matrik_kriteria($id_kriteria);
            $jumlah_kolom = $this->ahp_get_jumlah_kolom($matrik_kriteria);
            $matrik_normalisasi = $this->ahp_get_normalisasi($matrik_kriteria, $jumlah_kolom);
            $prioritas = $this->ahp_get_prioritas($matrik_normalisasi);
            $matrik_baris = $this->ahp_get_matrik_baris($prioritas, $matrik_kriteria);
            $jumlah_matrik_baris = $this->ahp_get_jumlah_matrik_baris($matrik_baris);
            $hasil_tabel_konsistensi = $this->ahp_get_tabel_konsistensi($jumlah_matrik_baris, $prioritas);
            if ($this->ahp_uji_konsistensi($hasil_tabel_konsistensi)) {
                $this->session->set_flashdata('pesan_sukses', '<div class="alert alert-success" role="alert">Nilai perbandingan : KONSISTEN</div>');
                $i = 0;
                foreach ($data['kriteria'] as $row) {
                    $params = array(
                        'prioritas' => $prioritas[$i++],
                    );
                    $this->kriteria_model->update_kriteria($row->id_kriteria, $params);
                }

                $data['list_data'] = $this->tampil_data_1($matrik_kriteria, $jumlah_kolom);
                $data['list_data2'] = $this->tampil_data_2($matrik_normalisasi, $prioritas);
                $data['list_data3'] = $this->tampil_data_3($matrik_baris, $jumlah_matrik_baris);
                $list_data = $this->tampil_data_4($jumlah_matrik_baris, $prioritas, $hasil_tabel_konsistensi);
                $data['list_data4'] = $list_data[0];
                $data['list_data5'] = $list_data[1];
            } else {
                $this->session->set_flashdata('pesan_error', '<div class="alert alert-danger" role="alert">Nilai perbandingan : TIDAK KONSISTEN</div>');
            }
        }

        $result = array();
        $i = 0;
        foreach ($data['kriteria'] as $row1) {
            $ii = 0;
            foreach ($data['kriteria'] as $row2) {
                if ($i < $ii) {
                    $kriteria_ahp = $this->kriteria_ahp_model->get_kriteria_ahp($row1->id_kriteria, $row2->id_kriteria)->row();
                    if (empty($kriteria_ahp)) {
                        $params = array(
                            'id_kriteria_1' => $row1->id_kriteria,
                            'id_kriteria_2' => $row2->id_kriteria,
                            'nilai_1' => 1,
                            'nilai_2' => 1,
                        );
                        $this->kriteria_ahp_model->add_kriteria_ahp($params);
                        $nilai_1 = 1;
                        $nilai_2 = 1;
                    } else {
                        $nilai_1 = $kriteria_ahp->nilai_1;
                        $nilai_2 = $kriteria_ahp->nilai_2;
                    }
                    $nilai = 0;
                    if ($nilai_1 < 1) {
                        $nilai = $nilai_2;
                    } elseif ($nilai_1 > 1) {
                        $nilai = -$nilai_1;
                    } elseif ($nilai_1 == 1) {
                        $nilai = 1;
                    }
                    $result[$row1->id_kriteria][$row2->id_kriteria] = $nilai;
                }
                $ii++;
            }
            $i++;
        }

        $data['kriteria_ahp'] = $result;
        $this->load->view('kriteria/prioritas', $data);
    }

    public function reset()
    {
        $this->kriteria_ahp_model->delete_kriteria_ahp();
        $params = array(
            'prioritas' => null,
        );
        $this->kriteria_model->update_prioritas($params);
        redirect('kriteria/prioritas');
    }

    // --- metode AHP --- START
    public function ahp_get_matrik_kriteria($kriteria)
    {
        $matrik = array();
        $i = 0;
        foreach ($kriteria as $row1) {
            $ii = 0;
            foreach ($kriteria as $row2) {
                if ($i == $ii) {
                    $matrik[$i][$ii] = 1;
                } else {
                    if ($i < $ii) {
                        $kriteria_ahp = $this->kriteria_ahp_model->get_kriteria_ahp($row1, $row2)->row();
                        if (empty($kriteria_ahp)) {
                            $matrik[$i][$ii] = 1;
                            $matrik[$ii][$i] = 1;
                        } else {
                            $matrik[$i][$ii] = $kriteria_ahp->nilai_1;
                            $matrik[$ii][$i] = $kriteria_ahp->nilai_2;
                        }
                    }
                }
                $ii++;
            }
            $i++;
        }
        return $matrik;
    }

    public function ahp_get_jumlah_kolom($matrik)
    {
        $jumlah_kolom = array();
        for ($i = 0; $i < count($matrik); $i++) {
            $jumlah_kolom[$i] = 0;
            for ($ii = 0; $ii < count($matrik); $ii++) {
                $jumlah_kolom[$i] = $jumlah_kolom[$i] + $matrik[$ii][$i];
            }
        }
        return $jumlah_kolom;
    }

    public function ahp_get_normalisasi($matrik, $jumlah_kolom)
    {
        $matrik_normalisasi = array();
        for ($i = 0; $i < count($matrik); $i++) {
            for ($ii = 0; $ii < count($matrik); $ii++) {
                $matrik_normalisasi[$i][$ii] = number_format($matrik[$i][$ii] / $jumlah_kolom[$ii], 5);
            }
        }
        return $matrik_normalisasi;
    }

    public function ahp_get_prioritas($matrik_normalisasi)
    {
        $prioritas = array();
        for ($i = 0; $i < count($matrik_normalisasi); $i++) {
            $prioritas[$i] = 0;
            for ($ii = 0; $ii < count($matrik_normalisasi); $ii++) {
                $prioritas[$i] = $prioritas[$i] + $matrik_normalisasi[$i][$ii];
            }
            $prioritas[$i] = number_format($prioritas[$i] / count($matrik_normalisasi), 5);
        }
        return $prioritas;
    }

    public function ahp_get_matrik_baris($prioritas, $matrik_kriteria)
    {
        $matrik_baris = array();
        for ($i = 0; $i < count($matrik_kriteria); $i++) {
            for ($ii = 0; $ii < count($matrik_kriteria); $ii++) {
                $matrik_baris[$i][$ii] = number_format($prioritas[$ii] * $matrik_kriteria[$i][$ii], 5);
            }
        }
        return $matrik_baris;
    }

    public function ahp_get_jumlah_matrik_baris($matrik_baris)
    {
        $jumlah_baris = array();
        for ($i = 0; $i < count($matrik_baris); $i++) {
            $jumlah_baris[$i] = 0;
            for ($ii = 0; $ii < count($matrik_baris); $ii++) {
                $jumlah_baris[$i] = $jumlah_baris[$i] + $matrik_baris[$i][$ii];
            }
        }
        return $jumlah_baris;
    }

    public function ahp_get_tabel_konsistensi($jumlah_matrik_baris, $prioritas)
    {
        $jumlah = array();
        for ($i = 0; $i < count($jumlah_matrik_baris); $i++) {
            $jumlah[$i] = $jumlah_matrik_baris[$i] + $prioritas[$i];
        }
        return $jumlah;
    }

    public function ahp_uji_konsistensi($tabel_konsistensi)
    {
        $jumlah = array_sum($tabel_konsistensi);
        $n = count($tabel_konsistensi);
        $lambda_maks = $jumlah / $n;
        $ci = ($lambda_maks - $n) / ($n - 1);
        $ir = array(0, 0, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49, 1.51, 1.48, 1.56, 1.57, 1.59);
        if ($n <= 15) {
            $ir = $ir[$n - 1];
        } else {
            $ir = $ir[14];
        }
        $cr = number_format($ci / $ir, 5);

        if ($cr <= 0.1) {
            return true;
        } else {
            return false;
        }
    }
    // --- metode AHP --- END

    // --- untuk menampilkan langkah perhitungan ---
    public function tampil_data_1($matrik_kriteria, $jumlah_kolom)
    {
        $kriteria = $this->kriteria_model->get_all_kriteria()->result();
        // --- tabel matriks perbandingan berpasangan
        $list_data = '';
        $list_data .= '<tr><td></td>';
        foreach ($kriteria as $row) {
            $list_data .= '<td class="text-center">' . $row->kode_kriteria . '</td>';
        }
        $list_data .= '</tr>';
        $i = 0;
        foreach ($kriteria as $row) {
            $list_data .= '<tr>';
            $list_data .= '<td>' . $row->kode_kriteria . '</td>';
            $ii = 0;
            foreach ($kriteria as $row2) {
                $list_data .= '<td class="text-center">' . $matrik_kriteria[$i][$ii] . '</td>';
                $ii++;
            }
            $list_data .= '</tr>';
            $i++;
        }
        $list_data .= '<tr><td class="font-weight-bold">Jumlah</td>';
        for ($i = 0; $i < count($jumlah_kolom); $i++) {
            $list_data .= '<td class="text-center font-weight-bold">' . $jumlah_kolom[$i] . '</td>';
        }
        $list_data .= '</tr>';
        // ---
        return $list_data;
    }

    public function tampil_data_2($matrik_normalisasi, $prioritas)
    {
        $kriteria = $this->kriteria_model->get_all_kriteria()->result();
        // --- matriks nilai kriteria
        $list_data2 = '';
        $list_data2 .= '<tr><td></td>';
        foreach ($kriteria as $row) {
            $list_data2 .= '<td class="text-center">' . $row->kode_kriteria . '</td>';
        }
        $list_data2 .= '<td class="text-center font-weight-bold">Jumlah</td>';
        $list_data2 .= '<td class="text-center font-weight-bold">Prioritas</td>';
        $list_data2 .= '</tr>';
        $i = 0;
        foreach ($kriteria as $row) {
            $list_data2 .= '<tr>';
            $list_data2 .= '<td>' . $row->kode_kriteria . '</td>';
            $jumlah = 0;
            $ii = 0;
            foreach ($kriteria as $row2) {
                $list_data2 .= '<td class="text-center">' . $matrik_normalisasi[$i][$ii] . '</td>';
                $jumlah += $matrik_normalisasi[$i][$ii];
                $ii++;
            }
            $list_data2 .= '<td class="text-center font-weight-bold">' . $jumlah . '</td>';
            $list_data2 .= '<td class="text-center font-weight-bold">' . $prioritas[$i] . '</td>';
            $list_data2 .= '</tr>';
            $i++;
        }
        // ---
        return $list_data2;
    }

    public function tampil_data_3($matrik_baris, $jumlah_matrik_baris)
    {
        $kriteria = $this->kriteria_model->get_all_kriteria()->result();
        // --- matriks penjumlahan setiap baris
        $list_data3 = '';
        $list_data3 .= '<tr><td></td>';
        foreach ($kriteria as $row) {
            $list_data3 .= '<td class="text-center">' . $row->kode_kriteria . '</td>';
        }
        $list_data3 .= '<td class="text-center font-weight-bold">Jumlah</td>';
        $list_data3 .= '</tr>';
        $i = 0;
        foreach ($kriteria as $row) {
            $list_data3 .= '<tr>';
            $list_data3 .= '<td>' . $row->kode_kriteria . '</td>';
            $ii = 0;
            foreach ($kriteria as $row2) {
                $list_data3 .= '<td class="text-center">' . $matrik_baris[$i][$ii] . '</td>';
                $ii++;
            }
            $list_data3 .= '<td class="text-center font-weight-bold">' . $jumlah_matrik_baris[$i] . '</td>';
            $list_data3 .= '</tr>';
            $i++;
        }
        // ---
        return $list_data3;
    }

    public function tampil_data_4($jumlah_matrik_baris, $prioritas, $hasil_tabel_konsistensi)
    {
        $kriteria = $this->kriteria_model->get_all_kriteria()->result();
        // --- perhitungan rasio konsistensi
        $list_data4 = '';
        $list_data4 .= '<tr><td></td>';
        $list_data4 .= '<td class="text-center">Jumlah per Baris</td>';
        $list_data4 .= '<td class="text-center">Prioritas</td>';
        $list_data4 .= '<td class="text-center font-weight-bold">Hasil</td>';
        $list_data4 .= '</tr>';
        $i = 0;
        foreach ($kriteria as $row) {
            $list_data4 .= '<tr>';
            $list_data4 .= '<td>' . $row->kode_kriteria . '</td>';
            $list_data4 .= '<td class="text-center">' . $jumlah_matrik_baris[$i] . '</td>';
            $list_data4 .= '<td class="text-center">' . $prioritas[$i] . '</td>';
            $list_data4 .= '<td class="text-center font-weight-bold">' . $hasil_tabel_konsistensi[$i] . '</td>';
            $list_data4 .= '</tr>';
            $i++;
        }
        $jumlah = array_sum($hasil_tabel_konsistensi);
        $n = count($hasil_tabel_konsistensi);
        $lambda_maks = $jumlah / $n;
        $ci = ($lambda_maks - $n) / ($n - 1);
        $ir = array(0, 0, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49, 1.51, 1.48, 1.56, 1.57, 1.59);
        if ($n <= 15) {
            $ir = $ir[$n - 1];
        } else {
            $ir = $ir[14];
        }
        $cr = number_format($ci / $ir, 5);

        $list_data5 = '';
        $list_data5 .= '<table class="table">
<tr>
    <td width="100">Jumlah</td>
    <td>= ' . $jumlah . '</td>
</tr>
<tr>
    <td width="100">n </td>
    <td>= ' . $n . '</td>
</tr>
<tr>
    <td width="100">λ maks</td>
    <td>= ' . number_format($lambda_maks, 5) . '</td>
</tr>
<tr>
    <td width="100">CI</td>
    <td>= ' . number_format($ci, 5) . '</td>
</tr>
<tr>
    <td width="100">CR</td>
    <td>= ' . $cr . '</td>
</tr>
<tr>
    <td width="100">CR <= 0.1</td>';
        if ($cr <= 0.1) {
            $list_data5 .= '
    <td>Konsisten</td>';
        } else {
            $list_data5 .= '
    <td>Tidak Konsisten</td>';
        }
        $list_data5 .= '
</tr>
</table>';
        // ---
        return array($list_data4, $list_data5);
    }
    // -------
}


/* End of file Kriteria.php */
/* Location: ./application/controllers/Kriteria.php */