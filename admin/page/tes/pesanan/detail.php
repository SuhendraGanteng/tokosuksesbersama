<?php
if (isset($_GET['nomor'])) {
    $nomor = $_GET["nomor"];

    $query  = "SELECT * FROM pesanan WHERE no_pesanan='$nomor'";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($koneksi));
    }

    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        echo "<script>alert('Data tidak ditemukan pada database');window.location='?page=pesanan';</script>";
    }
} else {
    echo "<script>alert('Masukkan nomor pesanan.');window.location='?page=pesanan';</script>";
}
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Detail Pesanan :</span> <?= $nomor; ?>
    </h4>
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card shadow-none border border-primary mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-1">
                            <p class="card-text">
                                Nama
                            </p>
                        </div>
                        <div class="col-lg-11">
                            <b>
                                : <?= $data['nama'] ?>
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
                                : <?= $data['no_hp'] ?>
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
                                : <?= $data['alamat'] ?>
                            </b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-1">
                            <p class="card-text">
                                No Resi
                            </p>
                        </div>
                        <div class="col-lg-11">
                            <b>
                                : <?= $data['no_resi'] ?>
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
                            <a href="page/pesanan/cetak_detail.php?nomor=<?= $nomor; ?>" target="_blank" class="btn rounded-pill btn-success">Cetak</a>
                        </div>
                    </div>
                    <div class="table-responsive text-nowrap mt-3">
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
                                $id = $data['id'];
                                // $query = "SELECT * FROM detail_pesanan WHERE id_pesanan = '$id'";
                                $query = "SELECT * FROM detail_pesanan WHERE id_pesanan = '$id'";
                                $result = mysqli_query($koneksi, $query);


                                if (!$result) {
                                    die("Query failed: " . mysqli_error($koneksi));
                                }

                                while ($row = mysqli_fetch_assoc($result)) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['nama_produk']; ?></td>
                                        <td><?= number_format($row['harga'], 0, ',', '.'); ?></td>
                                        <td><?= $row['qty']; ?></td>
                                        <td align="right"><?= number_format($row['harga'] * $row['qty'], 0, ',', '.'); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                                <tr>
                                    <th colspan="4">Total Harga</th>
                                    <td align="right"><b><?= number_format($data['total_harga'], 0, ',', '.'); ?></b></td>
                                </tr>
                                <tr>
                                    <th colspan="4">Biaya Ongkir</th>
                                    <td align="right"><b><?= number_format($data['ongkos_kirim'], 0, ',', '.'); ?></b></td>
                                </tr>
                                <tr>
                                    <th colspan="4">Total Bayar</th>
                                    <td align="right"><b><?= number_format($data['total_bayar'], 0, ',', '.'); ?></b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>