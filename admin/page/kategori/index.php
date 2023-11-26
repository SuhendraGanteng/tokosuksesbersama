
<div class="container-xxl">
<h4 class="py-3 mb-1 text-dark">
        Kategori
    </h4>
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <div>
                            <a href="?page=kategori&aksi=tambah" class="btn btn-warning text-dark">Tambah</a>
                            <!-- <a href="page/kategori/cetak.php" target="_blank" class="btn btn-warning text-dark">Cetak</a> -->
                        </div>
                    </div>
                    <div class="table-responsive text-nowrap mt-3">
                        <table class="table" id="table" >
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php
                                $no = 1;
                                $query = "SELECT * FROM kategori";
                                $result = mysqli_query($koneksi, $query);


                                if (!$result) {
                                    die("Query failed: " . mysqli_error($koneksi));
                                }

                                while ($row = mysqli_fetch_assoc($result)) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['nama']; ?></td>
                                        <td>
                                            <a href="assets/img/kategori/<?= $row['gambar']; ?>" target="_blank">
                                                <img src="assets/img/kategori/<?= $row['gambar']; ?>" alt="" srcset="" width="80" height="60">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="?page=kategori&aksi=edit&id=<?= $row['id']; ?>" class="btn border-dark"><i class='bx bx-pencil'></i></a>
                                            <a href="?page=kategori&aksi=hapus&id=<?= $row['id']; ?>" class="btn border-dark" onclick="return confirm('Anda yakin akan menghapus data tersebut?')"><i class='bx bx-trash'></i></a>
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