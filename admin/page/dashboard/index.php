<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row p-3">
        <div class="col-lg-3 col-md-12 col-3 mb-3 ">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                    </div>
                    <span class="fw-semibold d-block mb-1">KATEGORI</span>
                    <hr>
                    <?php
                    $queryTotalKategori = "SELECT COUNT(*) AS total FROM kategori";
                    $resultTotalKategori = mysqli_query($koneksi, $queryTotalKategori);

                    if (!$resultTotalKategori) {
                        die("Query failed: " . mysqli_error($koneksi));
                    }

                    $totalKategori = mysqli_fetch_assoc($resultTotalKategori)['total'];
                    ?>
                    <h3 class="card-title mb-2"><?= $totalKategori ?></h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-12 col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                    </div>
                    <span class="fw-semibold d-block mb-1">PRODUK</span>
                    <hr>
                    <?php
                    $queryTotalProduk = "SELECT COUNT(*) AS total FROM produk";
                    $resultTotalProduk = mysqli_query($koneksi, $queryTotalProduk);

                    if (!$resultTotalProduk) {
                        die("Query failed: " . mysqli_error($koneksi));
                    }

                    $totalProduk = mysqli_fetch_assoc($resultTotalProduk)['total'];
                    ?>
                    <h3 class="card-title mb-2"><?= $totalProduk ?></h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-12 col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                    </div>
                    <span class="fw-semibold d-block mb-1">PEMASOK</span>
                    <hr>
                    <?php
                    $queryTotalSupplier = "SELECT COUNT(*) AS total FROM supplier";
                    $resultTotalSupplier = mysqli_query($koneksi, $queryTotalSupplier);

                    if (!$resultTotalSupplier) {
                        die("Query failed: " . mysqli_error($koneksi));
                    }

                    $totalSupplier = mysqli_fetch_assoc($resultTotalSupplier)['total'];
                    ?>
                    <h3 class="card-title mb-2"><?= $totalSupplier ?></h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-12 col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                    </div>
                    <span class="fw-semibold d-block mb-1">KONSUMEN</span>
                    <hr>
                    <?php
                    $queryTotalPelanggan = "SELECT COUNT(*) AS total FROM user WHERE level = 2 ";
                    $resultTotalPelanggan = mysqli_query($koneksi, $queryTotalPelanggan);

                    if (!$resultTotalPelanggan) {
                        die("Query failed: " . mysqli_error($koneksi));
                    }

                    $totalPelanggan = mysqli_fetch_assoc($resultTotalPelanggan)['total'];
                    ?>
                    <h3 class="card-title mb-2"><?= $totalPelanggan ?></h3>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="row">
        <div class="col-lg-4 col-md-12 col-4 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">Jumlah produk yang kurang dari 15</h5>
                </div>
                <div class="card-body">
                    <?php
                    $no = 1;
                    $query = "SELECT produk.*, kategori.nama as nama_kategori, supplier.nama as nama_supplier
                                FROM produk
                                JOIN kategori ON produk.id_kategori = kategori.id
                                JOIN supplier ON produk.id_supplier = supplier.id
                                WHERE produk.stok < 15;
                                ";
                    $result = mysqli_query($koneksi, $query);


                    if (!$result) {
                        die("Query failed: " . mysqli_error($koneksi));
                    }

                    while ($row = mysqli_fetch_assoc($result)) : ?>
                        <ul class="p-0 m-0">
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <a href="assets/img/produk/<?= $row['gambar']; ?>" target="_blank">
                                        <img src="assets/img/produk/<?= $row['gambar'] ?>" alt="User" class="rounded">
                                    </a>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <small class="text-muted d-block mb-1"><?= $row['nama_kategori'] ?></small>
                                        <h6 class="mb-0"><?= $row['nama'] ?></h6>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0"><?= $row['stok'] ?></h6> <span class="text-muted">Item</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div> -->
</div>