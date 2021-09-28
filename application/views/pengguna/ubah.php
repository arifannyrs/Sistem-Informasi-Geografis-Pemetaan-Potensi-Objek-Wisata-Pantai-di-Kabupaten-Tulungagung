<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?= $this->load->view('template/header', '', TRUE) ?>
<?= $this->load->view('template/sidebar', '', TRUE) ?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Pengguna</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title">Ubah Pengguna</h4>
                        <?= form_open('pengguna/ubah/' . $pengguna->id_pengguna, 'class="form-horizontal form-material"') ?>
                        <?= form_hidden('username_tmp', $pengguna->username) ?>
                        <?= $this->session->flashdata('success') ?>
                        <div class="form-group">
                            <label class="col-md-12">Nama Lengkap</label>
                            <div class="col-md-12">
                                <input type="text" name="nama_lengkap" class="form-control form-control-line" value="<?= set_value('nama_lengkap', $pengguna->nama_lengkap) ?>">
                                <div class="text-danger"><?= form_error('nama_lengkap') ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Username</label>
                            <div class="col-md-12">
                                <input type="text" name="username" class="form-control form-control-line" value="<?= set_value('username', $pengguna->username) ?>">
                                <div class="text-danger"><?= form_error('username') ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Email</label>
                            <div class="col-md-12">
                                <input type="email" name="email" class="form-control form-control-line" value="<?= set_value('email', $pengguna->email) ?>">
                                <div class="text-danger"><?= form_error('email') ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Password</label>
                            <div class="col-md-12">
                                <input type="password" name="password" class="form-control form-control-line" value="<?= set_value('password', $pengguna->password) ?>">
                                <div class="text-danger"><?= form_error('password') ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Role</label>
                            <div class="col-md-12">
                                <select name="role" class="form-control form-control-line">
                                    <option value="">Pilih...</option>
                                    <option value="Admin" <?= set_select('role', 'Admin', $pengguna->role == 'Admin' ? TRUE : FALSE) ?>>Admin</option>
                                    <option value="Pegawai" <?= set_select('role', 'Pegawai', $pengguna->role == 'Pegawai' ? TRUE : FALSE) ?>>Pegawai</option>
                                    <option value="User" <?= set_select('role', 'User', $pengguna->role == 'User' ? TRUE : FALSE) ?>>User</option>
                                </select>
                                <div class="text-danger"><?= form_error('role') ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" name="save" class="btn btn-success">Simpan</button>
                                <?= anchor('pengguna', 'Kembali', 'class="btn btn-secondary"') ?>
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