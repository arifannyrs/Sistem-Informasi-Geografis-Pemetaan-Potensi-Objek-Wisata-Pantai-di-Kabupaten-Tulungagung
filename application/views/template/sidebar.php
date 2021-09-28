<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li> <a class="waves-effect waves-dark" href="<?= base_url() ?>home" aria-expanded="false"><i
                            class="mdi mdi-view-dashboard"></i><span class="hide-menu">Beranda</span></a>
                </li>
                <li> <a class="waves-effect waves-dark" href="<?= site_url('peta')?>" aria-expanded="false"><i
                            class="mdi mdi-earth"></i><span class="hide-menu">Peta</span></a>
                </li>

                <?php if ($this->session->userdata('role') == 'Admin') : ?>
                <li> <a class="waves-effect waves-dark" href="<?= site_url('pengguna') ?>" aria-expanded="false"><i
                            class="mdi mdi-account"></i><span class="hide-menu">Pengguna</span></a>
                </li>
                <li> <a class="waves-effect waves-dark" href="<?= site_url('kecamatan') ?>" aria-expanded="false"><i
                            class="mdi mdi-home-outline"></i><span class="hide-menu">Kecamatan</span></a>
                </li>
                <li> <a class="waves-effect waves-dark" href="<?= site_url('jenis') ?>" aria-expanded="false"><i
                            class="mdi mdi-wallet-travel"></i><span class="hide-menu">Jenis Objek WIsata</span></a>
                </li>
                <li> <a class="waves-effect waves-dark" href="<?= site_url('pantai') ?>" aria-expanded="false"><i
                            class="mdi mdi-beach"></i><span class="hide-menu">Pantai</span></a>
                </li>
                <li> <a class="waves-effect waves-dark" href="<?= site_url('hasil') ?>" aria-expanded="false"><i
                            class="mdi mdi-calculator"></i><span class="hide-menu">Hasil Penilaian</span></a>
                </li>

                <?php elseif ($this->session->userdata('role') == 'Pegawai') : ?>
                <li> <a class="waves-effect waves-dark" href="<?= site_url('kriteria') ?>" aria-expanded="false"><i
                            class="mdi mdi-table"></i><span class="hide-menu">Kriteria</span></a>
                </li>
                <li> <a class="waves-effect waves-dark" href="<?= site_url('nilai') ?>" aria-expanded="false"><i
                            class="mdi mdi-format-list-numbers"></i><span class="hide-menu">Nilai</span></a>
                </li>
                <li> <a class="waves-effect waves-dark" href="<?= site_url('hasil') ?>" aria-expanded="false"><i
                            class="mdi mdi-calculator"></i><span class="hide-menu">Hasil Penilaian</span></a>
                </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</aside>