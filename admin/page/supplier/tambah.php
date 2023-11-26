<div class="container-xxl">
<h4 class="py-3 mb-1 text-dark">
        Pemasok
    </h4>
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <h5 class="card-header">Tambah Pemasok</h5>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="nama">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="alamat">Alamat</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="alamat" name="alamat"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="keterangan">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-warning text-dark" name="simpan">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $keterangan = $_POST['keterangan'];

    // Periksa apakah nama supplier sudah ada dalam database
    $check_query = "SELECT COUNT(*) FROM supplier WHERE nama = '$nama'";
    $check_result = mysqli_query($koneksi, $check_query);

    if (!$check_result) {
        die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    }

    $row = mysqli_fetch_array($check_result);
    $supplier_exists = $row[0] > 0;

    if ($supplier_exists) {
        echo "<script>alert('Nama supplier sudah ada dalam database. Penambahan data supplier gagal.');</script>";
    } else {
        // Jika nama supplier belum ada, tambahkan data ke database
        $query  = "INSERT INTO supplier (nama, alamat, keterangan) VALUES ('$nama', '$alamat', '$keterangan')";
        $result = mysqli_query($koneksi, $query);

        if (!$result) {
            die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
        } else {
            echo "<script>alert('Data berhasil ditambah.');window.location='?page=supplier';</script>";
        }
    }
}

?>