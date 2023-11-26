<?php
if ($_SESSION['level'] != '2') {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET["id"];

    $query  = "DELETE FROM keranjang WHERE id = '$id' ";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($koneksi));
    } else {
        echo "<script>alert('Data berhasil dihapus.');window.location='?page=keranjang';</script>";
    }
} else {
    echo "<script>alert('Masukkan data id.');window.location='?page=keranjang';</script>";
}
