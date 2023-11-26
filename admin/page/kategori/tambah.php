<div class="container-xxl"  >
<h4 class="py-3 mb-1 text-dark">
        Kategori
    </h4>
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <h5 class="card-header">Tambah Kategori</h5>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="nama">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" required>
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
    $slug = str_replace(' ', '-', $nama);
    $slug = strtolower($slug);
    $gambar = $_FILES['gambar']['name'];

    // Periksa apakah nama kategori sudah ada dalam database
    $query_check = "SELECT * FROM kategori WHERE nama = '$nama'";
    $result_check = mysqli_query($koneksi, $query_check);

    if (mysqli_num_rows($result_check) > 0) {
        // Nama kategori sudah ada, beri pesan error
        echo "<script>alert('Nama kategori sudah ada. Tidak dapat menambahkan data kategori.');window.location='?page=kategori&aksi=tambah';</script>";
    } else {
        if ($gambar != "") {
            $allowed_types = array('png', 'jpg');
            $x = explode('.', $gambar);
            $extension = strtolower(end($x));
            $file_temp = $_FILES['gambar']['tmp_name'];
            $random_number = rand(1, 999);
            $file_name = $random_number . '-' . $gambar;

            if (in_array($extension, $allowed_types) === true) {
                move_uploaded_file($file_temp, 'assets/img/kategori/' . $file_name);

                $query  = "INSERT INTO kategori (nama, slug, gambar) VALUES ('$nama', '$slug', '$file_name')";
                $result = mysqli_query($koneksi, $query);

                if (!$result) {
                    die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                } else {
                    echo "<script>alert('Data berhasil ditambah.');window.location='?page=kategori';</script>";
                }
            } else {
                echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='?page=kategori&aksi=tambah';</script>";
            }
        } else {
            $query  = "INSERT INTO kategori (nama, slug, gambar) VALUES ('$nama', '$slug', null)";
            $result = mysqli_query($koneksi, $query);

            if (!$result) {
                die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
            } else {
                echo "<script>alert('Data berhasil ditambah.');window.location='?page=kategori';</script>";
            }
        }
    }
}

?>