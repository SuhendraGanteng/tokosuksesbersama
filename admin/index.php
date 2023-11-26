<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();

if($_SESSION['level'] != '1') {
    header('Location: login.php');
    exit;
}

require_once '../koneksi.php';

require_once 'template/header.php';
require_once 'template/sidebar.php';
require_once 'template/navbar.php';

$page   = $_GET['page'];
$aksi = $_GET['aksi'];

if ($page == '' || $page == 'dashboard') {
    require_once 'page/dashboard/index.php';
}

if ($page == 'kategori') {
    if ($aksi == '') {
        require_once 'page/kategori/index.php';
    } else if ($aksi == 'tambah') {
        require_once 'page/kategori/tambah.php';
    } else if ($aksi == 'edit') {
        require_once 'page/kategori/edit.php';
    } else {
        require_once 'page/kategori/hapus.php';
    }
}

if ($page == 'supplier') {
    if ($aksi == '') {
        require_once 'page/supplier/index.php';
    } else if ($aksi == 'tambah') {
        require_once 'page/supplier/tambah.php';
    } else if ($aksi == 'edit') {
        require_once 'page/supplier/edit.php';
    } else {
        require_once 'page/supplier/hapus.php';
    }
}

if ($page == 'produk') {
    if ($aksi == '') {
        require_once 'page/produk/index.php';
    } else if ($aksi == 'tambah') {
        require_once 'page/produk/tambah.php';
    } else if ($aksi == 'edit') {
        require_once 'page/produk/edit.php';
    } else {
        require_once 'page/produk/hapus.php';
    }
}

if ($page == 'pelanggan') {
    if ($aksi == '') {
        require_once 'page/pelanggan/index.php';
    }
}

if ($page == 'pesanan') {
    if ($aksi == '') {
        require_once 'page/pesanan/index.php';
    } else if ($aksi == 'detail') {
        require_once 'page/pesanan/detail.php';
    }
}

if ($page == 'logout') {
    if ($aksi == '') {
        header('Location:logout.php');
    }
}

require_once 'template/footer.php';
