<!-- Menu -->
<section id="menu">

    <!-- Search -->
    <section>
        <form class="search" method="get" action="#">
            <input type="text" name="query" placeholder="Search" />
        </form>
    </section>

    <!-- Links -->
    <section>
        <ul class="links">
            <li>
                <a href="<?= base_url() ?>home">
                    <h3>Beranda</h3>
                    <p>Halaman Awal</p>
                </a>
            </li>
            <li>
                <a href="<?= site_url('peta')?>">
                    <h3>Peta</h3>
                    <p>Sebaran pantai</p>
                </a>
            </li>
        </ul>
    </section>

    <!-- Actions -->
    <section>
        <ul class="actions stacked">
            <li><a href="<?= site_url('password') ?>" class="button large fit">Ganti Password</a></li>
            <li><a href="<?= site_url('login/logout') ?>" class="button large fit">Keluar</a></li>
        </ul>
    </section>

</section>