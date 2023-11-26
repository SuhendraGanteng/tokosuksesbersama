<?php
$servername = 'localhost';
$username   = 'root';
$password   = '';
$database   = 'ec_php_native';

$koneksi = mysqli_connect($servername, $username, $password, $database);

if (!$koneksi) {
    die('Connection failed: ' . mysqli_connect_error());
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

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        h3 {
            text-align: center;
        }

        .mb-0 {
            margin: 5px 5px;
        }

        .text-right {
            text-align: right;
        }

        table {
            margin-top: 20px !important;
            margin-bottom: 10px !important;
            margin: auto;
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
        }

        @media print {

            /* menghilangkan header dan footer cetakan */
            @page {
                margin: 0;
                size: auto;
                -webkit-print-color-adjust: exact;
            }

            body {
                margin: 0.5cm;
            }

            /* menghilangkan teks file:///C:/Users/MSI PC1/Desktop/index.htm */
            @page :left {
                content: "";
            }

            @page :right {
                content: "";
            }

            @page :first {
                content: "";
            }
        }
    </style>
</head>

<body>
    <p class="mb-0">Detail Pesanan: <strong><?= $no; ?></strong></p>
    <p class="mb-0">Nama: <strong><?= $dataPesanan['nama']; ?></strong></p>
    <p class="mb-0">No HP: <strong><?= $dataPesanan['no_hp']; ?></strong></p>
    <p class="mb-0">Alamat: <strong><?= $dataPesanan['alamat']; ?></strong></p>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>QTY</th>
            <th>Total</th>
        </tr>

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
    </table>

    <script>
        window.print();
    </script>

</body>

</html>