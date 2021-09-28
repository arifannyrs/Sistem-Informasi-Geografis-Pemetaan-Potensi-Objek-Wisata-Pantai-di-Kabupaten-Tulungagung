<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?= $this->load->view('template/header', '', TRUE) ?>
<?= $this->load->view('template/sidebar', '', TRUE) ?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Kecamatan <?= $kecamatan->kecamatan ?></h3>
            </div>
        </div>

        <div class="card">
            <div class="card-block">
                <?= form_open_multipart('kecamatan/ubah/' . $kecamatan->id_kecamatan, 'class="form-horizontal form-material"') ?>
                <h4 class="card-title">Ubah detail Kecamatan</h4>
                <?= $this->session->flashdata('success') ?>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="col-md-12">Nama Kecamatan</label>
                            <div class="col-md-12">
                                <input type="text" name="kecamatan" class="form-control form-control-line" value="<?= set_value('kecamatan', $kecamatan->kecamatan) ?>">
                                <div class="text-danger"><?= form_error('kecamatan') ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Ubah File GeoJSON</label>
                            <div class="col-md-12">
                                <?php if (empty($kecamatan->geojson)) : ?>
                                    <p>Tidak ada file</p>
                                <?php else : ?>
                                    <?= anchor('public/file/geojson/' . $kecamatan->geojson, 'Lihat', 'target=_blank'); ?>
                                <?php endif; ?>
                                <input type="file" name="userfile" class="form-control">
                                <small>*Kosongkan jika file tidak diubah</small>
                                <div class="text-danger"><?= form_error('userfile') ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Ubah Warna</label>
                            <div class="col-md-12">
                                <input type="color" name="warna" class="form-control form-control-line" value="<?= set_value('warna', $kecamatan->warna) ?>">
                                <div class="text-danger"><?= form_error('warna') ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" name="save" class="btn btn-success">Simpan</button>
                                <?= anchor('kecamatan', 'Kembali', 'class="btn btn-secondary"') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>

    </div>
    <?= $this->load->view('template/copyright', '', TRUE) ?>
</div>
</div>

<?= $this->load->view('template/js', '', TRUE) ?>
<?= $this->load->view('template/footer', '', TRUE) ?>