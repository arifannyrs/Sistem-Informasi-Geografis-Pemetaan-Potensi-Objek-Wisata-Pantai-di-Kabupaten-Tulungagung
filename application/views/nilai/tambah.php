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
                        <h4 class="card-title">Tambah Nilai</h4>
                        <?= form_open('nilai/tambah', 'class="form-horizontal form-material"') ?>
                        <?= $this->session->flashdata('success') ?>
                        <div class="form-group">
                            <label class="col-md-12">Rentang Nilai</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" name="batas_1" placeholder="Nilai batas 1" class="form-control form-control-line" value="<?= set_value('batas_1') ?>">
                                    <input type="text" name="batas_2" placeholder="Nilai batas 2" class="form-control form-control-line" value="<?= set_value('batas_2') ?>">
                                </div>
                                <div class="text-danger"><?= form_error('batas_1') ?></div>
                                <div class="text-danger"><?= form_error('batas_2') ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Nama</label>
                            <div class="col-md-12">
                                <input type="text" name="nama" class="form-control form-control-line" value="<?= set_value('nama') ?>">
                                <div class="text-danger"><?= form_error('nama') ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" name="save" class="btn btn-success">Simpan</button>
                                <?= anchor('nilai', 'Kembali', 'class="btn btn-secondary"') ?>
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