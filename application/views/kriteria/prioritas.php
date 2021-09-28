<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?= $this->load->view('template/header', '', TRUE) ?>
<?= $this->load->view('template/sidebar', '', TRUE) ?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Kriteria</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title">Prioritas Kriteria</h4>
                        <div class="card-subtitle">
                            <?= anchor('kriteria', 'Kembali', 'class="btn btn-secondary"') ?>
                        </div>
                        <?= $this->session->flashdata('pesan_sukses') ?>
                        <?= $this->session->flashdata('pesan_error') ?>
                        <?= form_open('kriteria/prioritas') ?>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-right" width="25%">Nama Kriteria</th>
                                        <th class="text-center" width="50%">Skala Perbandingan</th>
                                        <th class="text-left" width="25%">Nama Kriteria</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $i = 0;
                                    foreach ($kriteria as $row1) :
                                        $ii = 0;
                                        foreach ($kriteria as $row2) :
                                            if ($i < $ii) :
                                                $nilai = $kriteria_ahp[$row1->id_kriteria][$row2->id_kriteria];
                                    ?>
                                                <tr>
                                                    <td class="text-right"><?= $row1->nama_kriteria ?></td>
                                                    <td class="text-center">
                                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                            <label class="btn btn-success <?= $nilai == -9 ? "active" : "" ?>"><input type="radio" id="radio_a_<?= $no ?>" name="nilai_<?= $row1->id_kriteria . '_' . $row2->id_kriteria ?>" value="-9" <?= $nilai == -9 ? "checked" : "" ?>>9</label>
                                                            <label class="btn btn-success <?= $nilai == -8 ? "active" : "" ?>"><input type="radio" id="radio_b_<?= $no ?>" name="nilai_<?= $row1->id_kriteria . '_' . $row2->id_kriteria ?>" value="-8" <?= $nilai == -8 ? "checked" : "" ?>>8</label>
                                                            <label class="btn btn-success <?= $nilai == -7 ? "active" : "" ?>"><input type="radio" id="radio_c_<?= $no ?>" name="nilai_<?= $row1->id_kriteria . '_' . $row2->id_kriteria ?>" value="-7" <?= $nilai == -7 ? "checked" : "" ?>>7</label>
                                                            <label class="btn btn-success <?= $nilai == -6 ? "active" : "" ?>"><input type="radio" id="radio_d_<?= $no ?>" name="nilai_<?= $row1->id_kriteria . '_' . $row2->id_kriteria ?>" value="-6" <?= $nilai == -6 ? "checked" : "" ?>>6</label>
                                                            <label class="btn btn-success <?= $nilai == -5 ? "active" : "" ?>"><input type="radio" id="radio_e_<?= $no ?>" name="nilai_<?= $row1->id_kriteria . '_' . $row2->id_kriteria ?>" value="-5" <?= $nilai == -5 ? "checked" : "" ?>>5</label>
                                                            <label class="btn btn-success <?= $nilai == -4 ? "active" : "" ?>"><input type="radio" id="radio_f_<?= $no ?>" name="nilai_<?= $row1->id_kriteria . '_' . $row2->id_kriteria ?>" value="-4" <?= $nilai == -4 ? "checked" : "" ?>>4</label>
                                                            <label class="btn btn-success <?= $nilai == -3 ? "active" : "" ?>"><input type="radio" id="radio_g_<?= $no ?>" name="nilai_<?= $row1->id_kriteria . '_' . $row2->id_kriteria ?>" value="-3" <?= $nilai == -3 ? "checked" : "" ?>>3</label>
                                                            <label class="btn btn-success <?= $nilai == -2 ? "active" : "" ?>"><input type="radio" id="radio_h_<?= $no ?>" name="nilai_<?= $row1->id_kriteria . '_' . $row2->id_kriteria ?>" value="-2" <?= $nilai == -2 ? "checked" : "" ?>>2</label>
                                                            <label class="btn btn-success <?= $nilai == 1 ? "active" : "" ?>"><input type="radio" id="radio_i_<?= $no ?>" name="nilai_<?= $row1->id_kriteria . '_' . $row2->id_kriteria ?>" value="1" <?= $nilai == 1 ? "checked" : "" ?>>1</label>
                                                            <label class="btn btn-success <?= $nilai == 2 ? "active" : "" ?>"><input type="radio" id="radio_j_<?= $no ?>" name="nilai_<?= $row1->id_kriteria . '_' . $row2->id_kriteria ?>" value="2" <?= $nilai == 2 ? "checked" : "" ?>>2</label>
                                                            <label class="btn btn-success <?= $nilai == 3 ? "active" : "" ?>"><input type="radio" id="radio_k_<?= $no ?>" name="nilai_<?= $row1->id_kriteria . '_' . $row2->id_kriteria ?>" value="3" <?= $nilai == 3 ? "checked" : "" ?>>3</label>
                                                            <label class="btn btn-success <?= $nilai == 4 ? "active" : "" ?>"><input type="radio" id="radio_l_<?= $no ?>" name="nilai_<?= $row1->id_kriteria . '_' . $row2->id_kriteria ?>" value="4" <?= $nilai == 4 ? "checked" : "" ?>>4</label>
                                                            <label class="btn btn-success <?= $nilai == 5 ? "active" : "" ?>"><input type="radio" id="radio_m_<?= $no ?>" name="nilai_<?= $row1->id_kriteria . '_' . $row2->id_kriteria ?>" value="5" <?= $nilai == 5 ? "checked" : "" ?>>5</label>
                                                            <label class="btn btn-success <?= $nilai == 6 ? "active" : "" ?>"><input type="radio" id="radio_n_<?= $no ?>" name="nilai_<?= $row1->id_kriteria . '_' . $row2->id_kriteria ?>" value="6" <?= $nilai == 6 ? "checked" : "" ?>>6</label>
                                                            <label class="btn btn-success <?= $nilai == 7 ? "active" : "" ?>"><input type="radio" id="radio_o_<?= $no ?>" name="nilai_<?= $row1->id_kriteria . '_' . $row2->id_kriteria ?>" value="7" <?= $nilai == 7 ? "checked" : "" ?>>7</label>
                                                            <label class="btn btn-success <?= $nilai == 8 ? "active" : "" ?>"><input type="radio" id="radio_p_<?= $no ?>" name="nilai_<?= $row1->id_kriteria . '_' . $row2->id_kriteria ?>" value="8" <?= $nilai == 8 ? "checked" : "" ?>>8</label>
                                                            <label class="btn btn-success <?= $nilai == 9 ? "active" : "" ?>"><input type="radio" id="radio_q_<?= $no ?>" name="nilai_<?= $row1->id_kriteria . '_' . $row2->id_kriteria ?>" value="9" <?= $nilai == 9 ? "checked" : "" ?>>9</label>
                                                        </div>
                                                    </td>
                                                    <td class="text-left"><?= $row2->nama_kriteria ?></td>
                                                </tr>
                                    <?php
                                                $no++;
                                            endif;
                                            $ii++;
                                        endforeach;
                                        $i++;
                                    endforeach;
                                    ?>
                                    <tr>
                                        <td class="text-center" colspan="3">
                                            <button type="submit" name="save" class="btn btn-primary">Simpan</button>
                                            <button type="submit" name="check" class="btn btn-warning">Cek Konsistensi</button>
                                            <a href="#" data-href="<?= site_url('kriteria/reset') ?>" data-toggle="modal" data-target="#confirm-reset" class="btn btn-danger">Reset</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?= form_close() ?>

                        <?php if (isset($_POST['check']) and empty($this->session->flashdata('pesan_error'))) : ?>
                            <h2>Langkah Perhitungan</h2>
                            <h3>Matriks Perbandingan Berpasangan</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered table-fix">
                                    <?= $list_data ?>
                                </table>
                            </div>
                            <h3>Matriks Nilai Kriteria (Normalisasi)</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered table-fix">
                                    <?= $list_data2 ?>
                                </table>
                            </div>
                            <h3>Matriks Penjumlahan Setiap Baris</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered table-fix">
                                    <?= $list_data3 ?>
                                </table>
                            </div>
                            <h3>Perhitungan Rasio Konsistensi</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered table-fix">
                                    <?= $list_data4 ?>
                                </table>
                                <?= $list_data5 ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?= $this->load->view('template/copyright', '', TRUE) ?>
</div>
</div>

<?= $this->load->view('template/js', '', TRUE) ?>
<script>
    $(document).ready(function() {
        $('#confirm-reset').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    });
</script>

<div class="modal fade" id="confirm-reset" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Konfirmasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Anda yakin akan mengatur ulang semua nilai perbandingan kriteria ini ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a class="btn btn-danger btn-ok">Reset</a>
            </div>
        </div>
    </div>
</div>
<?= $this->load->view('template/footer', '', TRUE) ?>