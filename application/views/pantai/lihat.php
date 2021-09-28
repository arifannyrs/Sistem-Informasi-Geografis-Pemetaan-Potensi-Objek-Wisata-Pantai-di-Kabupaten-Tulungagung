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
                        <h4 class="card-title">Detail <?= $pantai->nama_pantai ?></h4>
                        <div class="card-subtitle">
                            <?= anchor('peta', 'Kembali', 'class="btn btn-secondary"') ?>
                        </div>
                        <div>
                        <h3>Fasilitas</h3>
                            <?= $pantai->fasilitas ?>
                        </div>
                        <div>
                        <h3>Tiket Masuk</h3>
                            <?= $pantai->tiket ?>
                        </div>
                        <div>
                        <h3>Akses</h3>
                            <?= $pantai->akses ?>
                        </div>
                        <h3>GALERI</h3>
                        <span class="image fit"><img
                                src="<?php echo base_url();?>public/file/<?php echo $pantai->foto; ?>" alt="" /></span>
                        <div class="box alt">
                            <div class="row 50% uniform">
                                <div class="4u"><span class="image fit"><img
                                            src="<?php echo base_url();?>public/file/<?php echo $pantai->foto1; ?>"
                                            alt="" /></span></div>
                                <div class="4u"><span class="image fit"><img
                                            src="<?php echo base_url();?>public/file/<?php echo $pantai->foto2; ?>"
                                            alt="" /></span></div>
                                <div class="4u$"><span class="image fit"><img
                                            src="<?php echo base_url();?>public/file/<?php echo $pantai->foto3; ?>"
                                            alt="" /></span></div>
                            </div>
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