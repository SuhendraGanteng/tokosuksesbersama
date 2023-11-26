<?php
if (isset($_GET['slug'])) {
    $slug = $_GET["slug"];

    $query  = "SELECT * FROM produk WHERE slug='$slug'";
    $result = mysqli_query($koneksi, $query);
    // Menampilkan semua rating untuk produk ini

    if (!$result) {
        die("Query failed: " . mysqli_error($koneksi));
    }

    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        echo "<script>alert('Data tidak ditemukan pada database');window.location='index.php';</script>";
    }
} else {
    echo "<script>alert('Masukkan data slug.');window.location='index.php';</script>";
}

if ($_SESSION['level'] != '2') {
    header('Location: login.php');
    exit;
}

?>
<!-- Content -->
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-1">
            <p hidden><?= $id_produk = $data['id']; ?></p>
            <h3>
                <p class="text-dark">Detail Produk</p>
            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-1 ">
            <div class="card mb-3">

                <div class="row g-0">
                    <div class="col-md-4">
                        <img class="card-img card-img-left" src="admin/assets/img/produk/<?= $data['gambar'] ?>" alt="<?= $data['nama'] ?>">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $data['nama'] ?></h5>

                            <!-- Harga dinamis -->

                            <!-- <p class="card-text">Berat <b><?= $data['berat'] ?></b> Gram</p> -->

                            <!-- Tambahkan combobox pilihan -->
                            <form action="" method="post">
                            <div class="form-group row">
                                    <label class="col-form-label col-sm-2">Stok</label>
                                    <div class="col-sm-3">
                                    <p class="card-text"><?= $data['stok'] ?></p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="harga" class="col-form-label col-sm-2">Harga</label>
                                    <div class="col-sm-3">
                                        <p id="hargaP">Rp <?= number_format((float)$data['harga'], 0, ',', '.') ?></p>
                                        <input type="hidden" id="harga" name="harga" value="<?= (float)$data['harga'] ?>" class="form-control fs-5" readonly>
                                    </div>
                                </div>


                                <!-- Tambahkan elemen p setelah subtotal harga -->
                                <div class="form-group row">
                                    <label for="subtotalharga" class="col-sm-2 col-form-label">Subtotal Harga</label>
                                    <div class="col-sm-8">

                                        <p id="subtotalhargaP"> Rp <?= number_format((float)$data['harga'], 0, ',', '.') ?></p>
                                        <input type="hidden" id="subtotalharga" name="harga" value="<?= (float)$data['harga'] ?>" class="form-control fs-5" readonly>
                                    </div>
                                </div>

                                <!-- Tambahkan elemen p setelah berat -->
                                <div class="form-group row">
                                    <label for="berat" class="col-sm-2 col-form-label">Berat</label>
                                    <div class="col-sm-8">
                                        <p id="beratP"><?= $data['berat'] ?></p>
                                        <input type="hidden" id="berat" name="berat" value="<?= $data['berat'] ?>" class="form-control fs-5" readonly>
                                    </div>
                                </div>

                                <!-- Tambahkan elemen p setelah jumlah tampung -->
                                <div class="form-group row">
                                    <label for="jumlahtampung" class="col-sm-2 col-form-label">Jumlah</label>
                                    <div class="col-sm-8">
                                        <p id="jumlahtampungP">1</p>
                                        <input type="hidden" id="jumlahtampung" name="qty" value="1" class="form-control fs-5" readonly>
                                    </div>
                                </div>
                            <p class="card-text"><small class="text-dark"><?= $data['keterangan'] ?></small></p>

                                <div class="mb-3 col-md-4">
                                    <div class="input-group">
                                        <select class="form-select" id="satuan" name="satuan" onchange="updateHarga()">
                                            <?php if ($data['harga'] > 0) : ?>
                                                <option value="1">Pcs </option>
                                            <?php endif; ?>
                                            <?php if ($data['harga_lusin'] > 0) : ?>
                                                <option value="12">Lusin </option>
                                            <?php endif; ?>
                                            <?php if ($data['harga_kodi'] > 0) : ?>
                                                <option value="20">Kodi </option>
                                            <?php endif; ?>
                                            <?php if ($data['harga_gross'] > 0) : ?>
                                                <option value="144">Gross </option>
                                            <?php endif; ?>
                                        </select>
                                        &nbsp;
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-default border-dark" onclick="decrementJumlah()">-</button>
                                        </div>

                                        <div class="col-md-2">
                                            <input type="text" id="jumlah" name="jumlah" class="form-control border-dark" value="1" readonly>
                                        </div>
                                        <div class="input-group-btn">
                                            <button type="button" class="btn border-dark" onclick="incrementJumlah()">+</button>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" name="tambah-keranjang" class="btn btn-white border-dark text-dark">Tambahkan ke Keranjang</button>
                            </form>
                            <!-- Include Bootstrap JavaScript jika diperlukan -->
                            <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->

                            <script>
                                function updateHarga() {
                                    var satuan = parseInt(document.getElementById("satuan").value);
                                    var hargaP = document.getElementById("hargaP");
                                    var inputHarga = document.getElementById("harga");
                                    var inputSubtotalHarga = document.getElementById("subtotalharga");
                                    var inputBerat = document.getElementById("berat");
                                    var inputJumlah = document.getElementById("jumlah");
                                    var inputJumlahTampung = document.getElementById("jumlahtampung");
                                    var harga = parseInt('<?= $data['harga'] ?>');
                                    var hargaLusin = parseInt('<?= $data['harga_lusin'] ?>');
                                    var hargaKodi = parseInt('<?= $data['harga_kodi'] ?>');
                                    var hargaGross = parseInt('<?= $data['harga_gross'] ?>');
                                    var berat = <?= $data['berat'] ?>;
                                    var totalHarga = 0;
                                    var jumlah = parseInt(inputJumlah.value);
                                    var jumlahTampung = 1;

                                    if (satuan == 1) {
                                        totalHarga = harga;
                                        jumlahTampung = 1;
                                    } else if (satuan == 12) {
                                        totalHarga = hargaLusin;
                                        jumlahTampung = 12;
                                    } else if (satuan == 20) {
                                        totalHarga = hargaKodi;
                                        jumlahTampung = 20;
                                    } else if (satuan == 144) {
                                        totalHarga = hargaGross;
                                        jumlahTampung = 144;
                                    }

                                    var beratTotal = berat * satuan * jumlah;
                                    var subtotalHarga = totalHarga * jumlah;
                                    var jumlahTampungTotal = jumlahTampung * jumlah;
                                    var subtotalHargaFormatted = 'Rp ' + new Intl.NumberFormat('id-ID').format(subtotalHarga);

                                    // Format harga yang ditampilkan dalam elemen hargaP
                                    var hargaFormatted = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalHarga);
                                    hargaP.textContent = hargaFormatted;

                                    inputHarga.value = totalHarga;
                                    document.getElementById("subtotalhargaP").textContent = subtotalHargaFormatted;
                                    inputSubtotalHarga.value = subtotalHarga;
                                    document.getElementById("beratP").textContent = beratTotal;
                                    inputBerat.value = beratTotal;
                                    document.getElementById("jumlahtampungP").textContent = jumlahTampungTotal;
                                    inputJumlahTampung.value = jumlahTampungTotal;
                                }

                                function decrementJumlah() {
                                    var inputJumlah = document.getElementById("jumlah");
                                    var currentJumlah = parseInt(inputJumlah.value);

                                    if (currentJumlah > 1) {
                                        currentJumlah -= 1;
                                    }

                                    inputJumlah.value = currentJumlah;
                                    updateHarga();
                                }

                                function incrementJumlah() {
                                    var inputJumlah = document.getElementById("jumlah");
                                    var currentJumlah = parseInt(inputJumlah.value);

                                    currentJumlah += 1;

                                    inputJumlah.value = currentJumlah;
                                    updateHarga();
                                }
                            </script>
                        </div>
                    </div>

                    <?php
                    $ratings_query = mysqli_query($koneksi, "SELECT * FROM penilaian WHERE id_produk='$id_produk'");
                    ?>
                    <style>
                        /* Gaya CSS untuk bintang kuning */
                        .rating {
                            color: orange;
                            font-size: 24px;
                        }

                        .ratingnull {
                            color: black;
                            font-size: 24px;
                        }
                    </style>

                    <?php
                    while ($rating = mysqli_fetch_array($ratings_query)) {
                        // Mengambil data pengguna yang memberikan rating
                        $id_pengguna = $rating['id_user'];
                        $user_query = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id_pengguna'");
                        $user_data = mysqli_fetch_array($user_query);

                        // Ambil nilai rating dari $rating
                        $rating_value = $rating['nilai'];
                        $user_name = $user_data['nama'];
                        // $qty = $rating['qty'];
                        $rating_description = $rating['komentar'];
                    ?>

                        <div class="col-md-12 mt-1">
                            <div class="container">
                                <!-- Informasi  pengguna yang memberikan rating -->
                                <?= $user_name ?>

                                <!-- Tampilkan rating dalam bentuk bintang kuning -->
                                <div class='card-text'>
                                    <?php
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $rating_value) {
                                            echo "<span class='rating'>&#9733;</span>"; // Menampilkan bintang kuning (★)
                                        } else {
                                            echo "<span class='ratingnull'>&#9734;</span>"; // Menampilkan bintang kosong (☆)
                                        }
                                    }
                                    ?>
                                </div>
                                <!-- Tampilkan deskripsi -->
                                <div class='card-text'><?= $rating_description ?></div>
                                <hr>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>

        <?php
        if (isset($_POST['tambah-keranjang'])) {
            $idUser = $_SESSION['id'];
            $idProduk = $data['id'];
            $harga = $_POST['harga'];
            $berat = $_POST['berat'];
            $jumlahTampung = $_POST['qty'];

            // Periksa apakah produk sudah ada di keranjang
            $query = "SELECT * FROM keranjang WHERE id_user = ? AND id_produk = ?";
            $stmt = mysqli_prepare($koneksi, $query);
            mysqli_stmt_bind_param($stmt, "ii", $idUser, $idProduk);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                // Jika produk sudah ada, lakukan pembaruan qty
                $updateQuery = "UPDATE keranjang SET qty = qty + 1 WHERE id_user = ? AND id_produk = ?";
                $stmt = mysqli_prepare($koneksi, $updateQuery);
                mysqli_stmt_bind_param($stmt, "ii", $idUser, $idProduk);
                $updateResult = mysqli_stmt_execute($stmt);

                if (!$updateResult) {
                    die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                } else {
                    echo "<script>alert('Jumlah produk dalam keranjang telah diperbarui.');window.location='index.php?page=detail&slug=" . $data['slug'] . "';</script>";
                }
            } else {
                // Jika produk belum ada, lakukan penambahan
                $insertQuery = "INSERT INTO keranjang (id_user, id_produk, harga, berat, qty) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($koneksi, $insertQuery);
                mysqli_stmt_bind_param($stmt, "iiiid", $idUser, $idProduk, $harga, $berat, $jumlahTampung);
                $insertResult = mysqli_stmt_execute($stmt);

                if (!$insertResult) {
                    die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                } else {
                    echo "<script>alert('Produk telah ditambahkan ke keranjang belanja.');window.location='index.php?page=detail&slug=" . $data['slug'] . "';</script>";
                }
            }
        }
        ?>



        <!-- / Content -->