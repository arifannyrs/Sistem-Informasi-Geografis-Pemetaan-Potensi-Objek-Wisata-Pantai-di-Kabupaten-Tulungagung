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
                <h2><a href="<?= site_url('peta')?>">Peta Hasil Perhitungan AHP</a></h2>
                <div class="col-6 col-12-xsmall">
                    <select name="demo-category" id="demo-category" onchange="location = this.value;">
                        <option value="">- Lihat Hasil Berdasarkan -</option>
                        <option value="<?= site_url('peta/keindahan')?>" selected="selected">Keindahan Pantai</option>
                        <option value="<?= site_url('peta/fasilitas')?>">Fasilitas</option>
                        <option value="<?= site_url('peta/akses')?>">Akses</option>
                    </select>
                </div>
            </div>
        </header>
        <div id="mapid"></div>
        <br>Berdasarkan hasil penilaian, maka Pantai Sanggar sebagai kandidat yang terpilih berdasarkan
        keindahan pantai dengan memiliki pasir putih yang bersih, air laut yang biru dan kebersihan pantai.</br>
    </article>

    <ul class="actions pagination">
        <li><a href="" class="disabled button previous">Keindahan Pantai</a></li>
        <li><a href="<?= site_url('peta/fasilitas')?>" class="button next">Fasilitas</a></li>
    </ul>

    <?= $this->load->view('user/js', '', TRUE) ?>
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
            "<center><h2><?=$value->nama_pantai ?></h2><img src=<?php echo base_url();?>public/file/<?php echo $value->foto;?> width = 300 height = 200></center><br>Alamat : <?=$value->alamat ?><br><br><center><h3><a class='click' href=<?= site_url('pantai/lihatUser/' . $value->id_pantai) ?>>Lihat Detail</a></h3>"
        )
    var link = $().click(function() {})[0];
    
    function pickRandomColor() {
        var colors = ['red', 'yellow', 'green', 'blue', 'purple', 'orange'];
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
                    number: <?= $value->peringkat_keindahan ?>,
                    markerColor: color
                })
            }).bindPopup(popup, link)
        );

        markers.addTo(mymap);
    })();

    <?php } ?>

    var baseLayers = {
        "OpenStreetMap": osm,
        "Satelite": satelite
    };

    var overLays = {
        "Kecamatan": kecamatan,
    };

    L.control.layers(baseLayers, overLays).addTo(mymap);
    </script>
    <?= $this->load->view('user/footer', '', TRUE) ?>