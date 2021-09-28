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
                        <h4 class="card-title">Ubah Kriteria</h4>
                        <?= form_open('kriteria/ubah/' . $kriteria->id_kriteria, 'class="form-horizontal form-material"') ?>
                        <?= $this->session->flashdata('success') ?>
                        <div class="form-group">
                            <label class="col-md-12">Kode Kriteria</label>
                            <div class="col-md-12">
                                <input type="text" name="kode_kriteria" class="form-control form-control-line" value="<?= set_value('kode_kriteria', $kriteria->kode_kriteria) ?>">
                                <div class="text-danger"><?= form_error('kode_kriteria') ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Nama Kriteria</label>
                            <div class="col-md-12">
                                <input type="text" name="nama_kriteria" class="form-control form-control-line" value="<?= set_value('nama_kriteria', $kriteria->nama_kriteria) ?>">
                                <div class="text-danger"><?= form_error('nama_kriteria') ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" name="save" class="btn btn-success">Simpan</button>
                                <?= anchor('kriteria', 'Kembali', 'class="btn btn-secondary"') ?>
                            </div>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?= $this->load->view('template/copyright', '', TRUE) ?>
</div>
</div>

<?= $this->load->view('template/js', '', TRUE) ?>
<?= $this->load->view('template/footer', '', TRUE) ?>