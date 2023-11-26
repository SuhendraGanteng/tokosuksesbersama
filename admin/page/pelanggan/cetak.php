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

    <h3>Indosegarasa</h3>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Alamat</th>
        </tr>

        <?php

        $servername = 'localhost';
        $username   = 'root';
        $password   = '';
        $database   = 'jual';

        $koneksi = mysqli_connect($servername, $username, $password, $database);

        if (!$koneksi) {
            die('Connection failed: ' . mysqli_connect_error());
        }

        $no = 1;
        $query = "SELECT * FROM user WHERE level = 2";
        $result = mysqli_query($koneksi, $query);


        if (!$result) {
            die("Query failed: " . mysqli_error($koneksi));
        }

        while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['no_hp']; ?></td>
                <td><?= $row['alamat']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <script>
        window.print();
    </script>

</body>

</html>