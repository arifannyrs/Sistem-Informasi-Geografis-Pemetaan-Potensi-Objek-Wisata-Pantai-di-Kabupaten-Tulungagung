<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?= $this->load->view('template/header', '', TRUE) ?>
<?= $this->load->view('template/sidebar', '', TRUE) ?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Hasil Penilaian</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title">Data Hasil Penilaian</h4>
                        <hr>
                        <?php if (empty($id_jenis)) : ?>
                            <?= form_open('hasil', 'method=get') ?>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="col-md-12">Jenis Wisata</label>
                                        <div class="col-md-12">
                                            <select name="id_jenis" class="form-control form-control-line" required>
                                                <option value="">Pilih...</option>
                                                <?php foreach ($jenis as $row) : ?>
                                                    <option value="<?= $row->id_jenis ?>" <?= set_select('id_jenis', $row->id_jenis) ?>><?= $row->jenis_wisata ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" name="proses" class="btn btn-success" value="1">Proses</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?= form_close() ?>
                        <?php else : ?>
                            <div class="table-responsive">
                                <h4>Data Alternatif</h4>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama</th>
                                            <?php foreach ($kriteria as $row) : ?>
                                                <th class="text-center"><?= $row->nama_kriteria ?></th>
                                            <?php endforeach; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 0;
                                        foreach ($pantai as $row_pantai) : ?>
                                            <tr>
                                                <td class="text-center"><?= ++$no ?></td>
                                                <td><?= $row_pantai->nama_pantai ?></td>
                                                <?php foreach ($kriteria as $row_kriteria) : ?>
                                                    <td class="text-center"><?= $nilai[$row_pantai->id_pantai][$row_kriteria->id_kriteria] ?></td>
                                                <?php endforeach; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama</th>
                                            <?php foreach ($kriteria as $row) : ?>
                                                <th class="text-center"><?= $row->nama_kriteria ?></th>
                                            <?php endforeach; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 0;
                                        foreach ($pantai as $row_pantai) : ?>
                                            <tr>
                                                <td class="text-center"><?= ++$no ?></td>
                                                <td><?= $row_pantai->nama_pantai ?></td>
                                                <?php foreach ($kriteria as $row_kriteria) : ?>
                                                    <td class="text-center"><?= $nilai_ahp[$row_pantai->id_pantai][$row_kriteria->id_kriteria] ?></td>
                                                <?php endforeach; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Data Kriteria</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th class="text-center">Kode</th>
                                                    <th class="text-center">Kriteria</th>
                                                    <th class="text-center">Prioritas</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 0;
                                                foreach ($kriteria as $row) : ?>
                                                    <tr>
                                                        <td class="text-center"><?= ++$no ?></td>
                                                        <td><?= $row->kode_kriteria ?></td>
                                                        <td><?= $row->nama_kriteria ?></td>
                                                        <td class="text-center"><?= $row->prioritas ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4>Data Nilai (Subkriteria)</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th class="text-center">Rentang Nilai</th>
                                                    <th class="text-center">Nama</th>
                                                    <th class="text-center">Prioritas</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 0;
                                                foreach ($data_nilai as $row) : ?>
                                                    <tr>
                                                        <td class="text-center"><?= ++$no ?></td>
                                                        <td class="text-center"><?= $row->batas_1 . ' - ' . $row->batas_2 ?></td>
                                                        <td><?= $row->nama ?></td>
                                                        <td class="text-center"><?= $row->prioritas ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="table-responsive">
                                <h4>Hasil Prioritas</h4>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama</th>
                                            <?php foreach ($kriteria as $row) : ?>
                                                <th class="text-center"><?= $row->kode_kriteria ?></th>
                                            <?php endforeach; ?>
                                            <th class="text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 0;
                                        foreach ($pantai as $row_pantai) :
                                            $total = 0;
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= ++$no ?></td>
                                                <td><?= $row_pantai->nama_pantai ?></td>
                                                <?php foreach ($kriteria as $row_kriteria) :
                                                    $total += $nilai_prioritas[$row_pantai->id_pantai][$row_kriteria->id_kriteria];
                                                ?>
                                                    <td class="text-center"><?= $nilai_prioritas[$row_pantai->id_pantai][$row_kriteria->id_kriteria] ?></td>
                                                <?php endforeach; ?>
                                                <td class="text-center font-weight-bold"><?= $total ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <hr>
                            <div class="table-responsive">
                                <h4>Hasil Rekomendasi</h4>
                                <?= anchor('hasil/cetak/' . $id_jenis, 'Cetak PDF', 'class="btn btn-info" target="_blank"') ?>
                                <table class="table table-striped table-bordered mt-2">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Nilai AHP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 0;
                                        foreach ($hasil as $row) :
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= ++$no ?></td>
                                                <td><?= $row['nama_pantai'] ?></td>
                                                <td class="text-center font-weight-bold"><?= $row['nilai_hasil'] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <h4>Kesimpulan</h4>
                            <p>Berdasarkan hasil penilaian, maka <strong><?= $hasil[0]['nama_pantai'] ?></strong> direkomendasikan sebagai kandidat yang terpilih.</p>
                        <?php endif; ?>
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