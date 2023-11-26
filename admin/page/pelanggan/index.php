<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="py-3 mb-4 text-white">
        Pelanggan
    </h4>
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="page/pelanggan/cetak.php" target="_blank" class="btn rounded-pill btn-success">Cetak</a>
                        </div>
                    </div>
                    <div class="table-responsive text-nowrap mt-3">
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No HP</th>
                                    <th>Alamat</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(function() {
        $('#table').DataTable();
    });
</script>