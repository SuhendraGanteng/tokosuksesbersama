<div class="container-xxl">
<h4 class="py-3 mb-1 text-dark">
        Pesanan
    </h4>
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- <div class="col-lg-12">
                            <a href="page/pesanan/cetak.php" target="_blank" class="btn rounded-pill btn-success">Cetak</a>
                        </div> -->
                        <div class="col-sm-4">
                    <!-- <select id="jenis-cetak" class="form-select">
                        <option selected>Pilih jenis cetakan</option>
                        <option value="tanggal">Cetakan Berdasarkan Tanggal</option>
                        <option value="harian">Cetakan Harian</option>
                        <option value="bulan">Cetakan Berdasarkan Bulan</option>
                        <option value="tahun">Cetakan Berdasarkan Tahun</option>
                    </select> -->
                    </div>
                   

                    <!-- Formulir pencarian berdasarkan tanggal -->
                    <form action="page/pesanan/cetak_tanggal.php" method="get">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="start_date" class="form-label">Dari Tanggal</label>
                                <input type="date" class="form-control" id="start_date" name="start_date">
                            </div>
                            <div class="col-md-2">
                                <label for="end_date" class="form-label">Sampai Tanggal</label>
                                <input type="date" class="form-control" id="end_date" name="end_date">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-warning text-dark mt-4">Cetak</button>
                            </div>
                        </div>
                    </form>

                    <!-- Formulir pencarian harian -->
                    <!-- <form id="form-harian" action="page/pesanan/cetak_harian.php" method="get">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="day" class="form-label">Dari Hari</label>
                                <input type="date" class="form-control" id="day" name="day">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn rounded-pill btn-success mt-4">Cetak</button>
                            </div>
                        </div>
                    </form> -->

                    <!-- Formulir pencarian berdasarkan bulan -->
                    <!-- <form id="form-bulan" action="page/pesanan/cetak_bulan.php" method="get">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="month" class="form-label">Dari Bulan</label>
                                <input type="month" class="form-control" id="month" name="month">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn rounded-pill btn-success mt-4">Cetak</button>
                            </div>
                        </div>
                    </form> -->

                    <!-- Formulir pencarian berdasarkan tahun -->
                    <!-- <form id="form-tahun" action="page/pesanan/cetak_tahun.php" method="get">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="year" class="form-label">Tahun</label>
                                <select class="form-select" id="year" name="year">
                                    <option value="">Pilih Tahun</option>
                                    <?php
                                    $currentYear = date("Y");
                                    for ($i = $currentYear - 10; $i <= $currentYear; $i++) {
                                        echo "<option value=\"$i\">$i</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn rounded-pill btn-warning mt-4">Cetak</button>
                            </div>
                        </div>
                    </form> -->

                    <script>
                        // Menggunakan JavaScript untuk mengontrol tampilan formulir berdasarkan pilihan pengguna
                        const jenisCetak = document.getElementById("jenis-cetak");
                        const formTanggal = document.getElementById("form-tanggal");
                        const formHarian = document.getElementById("form-harian");
                        const formBulan = document.getElementById("form-bulan");
                        const formTahun = document.getElementById("form-tahun");

                        // Sembunyikan semua formulir pada awalnya
                        formTanggal.style.display = "none";
                        formHarian.style.display = "none";
                        formBulan.style.display = "none";
                        formTahun.style.display = "none";

                        jenisCetak.addEventListener("change", function() {
                            const selectedOption = jenisCetak.options[jenisCetak.selectedIndex].value;

                            // Sembunyikan semua formulir terlebih dahulu
                            formTanggal.style.display = "none";
                            formHarian.style.display = "none";
                            formBulan.style.display = "none";
                            formTahun.style.display = "none";

                            // Tampilkan formulir sesuai dengan pilihan pengguna
                            if (selectedOption === "tanggal") {
                                formTanggal.style.display = "block";
                            } else if (selectedOption === "harian") {
                                formHarian.style.display = "block";
                            } else if (selectedOption === "bulan") {
                                formBulan.style.display = "block";
                            } else if (selectedOption === "tahun") {
                                formTahun.style.display = "block";
                            }
                        });
                    </script>
                    </div>
                    <div class="table-responsive text-nowrap mt-3 text-dark">
                        <table class="table text-dark" id="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Pesanan</th>
                                    <th>No Resi</th>
                                    <th>Nama</th>
                                    <th>Kurir</th>
                                    <th>Total Bayar</th>
                                    <th>Status Bayar</th>
                                    <th>Tanggal</th>
                                    <th class="d-flex justify-content-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php
                                $no = 1;
                                $query = "SELECT * FROM pesanan";
                                $result = mysqli_query($koneksi, $query);


                                if (!$result) {
                                    die("Query failed: " . mysqli_error($koneksi));
                                }

                                while ($row = mysqli_fetch_assoc($result)) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['no_pesanan']; ?></td>
                                        <td><?= $row['no_resi']; ?></td>
                                        <td><?= $row['nama']; ?></td>
                                        <td><?= $row['kurir']; ?></td>
                                        <td><?= number_format($row['total_bayar'], 0, ',', '.') ?></td>
                                        <!-- <td><?= $row['status'] == 'Belum Bayar' ? '<span class="badge text-warning">Belum Bayar</span>' : '<span class="badge text-success">Sudah Bayar</span>'; ?></td> -->
                                        <td><span class="badge <?= $row['status'] == 'Belum Bayar' ? 'text-warning' : 'text-success'; ?>"><?= $row['status'] ?></span></td>
                                        <td><?= date('j M Y', strtotime($row['tanggal'])); ?></td>
                                        <td><button type="button" class="btn btn-sm border-dark" id="btn-update-no-resi" data-no-pesanan="<?= $row['no_pesanan']; ?>" data-bs-toggle="modal" data-bs-target="#modal-update-no-resi">Update No Resi</button>
                                        
                                            <a class="btn btn-warning" href="?page=pesanan&aksi=detail&nomor=<?= $row['no_pesanan']; ?>">Detail</a>
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
    <div class="modal fade" id="modal-update-no-resi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Update Nomor Resi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="no_pesanan">No Pesanan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="no_pesanan" id="no_pesanan" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="no_resi">No Resi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="no_resi" id="no_resi">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-warning" name="simpan-no-resi">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['simpan-no-resi'])) {
    $no_pesanan = $_POST['no_pesanan'];
    $no_resi = $_POST['no_resi'];

    $query  = "UPDATE pesanan SET no_resi = '$no_resi' WHERE no_pesanan = '$no_pesanan'";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    } else {
        echo "<script>alert('Nomor resi berhasil diupdate.');window.location='?page=pesanan';</script>";
    }
}
?>


<script>
    $(function() {
        $('#table').DataTable();
    });
    $(document).on('click', '#btn-update-no-resi', function() {
        const no_resi = $(this).data('no-pesanan');
        $('#no_pesanan').val(no_resi);
    });
</script>