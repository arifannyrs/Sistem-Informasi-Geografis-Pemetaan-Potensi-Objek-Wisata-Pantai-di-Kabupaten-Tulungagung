<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?= $this->load->view('template/header', '', TRUE) ?>
<?= $this->load->view('template/sidebar', '', TRUE) ?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Nilai</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title">Prioritas Nilai</h4>
                        <div class="card-subtitle">
                            <?= anchor('nilai', 'Kembali', 'class="btn btn-secondary"') ?>
                        </div>
                        <?= $this->session->flashdata('pesan_sukses') ?>
                        <?= $this->session->flashdata('pesan_error') ?>
                        <?= form_open('nilai/prioritas') ?>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-right" width="25%">Nama Nilai</th>
                                        <th class="text-center" width="50%">Skala Perbandingan</th>
                                        <th class="text-left" width="25%">Nama Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $i = 0;
                                    foreach ($nilai as $row1) :
                                        $ii = 0;
                                        foreach ($nilai as $row2) :
                                            if ($i < $ii) :
                                                $pilihan_nilai = $nilai_ahp[$row1->id_nilai][$row2->id_nilai];
                                    ?>
                                                <tr>
                                                    <td class="text-right"><?= $row1->nama ?></td>
                                                    <td class="text-center">
                                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                            <label class="btn btn-success <?= $pilihan_nilai == -9 ? "active" : "" ?>"><input type="radio" id="radio_a_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="-9" <?= $pilihan_nilai == -9 ? "checked" : "" ?>>9</label>
                                                            <label class="btn btn-success <?= $pilihan_nilai == -8 ? "active" : "" ?>"><input type="radio" id="radio_b_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="-8" <?= $pilihan_nilai == -8 ? "checked" : "" ?>>8</label>
                                                            <label class="btn btn-success <?= $pilihan_nilai == -7 ? "active" : "" ?>"><input type="radio" id="radio_c_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="-7" <?= $pilihan_nilai == -7 ? "checked" : "" ?>>7</label>
                                                            <label class="btn btn-success <?= $pilihan_nilai == -6 ? "active" : "" ?>"><input type="radio" id="radio_d_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="-6" <?= $pilihan_nilai == -6 ? "checked" : "" ?>>6</label>
                                                            <label class="btn btn-success <?= $pilihan_nilai == -5 ? "active" : "" ?>"><input type="radio" id="radio_e_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="-5" <?= $pilihan_nilai == -5 ? "checked" : "" ?>>5</label>
                                                            <label class="btn btn-success <?= $pilihan_nilai == -4 ? "active" : "" ?>"><input type="radio" id="radio_f_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="-4" <?= $pilihan_nilai == -4 ? "checked" : "" ?>>4</label>
                                                            <label class="btn btn-success <?= $pilihan_nilai == -3 ? "active" : "" ?>"><input type="radio" id="radio_g_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="-3" <?= $pilihan_nilai == -3 ? "checked" : "" ?>>3</label>
                                                            <label class="btn btn-success <?= $pilihan_nilai == -2 ? "active" : "" ?>"><input type="radio" id="radio_h_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="-2" <?= $pilihan_nilai == -2 ? "checked" : "" ?>>2</label>
                                                            <label class="btn btn-success <?= $pilihan_nilai == 1 ? "active" : "" ?>"><input type="radio" id="radio_i_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="1" <?= $pilihan_nilai == 1 ? "checked" : "" ?>>1</label>
                                                            <label class="btn btn-success <?= $pilihan_nilai == 2 ? "active" : "" ?>"><input type="radio" id="radio_j_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="2" <?= $pilihan_nilai == 2 ? "checked" : "" ?>>2</label>
                                                            <label class="btn btn-success <?= $pilihan_nilai == 3 ? "active" : "" ?>"><input type="radio" id="radio_k_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="3" <?= $pilihan_nilai == 3 ? "checked" : "" ?>>3</label>
                                                            <label class="btn btn-success <?= $pilihan_nilai == 4 ? "active" : "" ?>"><input type="radio" id="radio_l_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="4" <?= $pilihan_nilai == 4 ? "checked" : "" ?>>4</label>
                                                            <label class="btn btn-success <?= $pilihan_nilai == 5 ? "active" : "" ?>"><input type="radio" id="radio_m_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="5" <?= $pilihan_nilai == 5 ? "checked" : "" ?>>5</label>
                                                            <label class="btn btn-success <?= $pilihan_nilai == 6 ? "active" : "" ?>"><input type="radio" id="radio_n_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="6" <?= $pilihan_nilai == 6 ? "checked" : "" ?>>6</label>
                                                            <label class="btn btn-success <?= $pilihan_nilai == 7 ? "active" : "" ?>"><input type="radio" id="radio_o_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="7" <?= $pilihan_nilai == 7 ? "checked" : "" ?>>7</label>
                                                            <label class="btn btn-success <?= $pilihan_nilai == 8 ? "active" : "" ?>"><input type="radio" id="radio_p_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="8" <?= $pilihan_nilai == 8 ? "checked" : "" ?>>8</label>
                                                            <label class="btn btn-success <?= $pilihan_nilai == 9 ? "active" : "" ?>"><input type="radio" id="radio_q_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="9" <?= $pilihan_nilai == 9 ? "checked" : "" ?>>9</label>
                                                        </div>
                                                    </td>
                                                    <td class="text-left"><?= $row2->nama ?></td>
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
                                            <a href="#" data-href="<?= site_url('nilai/reset') ?>" data-toggle="modal" data-target="#confirm-reset" class="btn btn-danger">Reset</a>
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
                            <h3>Matriks Nilai nilai (Normalisasi)</h3>
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
                <p>Anda yakin akan mengatur ulang semua nilai perbandingan nilai ini ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a class="btn btn-danger btn-ok">Reset</a>
            </div>
        </div>
    </div>
</div>
<?= $this->load->view('template/footer', '', TRUE) ?>