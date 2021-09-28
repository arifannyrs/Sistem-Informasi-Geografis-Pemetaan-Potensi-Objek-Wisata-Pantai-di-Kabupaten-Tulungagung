<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?= $this->load->view('user/header', '', TRUE) ?>
<?= $this->load->view('user/sidebar', '', TRUE) ?>
<!-- Main -->
<div id="main">

    <!-- Post -->
    <article class="post">
        <header>
            <div class="title">
                <h2><a href="#">Sistem Informasi Geografis</a></h2>
                <p>Studi Kasus Kecamatan Tanggunggunung</p>
            </div>
        </header>
        <a href="<?= base_url() ?>home" class="image featured"><img
                src="<?php echo base_url().'public/assets/images/peta.jpg'?>" alt="" /></a>
        <p></p>
    </article>

</div>

<!-- Sidebar -->
<section id="sidebar">

    <!-- Intro -->
    <section id="intro">
        <a href="#" class="logo"><img src="<?= base_url('public/assets/images/logo.png') ?>" alt="" /></a>
        <header>
            <h2><a href="<?= base_url() ?>home">SIG PANTAI</a></h2>
            <p>Sistem Informasi Geografis Pemetaan Objek Wisata Pantai di Kabupaten Tulungagung</a></p>
        </header>
    </section>

    <!-- About -->
    <section class="blurb">
        <h2>Tentang</h2>
        <p>Pada website ini dirancang suatu sistem yang dapat menentukan rekomendasi objek wisata pantai dengan
            menggunakan
            metode Analytical Hierarky Proccess (AHP) dan di implementasikan kedalam Sistem Informasi Geografis objek
            wisata
            Pantai. Penelitian ini dilakukan di kecamatan Tanggunggunung.</p>
        <ul class="actions">
            <li><a href="<?= site_url('peta')?>" class="button">Lihat Peta</a></li>
        </ul>
    </section>



<?= $this->load->view('user/js', '', TRUE) ?>
<?= $this->load->view('user/footer', '', TRUE) ?>