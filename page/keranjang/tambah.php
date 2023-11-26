<?php
if ($_SESSION['level'] != '2') {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET["id"];
    $idUser = $_SESSION['id'];

    // Dapatkan id_produk saat ini dari tabel 'keranjang'
    $idProdukQuery = "SELECT id_produk FROM keranjang WHERE id_user = '$idUser' AND id = '$id'";
    $idProdukResult = mysqli_query($koneksi, $idProdukQuery);
    if (!$idProdukResult) {
        die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    }
    $idProduk = mysqli_fetch_assoc($idProdukResult)['id_produk'];

    // Dapatkan stok produk dari tabel 'produk'
    $stokQuery = "SELECT stok FROM produk WHERE id = '$idProduk'";
    $stokResult = mysqli_query($koneksi, $stokQuery);
    if (!$stokResult) {
        die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    }
    $stok = mysqli_fetch_assoc($stokResult)['stok'];

    // Dapatkan qty saat ini dari tabel 'keranjang'
    $qtyQuery = "SELECT qty FROM keranjang WHERE id_user = '$idUser' AND id = '$id'";
    $qtyResult = mysqli_query($koneksi, $qtyQuery);
    if (!$qtyResult) {
        die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    }
    $qty = mysqli_fetch_assoc($qtyResult)['qty'];

    // Lakukan pengecekan stok
    if ($qty >= $stok) {
        echo "<script>alert('Stok produk tidak mencukupi.');window.location='?page=keranjang';</script>";
    } else {
        // Tambahkan qty jika stok mencukupi
        $updateQuery = "UPDATE keranjang SET qty = qty + 1 WHERE id_user = '$idUser' AND id = '$id'";
        $updateResult = mysqli_query($koneksi, $updateQuery);
        if (!$updateResult) {
            die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
        } else {
            echo "<script>window.location='?page=keranjang';</script>";
        }
    }
} else {
    echo "<script>alert('Masukkan data id.');window.location='?page=keranjang';</script>";
}
