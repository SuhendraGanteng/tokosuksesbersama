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

<div class="container-xxl mb-2">
    <h4 class="fw-bold py-3 mb-1">
        <span class="text-dark fw-light">Detail Pesanan</span>
    </h4>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body text-dark">
                    <div class="row">
                        <div class="col-lg-1">
                            <p class="card-text">
                                No Pesanan
                            </p>
                        </div>
                        <div class="col-lg-11">

                            : <?= $nomor; ?>
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

                            : <?= $data['no_resi'] ?>
                            </b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-1">
                            <p class="card-text">
                                Kurir
                            </p>
                        </div>
                        <div class="col-lg-11">

                            : <?= $data['kurir'] ?>
                            </b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-1">
                            <p class="card-text">
                                Layanan
                            </p>
                        </div>
                        <div class="col-lg-11">

                            : <?= $data['layanan'] ?>
                            </b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-1">
                            <p class="card-text">
                                Status
                            </p>
                        </div>
                        <div class="col-lg-11">

                            : <?= $data['status'] ?>
                            </b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-1">
                            <p class="card-text">
                                Keterangan
                            </p>
                        </div>
                        <div class="col-lg-11">

                            : <?= $data['keterangan'] ?>
                            </b>
                        </div>
                    </div>
                </div>
                <hr class="d-flex">
                <div class="row">
                    <div class="d-flex justify-content-end">
                        <!-- <a href="page/pesanan/cetak_detail.php?nomor=<?= $nomor; ?>" target="_blank" class="btn btn-warning text-dark">Cetak</a> &nbsp; -->
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
                        <tbody class="table-border mb-3">
                            <?php
                            $no = 1;
                            $id = $data['id'];
                            $query = "SELECT dp.nama_produk, p.harga, dp.qty
                            FROM detail_pesanan dp
                            INNER JOIN produk p ON dp.id_produk = p.id
                            WHERE dp.id_pesanan = '$id'";
                            $result = mysqli_query($koneksi, $query);

                            if (!$result) {
                                die("Query failed: " . mysqli_error($koneksi));
                            }

                            $totalHarga = 0; // Initialize the total price

                            while ($row = mysqli_fetch_assoc($result)) :
                                $productTotal = $row['harga'] * $row['qty'];
                                $totalHarga += $productTotal; // Calculate the total price

                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row['nama_produk']; ?></td>
                                    <td><?= number_format($row['harga'], 0, ',', '.'); ?></td>
                                    <td><?= $row['qty']; ?></td>
                                    <td align="right"><?= number_format($productTotal, 0, ',', '.'); ?></td>
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