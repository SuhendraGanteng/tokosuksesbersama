<!-- Content -->
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <form action="" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" name="keyword" placeholder="Cari nama produk..." value="<?= $_GET['keyword'] ? $_GET['keyword'] : ''  ?>">
                    <button style="background-color: white; border:2px solid grey;" class="btn text-dark" type="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>
    <center>
    <div class="col-md-9 mt-3">
        <div class="card ">
            <div class="">
                <div class="list-group list-group-flush d-flex flex-row text-center">
                    <a href="?kategori=semua-kategori" class="list-group-item list-group-item-action <?= $_GET['kategori'] == 'semua-kategori' || $_GET['kategori'] == '' ? 'text-dark' : 'text-dark' ?>" aria-current=" true">
                        Semua Kategori
                    </a>
                    <?php
                    $no = 1;
                    $query = "SELECT * from kategori";
                    $result = mysqli_query($koneksi, $query);

                    if (!$result) {
                        die("Query failed: " . mysqli_error($koneksi));
                    }
                    while ($row = mysqli_fetch_assoc($result)) : ?>
                        <a href="?kategori=<?= $row['slug'] ?>" class="list-group-item list-group-item-action <?= $_GET['kategori'] == $row['slug'] ? 'text-warning' : 'text-dark' ?>"><?= $row['nama'] ?></a>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
    </center>

    <div class="row">
        <div class="col-md-12 mt-3">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="text-white">
                        Produk Terbaru
                    </h3>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-4 g-2 mb-2">
                <?php
                $no = 1;
                // Inisialisasi variabel $no dengan nilai 1

                if (isset($_GET['kategori'])) {
                    // Memeriksa apakah parameter "kategori" ada dalam URL yang diberikan (dikirim melalui metode GET)

                    $kategori = $_GET["kategori"];
                    // Mengambil nilai parameter "kategori" dari URL dan menyimpannya dalam variabel $kategori

                    if ($kategori != 'semua-kategori') {
                        // Memeriksa apakah nilai parameter "kategori" tidak sama dengan string "semua-kategori"

                        $queryKategori  = "SELECT * FROM kategori WHERE slug = '$kategori'";
                        $resultKategori = mysqli_query($koneksi, $queryKategori);
                        // Membuat query SQL untuk mengambil data kategori berdasarkan nilai "slug" yang sesuai dengan nilai $kategori

                        if (!$resultKategori) {
                            die("Query failed: " . mysqli_error($koneksi));
                        }
                        // Menampilkan pesan error dan menghentikan eksekusi jika query kategori gagal dieksekusi

                        $dataKategori = mysqli_fetch_assoc($resultKategori);
                        // Mengambil data kategori dari hasil query dan menyimpannya dalam variabel $dataKategori

                        if (!$dataKategori) {
                            echo "<script>alert('Data tidak ditemukan pada database');window.location='index.php';</script>";
                        }
                        // Menampilkan pesan dan mengarahkan pengguna ke halaman index.php jika data kategori tidak ditemukan

                        $idKategori = $dataKategori['id'];
                        // Mengambil nilai id dari data kategori dan menyimpannya dalam variabel $idKategori

                        $query = "SELECT * from produk WHERE id_kategori = '$idKategori'";
                        $result = mysqli_query($koneksi, $query);
                        // Membuat query SQL untuk mengambil data produk berdasarkan id_kategori yang sesuai dengan $idKategori

                        if (!$result) {
                            die("Query failed: " . mysqli_error($koneksi));
                        }
                        // Menampilkan pesan error dan menghentikan eksekusi jika query produk gagal dieksekusi

                    } else {
                        $query = "SELECT * from produk";
                        $result = mysqli_query($koneksi, $query);
                        // Membuat query SQL untuk mengambil semua data produk

                        if (!$result) {
                            die("Query failed: " . mysqli_error($koneksi));
                        }
                        // Menampilkan pesan error dan menghentikan eksekusi jika query produk gagal dieksekusi
                    }
                } else if (isset($_GET['keyword'])) {
                    // Memeriksa apakah parameter "keyword" ada dalam URL yang diberikan (dikirim melalui metode GET)

                    $keyword = $_GET['keyword'];
                    // Mengambil nilai parameter "keyword" dari URL dan menyimpannya dalam variabel $keyword

                    $query = "SELECT * FROM produk WHERE nama LIKE '%$keyword%'";
                    $result = mysqli_query($koneksi, $query);
                    // Membuat query SQL untuk mengambil data produk berdasarkan keyword yang sesuai dengan $keyword
                    if (!$result) {
                        die("Query failed: " . mysqli_error($koneksi));
                    }
                    // Menampilkan pesan error dan menghentikan eksekusi jika query produk gagal dieksekusi
                } else {
                    $query = "SELECT * from produk";
                    $result = mysqli_query($koneksi, $query);
                    // Membuat query SQL untuk mengambil semua data produk

                    if (!$result) {
                        die("Query failed: " . mysqli_error($koneksi));
                    }
                    // Menampilkan pesan error dan menghentikan eksekusi jika query produk gagal dieksekusi
                }

                while ($row = mysqli_fetch_assoc($result)) : ?>
                    <div class="col">
                        <a href="?page=detail&slug=<?= $row['slug']; ?>">
                            <div class="card h-100">
                                <img class="card-img-top" src="admin/assets/img/produk/<?= $row['gambar']; ?>" alt="Card image cap" width="200" height="250">
                                <div class="card-body" style="text-align:right;">
                                    <h5 class="card-title text-dark"><?= $row['nama']; ?></h5>
                                    <p class="card-text text-dark">
                                        <?php if ($row['harga'] !== null && $row['harga'] != 0) :
                                            echo 'Pcs Rp' . number_format((float)$row['harga'], 0, ',', '.') . '<br>';
                                        endif;

                                        if ($row['harga_lusin'] !== null && $row['harga_lusin'] != 0) :
                                            echo 'Lusin Rp' . number_format((float)$row['harga_lusin'], 0, ',', '.') . '<br>';
                                        endif;

                                        if ($row['harga_kodi'] !== null && $row['harga_kodi'] != 0) :
                                            echo 'Kodi Rp' . number_format((float)$row['harga_kodi'], 0, ',', '.') . '<br>';
                                        endif;

                                        if ($row['harga_gross'] !== null && $row['harga_gross'] != 0) :
                                            echo 'Gross Rp' . number_format((float)$row['harga_gross'], 0, ',', '.');
                                        endif;
                                        ?>

                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

    </div>
</div>

<!-- / Content -->