<?php
$servername = 'localhost';
$username   = 'root';
$password   = '';
$database   = 'tokosuksesbersama';

$koneksi = mysqli_connect($servername, $username, $password, $database);

if (!$koneksi) {
    die('Connection failed: ' . mysqli_connect_error());
}

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
    <h3>Detail Pesanan - Indosegarasa</h3>

    <p class="mb-0">Detail Pesanan: <strong><?= $nomor; ?></strong></p>
    <p class="mb-0">Nama: <strong><?= $data['nama']; ?></strong></p>
    <p class="mb-0">No HP: <strong><?= $data['no_hp']; ?></strong></p>
    <p class="mb-0">Alamat: <strong><?= $data['alamat']; ?></strong></p>
    <p class="mb-0">No Resi: <strong><?= $data['no_resi']; ?></strong></p>

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
        $id = $data['id'];
        // $query = "SELECT * FROM detail_pesanan WHERE id_pesanan = '$id'";
        $query = "SELECT detail_pesanan.* FROM detail_pesanan WHERE id_pesanan = '$id'";
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
    </table>

    <script>
        window.print();
    </script>

</body>

</html>