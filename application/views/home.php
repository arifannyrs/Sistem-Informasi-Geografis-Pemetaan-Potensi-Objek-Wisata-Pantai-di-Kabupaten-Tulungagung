<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?= $this->load->view('template/header', '', TRUE) ?>
<?= $this->load->view('template/sidebar', '', TRUE) ?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Home</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-block">
                        <h2>Selamat Datang </h2> Sistem Informasi Geografis Pemetaan Potensi Objek Wisata Pantai di Kabupateng Tulungagung. 
                        Pada website ini dirancang suatu sistem yang dapat menentukan rekomendasi objek wisata pantai dengan menggunakan
						metode Analytical Hierarky Proccess (AHP) dan di implementasikan kedalam Sistem Informasi Geografis objek wisata 
						Pantai. Penelitian ini dilakukan di kecamatan Tanggunggunung.
                    </h4>
                    </div>
                    <div class="text-center mb-4">
                       
                        <br><img src="<?php echo base_url().'public/assets/images/peta.jpg'?>" width="800px"></a></br>
                    </div>
                    <div class="text-center mb-4">
                    <span style="font-size: 2rem">
                            <b>
                                <i class="mdi mdi-beach light-logo"></i>
                            </b>
                            <span class="light-logo"><strong>SIG</strong> PANTAI</span>
                        </span>
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