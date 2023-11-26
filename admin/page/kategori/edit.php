<?php
if (isset($_GET['id'])) {
    $id = $_GET["id"];

    $query  = "SELECT * FROM kategori WHERE id='$id'";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($koneksi));
    }

    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        echo "<script>alert('Data tidak ditemukan pada database');window.location='?page=kategori';</script>";
    }
} else {
    echo "<script>alert('Masukkan data id.');window.location='?page=kategori';</script>";
}
?>

<div class="container-xxl">
<h4 class="py-3 mb-1 text-dark">
        Kategori
    </h4>
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <h5 class="card-header">Edit Kategori</h5>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $data['id']; ?>">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="nama">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama']; ?>" required>
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
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $slug = str_replace(' ', '-', $nama);
    $slug = strtolower($slug);
    $gambar = $_FILES['gambar']['name'];

    if ($gambar != "") {
        $allowed_types          = array('png', 'jpg');
        $x                      = explode('.', $gambar);
        $extension              = strtolower(end($x));
        $file_temp              = $_FILES['gambar']['tmp_name'];
        $random_number          = rand(1, 999);
        $file_name              = $random_number . '-' . $gambar;

        if (in_array($extension, $allowed_types) === true) {
            move_uploaded_file($file_temp, 'assets/img/kategori/' . $file_name);

            $get_data    = "SELECT * FROM kategori WHERE id='$id'";
            $result_data = mysqli_query($koneksi, $get_data);
            $data        = mysqli_fetch_assoc($result_data);

            unlink('assets/img/kategori/' . $data['gambar']);

            $query  = "UPDATE kategori SET nama = '$nama', slug = '$slug', gambar = '$file_name' WHERE id = '$id'";
            $result = mysqli_query($koneksi, $query);

            if (!$result) {
                die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
            } else {
                echo "<script>alert('Data berhasil diupdate.');window.location='?page=kategori';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='?page=kategori&aksi=edit&id=$id';</script>";
        }
    } else {
        $query  = "UPDATE kategori SET nama = '$nama', slug = '$slug' WHERE id = '$id'";
        $result = mysqli_query($koneksi, $query);

        if (!$result) {
            die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
        } else {
            echo "<script>alert('Data berhasil diupdate.');window.location='?page=kategori';</script>";
        }
    }
}
?>