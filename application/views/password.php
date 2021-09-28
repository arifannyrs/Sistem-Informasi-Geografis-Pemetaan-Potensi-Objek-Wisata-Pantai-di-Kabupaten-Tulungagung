<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?= $this->load->view('template/header', '', TRUE) ?>
<?= $this->load->view('template/sidebar', '', TRUE) ?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Ubah Password</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-block">
                        <?= form_open('password', 'class="form-horizontal form-material"') ?>
                        <?= $this->session->flashdata('success') ?>
                        <div class="form-group">
                            <label class="col-md-12">Password Lama</label>
                            <div class="col-md-12">
                                <input type="password" name="password" class="form-control form-control-line" value="<?= set_value('password') ?>">
                                <div class="text-danger"><?= form_error('password') ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Password Baru</label>
                            <div class="col-md-12">
                                <input type="password" name="password_baru" class="form-control form-control-line" value="<?= set_value('password_baru') ?>">
                                <div class="text-danger"><?= form_error('password_baru') ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Ulangi Password Baru</label>
                            <div class="col-md-12">
                                <input type="password" name="ulangi" class="form-control form-control-line" value="<?= set_value('ulangi') ?>">
                                <div class="text-danger"><?= form_error('ulangi') ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" name="save" class="btn btn-success">Simpan</button>
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