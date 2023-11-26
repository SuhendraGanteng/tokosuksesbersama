<?php
if (isset($_GET['id'])) {
    $id = $_GET["id"];

    $query  = "SELECT * FROM produk WHERE id='$id'";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($koneksi));
    }

    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        echo "<script>alert('Data tidak ditemukan pada database');window.location='?page=produk';</script>";
    }
} else {
    echo "<script>alert('Masukkan data id.');window.location='?page=produk';</script>";
}
?>

<div class="container-xxl">
<h4 class="py-3 mb-1 text-dark">
        Produk
    </h4>
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <h5 class="card-header">Edit Produk</h5>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $data['id']; ?>">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="id_kategori">Kategori</label>
                            <div class="col-sm-10">
                                <select name="id_kategori" id="id_kategori" class="form-select">
                                    <?php
                                    $no = 1;
                                    $query = "SELECT * from kategori";
                                    $result = mysqli_query($koneksi, $query);
                                    if (!$result) {
                                        die("Query failed: " . mysqli_error($koneksi));
                                    }

                                    while ($row = mysqli_fetch_assoc($result)) : ?>
                                        <option value="<?= $row['id'] ?>" <?= $data['id_kategori'] == $row['id']  ? 'selected' : '' ?>><?= $row['nama'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="id_supplier">Supplier</label>
                            <div class="col-sm-10">
                                <select name="id_supplier" id="id_supplier" class="form-select">
                                    <?php
                                    $no = 1;
                                    $query = "SELECT * from supplier";
                                    $result = mysqli_query($koneksi, $query);
                                    if (!$result) {
                                        die("Query failed: " . mysqli_error($koneksi));
                                    }

                                    while ($row = mysqli_fetch_assoc($result)) : ?>
                                        <option value="<?= $row['id'] ?>" <?= $data['id_supplier'] == $row['id']  ? 'selected' : '' ?>><?= $row['nama'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="nama">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama']; ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="harga">Harga</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="harga" name="harga" value="<?= $data['harga']; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="harga_lusin">Harga lusin</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="harga_lusin" name="harga_lusin" value="<?= $data['harga_lusin']; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="harga_kodi">Harga kodi</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="harga_kodi" name="harga_kodi" value="<?= $data['harga_kodi']; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="harga_gross">Harga gross</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="harga_gross" name="harga_gross" value="<?= $data['harga_gross']; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="stok">Stok</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="stok" name="stok" value="<?= $data['stok']; ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="berat">Berat</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="berat" name="berat" value="<?= $data['berat']; ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="keterangan">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="keterangan" name="keterangan"><?= $data['keterangan']; ?></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="gambar">Gambar</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" id="gambar" name="gambar">
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
    $id_kategori = $_POST['id_kategori'];
    $id_supplier = $_POST['id_supplier'];
    $nama = $_POST['nama'];
    $slug = str_replace(' ', '-', $nama);
    $slug = strtolower($slug);
    $harga = $_POST['harga'];
    $harga_lusin = $_POST['harga_lusin'];
    $harga_kodi = $_POST['harga_kodi'];
    $harga_gross = $_POST['harga_gross'];
    $stok = $_POST['stok'];
    $berat = $_POST['berat'];
    $keterangan = $_POST['keterangan'];
    $gambar = $_FILES['gambar']['name'];

    if ($gambar != "") {
        $allowed_types = array('png', 'jpg');
        $x = explode('.', $gambar);
        $extension = strtolower(end($x));
        $file_temp = $_FILES['gambar']['tmp_name'];
        $random_number = rand(1, 999);
        $file_name = $random_number . '-' . $gambar;

        if (in_array($extension, $allowed_types) === true) {
            move_uploaded_file($file_temp, 'assets/img/produk/' . $file_name);

            $get_data = "SELECT * FROM produk WHERE id='$id'";
            $result_data = mysqli_query($koneksi, $get_data);
            $data = mysqli_fetch_assoc($result_data);

            unlink('assets/img/produk/' . $data['gambar']);

            $query = "UPDATE produk SET id_kategori = '$id_kategori', id_supplier = '$id_supplier', nama = '$nama', slug = '$slug', harga = '$harga', harga_lusin = '$harga_lusin', harga_kodi = '$harga_kodi', harga_gross = '$harga_gross', stok = '$stok', berat = '$berat', keterangan = '$keterangan', gambar = '$file_name' WHERE id = '$id'";
            $result = mysqli_query($koneksi, $query);

            if (!$result) {
                die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
            } else {
                echo "<script>alert('Data berhasil diupdate.');window.location = '?page=produk';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location = '?page=produk&aksi=edit&id=$id';</script>";
        }
    } else {
        $query = "UPDATE produk SET id_kategori = '$id_kategori', id_supplier = '$id_supplier', nama = '$nama', slug = '$slug', harga = '$harga', harga_lusin = '$harga_lusin', harga_kodi = '$harga_kodi', harga_gross = '$harga_gross', stok = '$stok', berat = '$berat', keterangan = '$keterangan' WHERE id = '$id'";
        $result = mysqli_query($koneksi, $query);

        if (!$result) {
            die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
        } else {
            echo "<script>alert('Data berhasil diupdate.');window.location = '?page=produk';</script>";
        }
    }
}
?>