<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?= $this->load->view('template/header', '', TRUE) ?>
<?= $this->load->view('template/sidebar', '', TRUE) ?>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin="" />

<link rel="stylesheet" href="<?php echo base_url().'public/leaflet/panel/src/leaflet-panel-layers.css'?>" />

<style type="text/css">
#mapid {
    height: 400px;
    width: 600px;
}
</style>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Pantai</h3>
            </div>
        </div>

        <div class="card">
            <div class="card-block">
                <?= form_open_multipart('pantai/tambah', 'class="form-horizontal form-material"') ?>
                <h4 class="card-title">Tambah Objek Wisata Pantai</h4>
                <?= $this->session->flashdata('success') ?>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="col-md-12">Nama Pantai</label>
                            <div class="col-md-12">
                                <input type="text" name="nama_pantai" class="form-control form-control-line" value="<?= set_value('nama_pantai') ?>">
                                <div class="text-danger"><?= form_error('nama_pantai') ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Alamat</label>
                            <div class="col-md-12">
                                <input type="text" name="alamat" class="form-control form-control-line" value="<?= set_value('alamat') ?>">
                                <div class="text-danger"><?= form_error('alamat') ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Latitude</label>
                            <div class="col-md-12">
                                <input type="text" name="latitude" class="form-control form-control-line" value="<?= set_value('latitude') ?>">
                                <div class="text-danger"><?= form_error('latitude') ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Longitude</label>
                            <div class="col-md-12">
                                <input type="text" name="longitude" class="form-control form-control-line" value="<?= set_value('longitude') ?>">
                                <div class="text-danger"><?= form_error('longitude') ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Kecamatan</label>
                            <div class="col-md-12">
                                <select name="id_kecamatan" class="form-control form-control-line">
                                    <option value="">Pilih...</option>
                                    <?php foreach ($kecamatan as $row) : ?>
                                        <option value="<?= $row->id_kecamatan ?>" <?= set_select('id_kecamatan', $row->id_kecamatan) ?>><?= $row->kecamatan ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="text-danger"><?= form_error('id_kecamatan') ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Tambahkan Foto</label>
                            <div class="col-md-12">
                                <input type="file" name="userfile" class="form-control">
                                <small>Ukuran maksimal 2MB</small>
                                <div class="text-danger"><?= form_error('userfile') ?></div>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label class="col-md-12">Tambahkan Foto Fasilitas</label>
                            <div class="col-md-12">
                                <input type="file" name="userfile" class="form-control">
                                <small>Ukuran maksimal 2MB</small>
                                <div class="text-danger"><?= form_error('userfile') ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Tambahkan Foto Akses</label>
                            <div class="col-md-12">
                                <input type="file" name="userfile" class="form-control">
                                <small>Ukuran maksimal 2MB</small>
                                <div class="text-danger"><?= form_error('userfile') ?></div>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label class="col-md-12">Jenis Wisata</label>
                            <div class="col-md-12">
                                <select name="id_jenis" class="form-control form-control-line">
                                    <option value="">Pilih...</option>
                                    <?php foreach ($jenis as $row) : ?>
                                        <option value="<?= $row->id_jenis ?>" <?= set_select('id_jenis', $row->id_jenis) ?>><?= $row->jenis_wisata ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="text-danger"><?= form_error('id_jenis') ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Fasilitas</label>
                            <div class="col-md-12">
                                <input type="text" name="fasilitas" class="form-control form-control-line" value="<?= set_value('fasilitas') ?>">
                                <div class="text-danger"><?= form_error('fasilitas') ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Tiket Masuk</label>
                            <div class="col-md-12">
                                <input type="text" name="tiket" class="form-control form-control-line" value="<?= set_value('tiket') ?>">
                                <div class="text-danger"><?= form_error('tiket') ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Akses</label>
                            <div class="col-md-12">
                                <input type="text" name="akses" class="form-control form-control-line" value="<?= set_value('akses') ?>">
                                <div class="text-danger"><?= form_error('akses') ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <h4>Kriteria Penilaian</h4>
                        <?php foreach ($kriteria as $row) : ?>
                            <div class="form-group">
                                <label class="col-md-12"><?= $row->nama_kriteria ?></label>
                                <div class="col-md-12">
                                    <input type="text" name="kriteria<?= $row->id_kriteria ?>" class="form-control form-control-line" value="<?= set_value('kriteria' . $row->id_kriteria) ?>" placeholder="1 - 100">
                                    <div class="text-danger"><?= form_error('kriteria' . $row->id_kriteria) ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="form-group">
                            <label class="col-md-12">Peta</label>
                            <div class="col-md-12">
                                <div id="mapid"></div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" name="save" class="btn btn-success">Simpan</button>
                                <?= anchor('pantai', 'Kembali', 'class="btn btn-secondary"') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>

    </div>
    <?= $this->load->view('template/copyright', '', TRUE) ?>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="
sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin="">
</script>

<script src="<?php echo base_url().'public/leaflet/panel/src/leaflet-panel-layers.js'?>"></script>
<script src="<?php echo base_url().'public/leaflet/leaflet.ajax.js'?>"></script>

<script type="text/javascript">
var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
});

var satelite = L.tileLayer(
    'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/satellite-v9'
    });

var mymap = L.map('mapid', {
    center: [-8.249925, 111.9057854],
    zoom: 12,
    layers: [osm]
});

var popup = L.popup();

function onMapClick(e) {
    popup
        .setLatLng(e.latlng)
        .setContent("Koordinat yang anda klik: <br>" + e.latlng.toString())
        .openOn(mymap);
}

mymap.on('click', onMapClick);

var baseMaps = {
    "OpenStreetMap": osm,
    "Satelite": satelite,
};

L.control.layers(baseMaps).addTo(mymap);

</script>
</div>
</div>

<?= $this->load->view('template/js', '', TRUE) ?>
<?= $this->load->view('template/footer', '', TRUE) ?>