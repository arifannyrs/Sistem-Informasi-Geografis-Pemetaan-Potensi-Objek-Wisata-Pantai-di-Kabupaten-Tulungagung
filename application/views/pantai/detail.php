<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?= $this->load->view('template/header', '', TRUE) ?>
<?= $this->load->view('template/sidebar', '', TRUE) ?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Pantai</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title">Detail Objek Wisata Pantai</h4>
                        <div class="card-subtitle">
                            <?= anchor('pantai', 'Kembali', 'class="btn btn-secondary"') ?>
                        </div>
                        <h4>Data Pantai</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <td width="30%">Nama</td>
                                    <td><?= $pantai->nama_pantai ?></td>
                                </tr>
                                <tr>
                                    <td width="30%">Alamat</td>
                                    <td><?= $pantai->alamat ?></td>
                                </tr>
                                <tr>
                                    <td width="30%">Latitude</td>
                                    <td><?= $pantai->latitude ?></td>
                                </tr>
                                <tr>
                                    <td width="30%">Longitude</td>
                                    <td><?= $pantai->longitude ?></td>
                                </tr>
                                <tr>
                                    <td width="30%">Kecamatan</td>
                                    <td><?= $pantai->kecamatan ?></td>
                                </tr>
                                <tr>
                                    <td width="30%">Foto</td>
                                    <td>
                                        <img src="<?php echo base_url();?>public/file/<?php echo $pantai->foto; ?>" width = "600" height="400">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">Jenis Wisata</td>
                                    <td><?= $pantai->jenis_wisata ?></td>
                                </tr>
                                <tr>
                                    <td width="30%">Peringkat Atraksi WIsata</td>
                                    <td><?= $pantai->peringkat ?></td>
                                </tr>
                            </table>
                        </div>
                        <h4>Kriteria Penilaian</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <?php foreach ($kriteria as $row) : ?>
                                    <tr>
                                        <td width="30%"><?= $row->nama_kriteria ?></td>
                                        <td><?= $nilai[$row->id_kriteria] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
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