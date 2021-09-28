<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?= $this->load->view('template/header', '', TRUE) ?>
<?= $this->load->view('template/sidebar', '', TRUE) ?>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin="" />

<link rel="stylesheet" href="<?php echo base_url().'public/leaflet/panel/src/leaflet-panel-layers.css'?>" />
<link rel="stylesheet" href="<?php echo base_url().'public/leaflet/marker/leaflet_awesome_number_markers.css'?>" />
<link rel="stylesheet" href="<?php echo base_url().'public/leaflet/leaflet.css'?>" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.0/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-responsive-popup@0.6.4/leaflet.responsive.popup.css" />

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Peta Hasil Perhitungan AHP</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-block">
                        <div class="dropup">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Hasil Berdasarkan
                            </button>
                            <div class="dropdown-menu dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="<?= site_url('peta/keindahan')?>">Keindahan Pantai</a>
                                <a class="dropdown-item" href="<?= site_url('peta/fasilitas')?>">Fasilitas</a>
                                <a class="dropdown-item active" href="<?= site_url('peta/akses')?>">Akses</a>
                            </div>
                        </div>
                        <br>
                        <div class="card-subtitle">
                            <div id="mapid"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->load->view('template/copyright', '', TRUE) ?>
</div>
<?= $this->load->view('template/js', '', TRUE) ?>
<script src="https://unpkg.com/leaflet@1.5.0/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-responsive-popup@0.6.4/leaflet.responsive.popup.js"></script>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="
sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin="">
</script>

<script src="<?php echo base_url().'public/leaflet/panel/src/leaflet-panel-layers.js'?>"></script>
<script src="<?php echo base_url().'public/leaflet/marker/leaflet_awesome_number_markers.js'?>"></script>
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

// POLIGON KECAMATAN
<?php foreach ($kecamatan as $key => $value) { ?>

var myStyle = {
    "color": "<?php echo $value->warna?>",
    "weight": 1,
    "opacity": 0.65
};

function popUp(f, l) {
    var out = [];
    if (f.properties) {
        // for(key in f.properties){
        // }
        out.push("Desa: " + f.properties['NAMOBJ']);
        l.bindPopup(out.join("<br />"));
    }
}

var kecamatan = new L.GeoJSON.AJAX([
    "<?php echo base_url();?>public/file/geojson/<?php echo $value->geojson?>"
], {
    onEachFeature: popUp,
    style: myStyle
}).addTo(mymap);

<?php } ?>

// MARKER PANTAI
<?php foreach ($peta as $key => $value) { ?>

var popup = L.popup()
    .setContent(
        "<center><h5><b><?=$value->nama_pantai ?></b></h5><img src=<?php echo base_url();?>public/file/<?php echo $value->foto;?> width = 300 height = 200></center><br>Alamat : <?=$value->alamat ?><br><br><center><h5><a class='click' href=<?= site_url('pantai/lihat/' . $value->id_pantai) ?>>Lihat Detail</a></h5>"
    )
var link = $().click(function() {})[0];

function pickRandomColor() {
    var colors = ['red', 'yellow', 'green', 'blue', 'purple', 'orange', 'black', 'gray'];
    return colors[Math.floor(Math.random() * colors.length)];
}

(function() {
    var markers = new L.FeatureGroup().bindTooltip("<?=$value->nama_pantai ?>", {
        permanent: true,
        direction: 'bottom'
    });

    var color = pickRandomColor();
    markers.addLayer(
        new L.marker([<?= $value->latitude ?>, <?= $value->longitude ?>], {
            icon: new L.AwesomeNumberMarkers({
                number: <?= $value->peringkat_fasilitas ?>,
                markerColor: color
            })
        }).bindPopup(popup, link)
    );

    markers.addTo(mymap);
})();

<?php } ?>

var baseMaps = {
    "OpenStreetMap": osm,
    "Satelite": satelite,
};

var overLayers = {
    "Kecamatan": kecamatan,
};

L.control.layers(baseMaps, overLayers).addTo(mymap);
</script>
<?= $this->load->view('template/footer', '', TRUE) ?>