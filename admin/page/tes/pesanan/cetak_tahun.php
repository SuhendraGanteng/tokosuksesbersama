<?php
$servername = 'localhost';
$username   = 'root';
$password   = '';
$database   = 'indosegarasa';

$koneksi = mysqli_connect($servername, $username, $password, $database);

if (!$koneksi) {
    die('Connection failed: ' . mysqli_connect_error());
}

$year = isset($_GET['year']) ? $_GET['year'] : null;

$query = "SELECT * FROM pesanan";

if ($year) {
    // Membuat tanggal awal dan akhir berdasarkan tahun yang dipilih
    $start_date = $year . '-01-01';
    $end_date = $year . '-12-31';

    $query .= " WHERE tanggal BETWEEN '$start_date' AND '$end_date'";
}

$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        h3 {
            text-align: center;
        }

        table {
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

    <h3>Pesanan</h3>
    <?php
    if ($year) {
        echo "<p>Tahun Cetakan: $year</p>";
    }
    ?>
    <table>
        <tr>
            <th>No</th>
            <th>No Pesanan</th>
            <th>No Resi</th>
            <th>Nama</th>
            <th>No HP</th>
            <th>Kurir</th>
            <th>Layanan</th>
            <th>Total Bayar</th>
            <th>Status</th>
            <th>Tanggal</th>
        </tr>

        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['no_pesanan']; ?></td>
                <td><?= $row['no_resi']; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['no_hp']; ?></td>
                <td><?= $row['kurir']; ?></td>
                <td><?= $row['layanan']; ?></td>
                <td><?= number_format($row['total_bayar'], 0, ',', '.') ?></td>
                <td><?= $row['status'] ?></td>
                <td><?= date('j M Y', strtotime($row['tanggal'])); ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <script>
        window.print();
    </script>

</body>

</html>
