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

    <h3>Toko Sukses Bersama</h3>

    <table>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Supplier</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Berat</th>
            <th>Keterangan</th>
        </tr>

        <?php

        $servername = 'localhost';
        $username   = 'root';
        $password   = '';
        $database   = 'tokosuksesbersama';

        $koneksi = mysqli_connect($servername, $username, $password, $database);

        if (!$koneksi) {
            die('Connection failed: ' . mysqli_connect_error());
        }

        $no = 1;
        $query = "SELECT produk.*, kategori.nama as nama_kategori, supplier.nama as nama_supplier
                FROM produk
                JOIN kategori ON produk.id_kategori = kategori.id
                JOIN supplier ON produk.id_supplier = supplier.id;
                ";
        $result = mysqli_query($koneksi, $query);


        if (!$result) {
            die("Query failed: " . mysqli_error($koneksi));
        }

        while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama_kategori']; ?></td>
                <td><?= $row['nama_supplier']; ?></td>
                <td><?= $row['nama']; ?></td>
                <td>
                    <?php
                    if ($row['harga'] !== null && $row['harga'] != 0) :
                        echo 'Pcs ' . number_format((float)$row['harga'], 0, ',', '.') . '<br>';
                    endif;

                    if ($row['harga_lusin'] !== null && $row['harga_lusin'] != 0) :
                        echo 'Lusin ' . number_format((float)$row['harga_lusin'], 0, ',', '.') . '<br>';
                    endif;

                    if ($row['harga_kodi'] !== null && $row['harga_kodi'] != 0) :
                        echo 'Kodi ' . number_format((float)$row['harga_kodi'], 0, ',', '.') . '<br>';
                    endif;

                    if ($row['harga_gross'] !== null && $row['harga_gross'] != 0) :
                        echo 'Gross ' . number_format((float)$row['harga_gross'], 0, ',', '.');
                    endif;
                    ?>
                </td>
                <td><?= $row['stok']; ?></td>
                <td><?= $row['berat']; ?></td>
                <td><?= $row['keterangan']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <script>
        window.print();
    </script>

</body>

</html>