<!DOCTYPE HTML>
<!--
	Future Imperfect by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
    <title>SIG PANTAI</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('public/assets/images/logo.png') ?>">
    <link href="<?= base_url('public/assets-user/css/main.css') ?>" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />

    <link href="<?= base_url('public/leaflet/panel/src/leaflet-panel-layers.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/leaflet/marker/leaflet_awesome_number_markers.css') ?>" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-responsive-popup@0.6.4/leaflet.responsive.popup.css" />

</head>

<body class="is-preload">

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Header -->
        <header id="header">
            <h1><a href="<?= base_url() ?>home">SIG PANTAI</a></h1>
            <nav class="links">
                <ul>
                    <li><a href="<?= base_url() ?>home">Beranda</a></li>
                    <li><a href="<?= site_url('peta')?>">Peta</a></li>
                </ul>
            </nav>
            <nav class="main">
                <ul>
                    <li class="search">
                        <a class="fa-search" href="#search">Cari</a>
                        <form id="search" method="get" action="#">
                            <input type="text" name="query" placeholder="Search" />
                        </form>
                    </li>
                    <li class="menu">
                        <a class="fa-bars" href="#menu">Menu</a>
                    </li>
                </ul>
            </nav>
        </header>