<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?= $this->load->view('user/header', '', TRUE) ?>
<?= $this->load->view('user/sidebar', '', TRUE) ?>

<!-- Main -->
<div id="main">

    <!-- Post -->
    <article class="post">
        <header>
            <div class="title">
                <h2><a href="<?= site_url('password')?>">Ubah Password</a></h2>
            </div>
        </header>
        <section>
            <form method="post" action="#">
                <div class="row gtr-uniform">
                    <?= form_open('password', 'class="form-horizontal form-material"') ?>
                    <?= $this->session->flashdata('success') ?>
                    <div class="col-12">
                        <input type="password" name="password" value="<?= set_value('password') ?>" placeholder="Password Lama" />
                        <div class="text-danger"><?= form_error('password') ?></div>
                    </div>
                    <div class="col-12">
                        <input type="password" name="password_baru" value="<?= set_value('password_baru') ?>" placeholder="Password Baru" />
                        <div class="text-danger"><?= form_error('password_baru') ?></div>
                    </div>
                    <div class="col-12">
                        <input type="password" name="ulangi" value="<?= set_value('ulangi') ?>" placeholder="Ulangi Password Baru" />
                        <div class="text-danger"><?= form_error('ulangi') ?></div>
                    </div>
                    <div class="col-12">
                        <ul class="actions">
                            <li><input type="submit" name= "save" value="Simpan" /></li>
                            <li><a href="<?= base_url() ?>home" class="button">Kembali</a></li>
                        </ul>
                    </div>
                </div>
            </form>
        </section>

    </article>

    <?= $this->load->view('user/js', '', TRUE) ?>
    <?= $this->load->view('user/footer', '', TRUE) ?>