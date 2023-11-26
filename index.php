<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();

require_once 'koneksi.php';

require_once 'template/header.php';
require_once 'template/navbar.php';

$page   = $_GET['page'];
$aksi = $_GET['aksi'];

if ($page == '' || $page == 'home') {
    require_once 'page/home/index.php';
}

if ($page == 'detail') {
    require_once 'page/detail/index.php';
}

if ($page == 'keranjang') {
    require_once 'page/keranjang/index.php';
    
    if ($aksi == 'kurang') {
        require_once 'page/keranjang/kurang.php';
    }

    if ($aksi == 'tambah') {
        require_once 'page/keranjang/tambah.php';
    }

    if ($aksi == 'hapus') {
        require_once 'page/keranjang/hapus.php';
    }
}

if ($page == 'checkout') {
    require_once 'page/checkout/index.php';
}

if ($page == 'pesanan') {    
    if ($aksi == 'detail') {
        require_once 'page/pesanan/detail.php';
    } else {
        require_once 'page/pesanan/index.php';
    }
}

require_once 'template/footer.php';
