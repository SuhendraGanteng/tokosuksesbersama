<?php
if ($_SESSION['level'] != '2') {
    header('Location: login.php');
    exit;
}
?>
<!-- Content -->
<div class="container mt-3">
    <div class="row">
        <div class="col-md-12 mt-3">
            <h3 class="text-black">
            Pesanan
            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive mt-3">
                        <table class="table text-dark" id="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Pembayaran</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th class="d-flex justify-content-end">Aksi</th>
                                    
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php
                                $no = 1;
                                $idUser = $_SESSION['id'];
                                $query = "SELECT * FROM pesanan WHERE id_user = '$idUser' ";
                                $result = mysqli_query($koneksi, $query);

                                if (!$result) {
                                    die("Query failed: " . mysqli_error($koneksi));
                                }

                                while ($row = mysqli_fetch_assoc($result)) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= date('j M Y', strtotime($row['tanggal'])); ?></td>
                                        <td>Rp <?= number_format($row['total_bayar'], 0, ',', '.') ?></td>
                                        <td><span class="badge <?= $row['status'] == 'Belum Bayar' ? 'bg-warning' : 'bg-success'; ?>"><?= $row['status'] ?></span></td>
                                        <td>
                                        <span class="badge p-2 <?= $row['keterangan'] == 'Paket diterima' ? 'bg-success' : 'bg-warning' ; ?>" ><?= $row['keterangan'] ?></span>
                                        </td>
                                        <td>
                                            <!-- <button type="button" class="btn btn-primary" id="pilih-pembayaran" <?= $row['status'] == 'Belum Bayar' ? '' : 'disabled'; ?> data-snaptoken="<?= $row['snap_token'] ?>">Pilih Pembayaran</button> -->
                                            <?php if ($row['status'] === 'Belum Bayar') : ?>
                                                <button type="button" class="badge bg-success" data-snaptoken="<?= $row['snap_token'] ?>" id="btn-pilih-pembayaran">Pilih Pembayaran</button>
                                            <?php else : ?>
                                                <button type="button" class="badge bg-success" id="btn-pilih-pembayaran" disabled>Pilih Pembayaran</button>
                                            <?php endif; ?>
                                        </td>
                                        <td><a class="btn btn-warning" href="?page=pesanan&aksi=detail&no=<?= $row['no_pesanan']; ?>">Detail</a></td>
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

<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    // var payButton = document.getElementById('pilih-pembayaran');
    // payButton.addEventListener('click', function() {
    //     console.log('OK')
    // });

    // const nodes = element.getElementsByTagName("p");
</script>

<script>
    $(document).on('click', '#btn-pilih-pembayaran', function() {
        const snapToken = $(this).data('snaptoken');
        window.snap.pay(snapToken, {
            onSuccess: function(result) {
                /* You may add your own implementation here */
                // alert("payment success!");
                // console.log(result);
                window.location = '?page=pesanan'
            },
            onPending: function(result) {
                /* You may add your own implementation here */
                alert("wating your payment!");
                // console.log(result);
            },
            onError: function(result) {
                /* You may add your own implementation here */
                alert("payment failed!");
                // console.log(result);
            },
            onClose: function() {
                /* You may add your own implementation here */
                alert('you closed the popup without finishing the payment');
            }
        });
    });
</script>