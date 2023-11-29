<?php
if ($_SESSION['level'] != '2') {
    header('Location: login.php');
    exit;
}

if (isset($_GET['no'])) {
    $no = $_GET["no"];

    $queryPesanan  = "SELECT * FROM pesanan WHERE no_pesanan='$no'";
    $resultPesanan = mysqli_query($koneksi, $queryPesanan);

    if (!$resultPesanan) {
        die("Query failed: " . mysqli_error($koneksi));
    }

    $dataPesanan = mysqli_fetch_assoc($resultPesanan);

    if (!$dataPesanan) {
        echo "<script>alert('Data tidak ditemukan pada database');window.location='?page=pesanan';</script>";
    }
} else {
    echo "<script>alert('Masukkan nomor pesanan.');window.location='?page=pesanan';</script>";
}

?>
<!-- Content -->
<div class="container mt-3">
    <div class="row">
        <div class="col-md-12 mt-3">
            <h3 class="text-dark">
                Detail Pesanan
            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card shadow-none border border-primary mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-1">
                            <p class="card-text">
                                No Pesanan
                            </p>
                        </div>
                        <div class="col-lg-11">
                            <b>
                                : <?= $no; ?>
                            </b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-1">
                            <p class="card-text">
                                Nama
                            </p>
                        </div>
                        <div class="col-lg-11">
                            <b>
                                : <?= $dataPesanan['nama'] ?>
                            </b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-1">
                            <p class="card-text">
                                No HP
                            </p>
                        </div>
                        <div class="col-lg-11">
                            <b>
                                : <?= $dataPesanan['no_hp'] ?>
                            </b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-1">
                            <p class="card-text">
                                Alamat
                            </p>
                        </div>
                        <div class="col-lg-11">
                            <b>
                                : <?= $dataPesanan['alamat'] ?>
                            </b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- <a href="page/pesanan/cetak_detail.php?no=<?= $no; ?>" target="_blank" class="btn rounded-pill btn-warning text-dark">Cetak</a> -->
                        </div>
                    </div>
                    <div class="table-responsive text-nowrap mt-1">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>QTY</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php
                                $no = 1;
                                $id = $dataPesanan['id'];
                                // $query = "SELECT * FROM detail_pesanan WHERE id_pesanan = '$id'";
                                $queryDetailPesanan = "SELECT detail_pesanan.*, produk.nama as nama_produk, produk.harga as harga_produk
                                            FROM detail_pesanan
                                            JOIN produk ON detail_pesanan.id_produk = produk.id
                                            WHERE detail_pesanan.id_pesanan = '$id';
                                        ";
                                $resultDetailPesanan = mysqli_query($koneksi, $queryDetailPesanan);


                                if (!$resultDetailPesanan) {
                                    die("Query failed: " . mysqli_error($koneksi));
                                }

                                while ($rowDetailPesanan = mysqli_fetch_assoc($resultDetailPesanan)) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $rowDetailPesanan['nama_produk']; ?></td>
                                        <td><?= number_format($rowDetailPesanan['harga_produk'], 0, ',', '.'); ?></td>
                                        <td><?= $rowDetailPesanan['qty']; ?></td>
                                        <td align="right"><?= number_format($rowDetailPesanan['harga_produk'] * $rowDetailPesanan['qty'], 0, ',', '.'); ?></td>
                                    </tr>
                                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                                    <p hidden><?php $id_produk = $rowDetailPesanan['id_produk']; ?></p>
                                    <p hidden><?php $id_user = $dataPesanan['id_user']; ?></p>
                                    <?php
                                    $ratings_query = mysqli_query($koneksi, "SELECT * FROM penilaian WHERE id_produk='$id_produk' AND id_user='$id_user'");
                                    $hasRated = mysqli_num_rows($ratings_query) > 0; // Cek apakah sudah ada penilaian
                                    ?>
                                    <?php if ($dataPesanan['keterangan'] === 'Dalam Pengiriman' && !$hasRated && $no == 2) : ?>
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal_<?= $rowDetailPesanan['id_produk']; ?>">Berikan Penilaian</button>
                                    <?php endif; ?>
                                    <!-- Modal -->
                                    <div class="modal fade" id="myModal_<?= $rowDetailPesanan['id_produk']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Form Penilaian</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Isi form penilaian di sini -->
                                                    <form action="" method="POST">
                                                        <input type="hidden" value="<?= $rowDetailPesanan['id_produk'] ?>" name="id_produk">
                                                        <input name="id_user" type="hidden" value="<?= $dataPesanan['id_user'] ?>">
                                                        <input type="hidden" id="rating_<?= $rowDetailPesanan['id_produk'] ?>" name="nilai" value="0">
                                                        <div class="rating">
                                                            <label for="star1_<?= $rowDetailPesanan['id_produk'] ?>" class="star" onclick="setRating(1, <?= $rowDetailPesanan['id_produk'] ?>)">&#9733;</label>
                                                            <label for="star2_<?= $rowDetailPesanan['id_produk'] ?>" class="star" onclick="setRating(2, <?= $rowDetailPesanan['id_produk'] ?>)">&#9733;</label>
                                                            <label for="star3_<?= $rowDetailPesanan['id_produk'] ?>" class="star" onclick="setRating(3, <?= $rowDetailPesanan['id_produk'] ?>)">&#9733;</label>
                                                            <label for="star4_<?= $rowDetailPesanan['id_produk'] ?>" class="star" onclick="setRating(4, <?= $rowDetailPesanan['id_produk'] ?>)">&#9733;</label>
                                                            <label for="star5_<?= $rowDetailPesanan['id_produk'] ?>" class="star" onclick="setRating(5, <?= $rowDetailPesanan['id_produk'] ?>)">&#9733;</label>
                                                        </div>
                                                        <textarea name="komentar" class="form-control mb-2" placeholder="Komentar"></textarea>
                                                        <input class="btn btn-warning" type="submit" value="Kirim" name="submit_nilai">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    require_once './koneksi.php';

                                    try {
                                        $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
                                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    } catch (PDOException $e) {
                                        die("Kesalahan koneksi database: " . $e->getMessage());
                                    }

                                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_nilai'])) {
                                        $product_id = filter_input(INPUT_POST, 'id_produk', FILTER_VALIDATE_INT);
                                        $user_id = filter_input(INPUT_POST, 'id_user', FILTER_VALIDATE_INT);
                                        $rating = filter_input(INPUT_POST, 'nilai', FILTER_VALIDATE_INT);
                                        $description = filter_input(INPUT_POST, 'komentar', FILTER_SANITIZE_STRING);

                                        if ($product_id !== false && $user_id !== false && $rating !== false) {
                                            // Periksa apakah sudah ada penilaian sebelumnya
                                            $stmt = $pdo->prepare("SELECT * FROM penilaian WHERE id_produk = ? AND id_user = ?");
                                            $stmt->execute([$product_id, $user_id]);
                                            $existingRating = $stmt->fetch();

                                            if ($existingRating) {
                                                echo "<script>alert('anda sudah memberi penilaian pada produk ini sebelumnya');</script>";
                                                echo "<script>window.location.href='?page=pesanan'</script>";
                                            } else {
                                                // Simpan penilaian baru ke dalam tabel penilaian
                                                $insertStmt = $pdo->prepare("INSERT INTO penilaian (id_produk, id_user, nilai, komentar) VALUES (?, ?, ?, ?)");
                                                $insertStmt->execute([$product_id, $user_id, $rating, $description]);


                                                echo "<script>alert('Terima kasih telah memberikan penilaian pada produk');</script>";
                                                echo "<script>window.location.href='?page=pesanan'</script>";
                                            }
                                        } else {
                                            die("Data input tidak valid.");
                                        }
                                    }
                                    ?>
                                    <script>
                                        // Fungsi untuk mengatur jumlah bintang kuning sesuai yang diklik
                                        function setRating(rating, productId) {
                                            const stars = document.querySelectorAll('.star');
                                            for (let i = 0; i < stars.length; i++) {
                                                if (i < rating) {
                                                    stars[i].classList.add('active'); // Tambahkan class 'active' untuk warna kuning
                                                } else {
                                                    stars[i].classList.remove('active'); // Hapus class 'active' untuk bintang yang tidak terpilih
                                                }
                                            }
                                            document.getElementById('rating_' + productId).value = rating; // Simpan nilai rating pada input hidden
                                        }
                                    </script>

                                    <style>
                                        .rating {
                                            display: flex;
                                        }

                                        .star {
                                            font-size: 24px;
                                            /* Atur ukuran bintang sesuai keinginan */
                                            color: black;
                                            /* Warna bintang sebelum diklik */
                                            cursor: pointer;
                                        }

                                        /* Warna kuning untuk bintang yang sudah diklik */
                                        .star.active {
                                            color: orange;
                                        }
                                    </style>
                                <?php endwhile; ?>
                                <tr>
                                    <th colspan="4">Total Harga</th>
                                    <td align="right"><b><?= number_format($dataPesanan['total_harga'], 0, ',', '.'); ?></b></td>
                                </tr>
                                <tr>
                                    <th colspan="4">Biaya Ongkir</th>
                                    <td align="right"><b><?= number_format($dataPesanan['ongkos_kirim'], 0, ',', '.'); ?></b></td>
                                </tr>
                                <tr>
                                    <th colspan="4">Total Bayar</th>
                                    <td align="right"><b><?= number_format($dataPesanan['total_bayar'], 0, ',', '.'); ?></b></td>
                                </tr>

                            </tbody>
                        </table>
                        <tr>
                            <td>
                                <div class="d-flex justify-content-end">
                                    <form action="" method="POST">
                                        <input name="id_user" type="hidden" class="form-control" value="<?= $dataPesanan['id_user'] ?>">
                                        <input name="id" type="hidden" class="form-control" value="<?= $dataPesanan['id']; ?>">
                                        <button name="diterima" type="submit" class="btn  <?= $dataPesanan['keterangan'] == 'Pesanan diterima' ? 'btn-success disabled' : 'btn-warning'; ?>" id="btn-pilih-pembayaran"><?php if ($dataPesanan['keterangan'] == 'Dalam Pengiriman') {
                                                                                                                                                                                                                            $statusPengiriman = 'Konfirmasi Penerimaan';
                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                            $statusPengiriman = $dataPesanan['keterangan'];
                                                                                                                                                                                                                        } ?> <?= $statusPengiriman ?> </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once './koneksi.php';
if (isset($_POST['diterima'])) {
    $id_user = $_POST['id_user'];
    $id = $_POST['id'];
    $statusketerangan = 'Pesanan diterima';
    $query = "UPDATE pesanan SET keterangan=? WHERE id_user=? AND id=?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "sii", $statusketerangan, $id_user, $id);
    $result = mysqli_stmt_execute($stmt);
    if ($result) {
        echo "<script>alert('Terima kasih telah mengkonfirmasi penerimaan pesanan');</script>";
        echo "<script>window.location.href='?page=pesanan'</script>";
    } else {
        echo "Terjadi kesalahan saat memperbarui data: " . mysqli_error($koneksi);
    }
    mysqli_stmt_close($stmt);
}
?>