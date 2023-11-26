<?php
if (isset($_GET['id'])) {
    $id = $_GET["id"];

    $query  = "SELECT * FROM supplier WHERE id='$id'";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($koneksi));
    }

    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        echo "<script>alert('Data tidak ditemukan pada database');window.location='?page=supplier';</script>";
    }
} else {
    echo "<script>alert('Masukkan data id.');window.location='?page=supplier';</script>";
}
?>

<div class="container-xxl">
<h4 class="py-3 mb-1 text-dark">
        Pemasok
    </h4>
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <h5 class="card-header">Edit Pemasok</h5>
                <div class="card-body">
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?= $data['id']; ?>">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="nama">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama']; ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="alamat">Alamat</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="alamat" name="alamat"><?= $data['alamat']; ?></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="keterangan">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="keterangan" name="keterangan"><?= $data['keterangan']; ?></textarea>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-warning text-dark" name="update">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $keterangan = $_POST['keterangan'];

    $query  = "UPDATE supplier SET nama = '$nama', alamat = '$alamat', keterangan = '$keterangan' WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    } else {
        echo "<script>alert('Data berhasil diupdate.');window.location='?page=supplier';</script>";
    }
}
?>