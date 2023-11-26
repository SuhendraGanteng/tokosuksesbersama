<div class="container-xxl">
<h4 class="py-3 mb-1 text-dark">
        Pemasok
    </h4>
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <div>
                            <a href="?page=supplier&aksi=tambah" class="btn btn-warning text-dark">Tambah</a>
                            <!-- <a href="page/supplier/cetak.php" target="_blank" class="btn btn-warning text-dark">Cetak</a> -->
                        </div>
                    </div>
                    <div class="table-responsive text-nowrap mt-3">
                        <table class="table" id="table">
                            <thead> 
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php
                                $no = 1;
                                $query = "SELECT * FROM supplier";
                                $result = mysqli_query($koneksi, $query);


                                if (!$result) {
                                    die("Query failed: " . mysqli_error($koneksi));
                                }

                                while ($row = mysqli_fetch_assoc($result)) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['nama']; ?></td>
                                        <td><?= substr($row['alamat'], 0, 60) .'...'; ?></td>
                                        <td><?= $row['keterangan']; ?></td>
                                        <td>
                                            <a href="?page=supplier&aksi=edit&id=<?= $row['id']; ?>" class="btn border-dark"><i class='bx bx-pencil'></i></a>
                                            <a href="?page=supplier&aksi=hapus&id=<?= $row['id']; ?>" class="btn border-dark" onclick="return confirm('Anda yakin akan menghapus data tersebut?')"><i class='bx bx-trash'></i></a>
                                        </td>
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