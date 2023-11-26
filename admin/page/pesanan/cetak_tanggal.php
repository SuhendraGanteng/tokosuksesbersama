<?php
$servername = 'localhost';
$username   = 'root';
$password   = '';
$database   = 'tokosuksesbersama';

$koneksi = mysqli_connect($servername, $username, $password, $database);

if (!$koneksi) {
    die('Connection failed: ' . mysqli_connect_error());
}

$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;

$query = "SELECT * FROM pesanan";

if ($start_date && $end_date) {
    // Adjust the end_date to be inclusive of the entire day
    $end_date = date('Y-m-d', strtotime($end_date . ' + 1 day'));

    $query .= " WHERE tanggal BETWEEN '$start_date' AND '$end_date'";
}

$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($koneksi));
}

?>

<!-- ... (kode HTML lainnya) -->
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        h1 {
            text-align: center;
        }

        h3 {
            text-align: center;
        }

        /* p {
            text-align: right;
        } */

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

    <h1>Toko Sukses Bersama</h1>
    <!-- <h3>Jl.Serdam Raya, Kelurahan  Punggur Kecil, Kecamatan Sungai Kakap, Kabupaten Kubu Raya, Provinsi Kalimantan Barat</h3> -->
    <!-- <?php
            $end_date_minus_one_day = date('Y-m-d', strtotime($end_date . ' - 2 day'));
            ?>
    <p>Periode Cetakan: <?= date('j M Y', strtotime($start_date)); ?> - <?= date('j M Y', strtotime($end_date_minus_one_day)); ?></p> -->


    <hr>
    <P>
        <b>LAPORAN PENJUALAN</b>
    </P>
    <p> Tanggal <?= date('j M Y', strtotime($start_date)); ?> - <?= date('j M Y', strtotime($end_date . ' - 1 day')); ?></p>




    <table>
        <tr>
            <th>No</th>
            <th>No Pesanan</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Status</th>
            <th>Total Bayar</th>
        </tr>

        <?php
        $totalSudahBayar = 0; // Initialize the total payment for 'belum bayar' orders
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) :
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['no_pesanan']; ?></td>
                <td><?= date('j M Y', strtotime($row['tanggal'])); ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['status'] ?></td>
                <td style="text-align:right;"><?= 'Rp ' . number_format($row['total_bayar'], 0, ',', '.') ?></td>

            </tr>

        <?php
            if ($row['status'] !== 'Belum Bayar') {
                $totalSudahBayar += $row['total_bayar']; // Add the total for 'belum bayar' orders
            }
        endwhile;
        ?>
        <tr>
            <td colspan="5"><strong>Total sudah bayar:</strong></td>
            <td style="text-align:right;"><strong><?= 'Rp ' . number_format($totalSudahBayar, 0, ',', '.') ?></strong></td>
        </tr>
    </table>


    <!-- <p>TTD Pemilik</p>

    <p>(.......................)</p> -->


    <script>
        window.print();
    </script>

</body>

</html>