<?php
if (isset($_GET['id'])) {
    $id = $_GET["id"];

    
    $query = "SELECT * FROM kategori WHERE id=$id";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);
    
    unlink('assets/img/kategori/' . $data['gambar']);

    $query  = "DELETE FROM kategori WHERE id='$id'";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($koneksi));
    } else {
        echo "<script>alert('Data berhasil dihapus.');window.location='?page=kategori';</script>";
    }
} else {
    echo "<script>alert('Masukkan data id.');window.location='?page=kategori';</script>";
}
