<?php
if (isset($_GET['id'])) {
    $id = $_GET["id"];

    
    $query = "SELECT * FROM supplier WHERE id=$id";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);
    
    unlink('assets/img/supplier/' . $data['gambar']);

    $query  = "DELETE FROM supplier WHERE id='$id'";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($koneksi));
    } else {
        echo "<script>alert('Data berhasil dihapus.');window.location='?page=supplier';</script>";
    }
} else {
    echo "<script>alert('Masukkan data id.');window.location='?page=supplier';</script>";
}
