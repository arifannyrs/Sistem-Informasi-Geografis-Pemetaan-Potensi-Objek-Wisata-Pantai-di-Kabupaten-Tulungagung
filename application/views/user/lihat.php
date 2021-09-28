<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?= $this->load->view('user/header', '', TRUE) ?>
<?= $this->load->view('user/sidebar', '', TRUE) ?>

<style type="text/css">
#mapid {
    height: 100vh;
}
</style>

<!-- Main -->
<div id="main">

    <!-- Post -->
    <article class="post">
        <header>
            <div class="title">
                <h2><a>Detail <?= $pantai->nama_pantai ?></a></h2>
            </div>
        </header>
        <section>
            <h3>Fasilitas</h3>
            <p> <?= $pantai->fasilitas ?></p>
            <h3>Tiket Masuk</h3>
            <p> Rp. <?= $pantai->tiket ?></p>
            <h3>Akses</h3>
            <p> <?= $pantai->akses ?></p>

            <h3>GALERI</h3>
            <div class="box alt">
                <div class="row gtr-uniform">
                    <div class="col-12"><span class="image fit"><img
                                src="<?php echo base_url();?>public/file/<?php echo $pantai->foto; ?>" alt="" /></span>
                    </div>
                    <div class="col-4"><span class="image fit"><img
                                src="<?php echo base_url();?>public/file/<?php echo $pantai->foto1; ?>" alt="" /></span>
                    </div>
                    <div class="col-4"><span class="image fit"><img
                                src="<?php echo base_url();?>public/file/<?php echo $pantai->foto2; ?>" alt="" /></span>
                    </div>
                    <div class="col-4"><span class="image fit"><img
                                src="<?php echo base_url();?>public/file/<?php echo $pantai->foto3; ?>" alt="" /></span>
                    </div>
                </div>
            </div>
        </section>
        <footer>
            <ul class="actions">
                <li><a href="<?= site_url('peta')?>" class="button large">Kembali</a></li>
            </ul>
        </footer>
    </article>

    <?= $this->load->view('user/js', '', TRUE) ?>
    <?= $this->load->view('user/footer', '', TRUE) ?>