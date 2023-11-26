<?php
if ($_SESSION['level'] != '2') {
    header('Location: login.php');
    exit;
}

$idUser = $_SESSION['id'];

// Mendapatkan total berat & harga
$totalQtyHargaQuery = "SELECT keranjang.*,  produk.berat as berat_produk, keranjang.harga as harga_produk
                        FROM keranjang
                        JOIN produk ON keranjang.id_produk = produk.id
                        WHERE keranjang.id_user = '$idUser'";
$totalQtyHargaResult = mysqli_query($koneksi, $totalQtyHargaQuery);

$totalBerat = 0;
$totalHarga = 0;

while ($data = mysqli_fetch_assoc($totalQtyHargaResult)) {
    $qty = $data['qty'];
    $harga = $data['harga_produk'];
    $berat = $data['berat_produk'];

    $totalBerat += ($qty * $berat);
    $totalHarga += $harga;
}

?>
<!-- Content -->
<div class="container mt-3">
    <div class="row">
        <div class="col-md-12 mt-3">
            <h3 class="text-dark">
                Checkout
            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7 mt-1">
                Silahkan lengkapi data dibawah ini untuk membuat pesanan.
        </div>
    </div>
    <form method="post">
        <input type="hidden" name="total_harga" value="<?= $totalHarga ?>">
        <input type="hidden" name="ongkos_kirim" id="ongkos-kirim-input">
        <input type="hidden" name="total_bayar" id="total-bayar-input">
        <div class="row">
            <div class="col-md-7 mt-1">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label text-dark" for="nama">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama" id="nama" value="<?= $_SESSION['nama'] ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label text-dark" for="no_hp">No HP</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="no_hp" id="no_hp" value="<?= $_SESSION['no_hp'] ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label text-dark" for="kota">Kota</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="kota" id="kota">
                                    <option value=""></option>
                                    <?php
                                    $query = "SELECT * FROM kota WHERE provinsi_id = 12 ";
                                    $result = mysqli_query($koneksi, $query);
                                    if (!$result) {
                                        die("Query failed: " . mysqli_error($koneksi));
                                    }
                                    while ($row = mysqli_fetch_assoc($result)) : ?>
                                        <option value="<?= $row['kota_id'] . '_' . $row['nama'] ?>"><?= $row['nama'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label text-dark" for="berat">Berat (Gram)</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="berat" id="berat" value="<?= $totalBerat ?>" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label text-dark" for="kurir">Kurir</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="kurir" id="kurir">
                                    <option value=""></option>
                                    <?php
                                    $query = "SELECT * FROM kurir";
                                    $result = mysqli_query($koneksi, $query);
                                    if (!$result) {
                                        die("Query failed: " . mysqli_error($koneksi));
                                    }

                                    while ($row = mysqli_fetch_assoc($result)) : ?>
                                        <option value="<?= $row['kode'] ?>"><?= $row['nama'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label text-dark" for="layanan">Layanan</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="layanan" id="layanan"></select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label text-dark" for="alamat">Alamat</label>
                            <div class="col-sm-10">
                                <textarea name="alamat" id="alamat" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-1">
                <div class="card">
                    <div class="card-body">
                        <p class="card-text"><span class="float-end fw-bold">Rp <?= number_format($totalHarga, 0, ',', '.') ?></span>Total Harga</p>
                        <p class="card-text"><span class="float-end fw-bold" id="ongkos-kirim"></span>Ongkos Kirim</p>
                        <p class="card-text"><span class="float-end fw-bold" id="total-bayar"></span>Total Bayar</p>
                        <button type="submit" class="btn btn-warning text-dark" name="buat-pesanan" id="buat-pesanan" disabled>Buat Pesanan</button>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>

<?php
require_once 'vendor/autoload.php';

if (isset($_POST['buat-pesanan'])) {
    $pecah      = explode('_', $_POST['layanan']);
    $layananBaru = $pecah[0] . ' - ' . 'Estimasi ' . $pecah[2] . ' Hari';
    $alamatBaru = $_POST['alamat'] . ' ' . explode('_', $_POST['kota'])[1] . ' Kalimantan Barat';

    // Input ke tabel pesanan
    $id_user = $_SESSION['id'];
    $no_pesanan = 'NP' . time();
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $berat = $_POST['berat'];
    $kurir = $_POST['kurir'];
    $layanan = $_POST['layanan'];
    $total_harga = $_POST['total_harga'];
    $ongkos_kirim = $_POST['ongkos_kirim'];
    $total_bayar = $_POST['total_bayar'];
    $alamat = $_POST['alamat'];
    $ket = 'Dalam Pengiriman';

    $queryInputPesanan  = "INSERT INTO pesanan (id_user, no_pesanan, nama, no_hp, berat, kurir, layanan, total_harga, ongkos_kirim, total_bayar, alamat, keterangan) VALUES ('$id_user', '$no_pesanan', '$nama', '$no_hp', '$berat', '$kurir', '$layanan', '$total_harga', '$ongkos_kirim', '$total_bayar', '$alamatBaru', '$ket')";
    $resultInputPesanan = mysqli_query($koneksi, $queryInputPesanan);

    if (!$resultInputPesanan) {
        die("Query gagal dijalankan pada saat input ke tabel pesanan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    }

    // Mengambil ID pesanan yang baru saja di-generate
    $id_pesanan = mysqli_insert_id($koneksi);

    // Mengambil data pesanan yang baru diinput
    $queryGetPesanan  = "SELECT * FROM pesanan WHERE id='$id_pesanan'";
    $resultGetPesanan = mysqli_query($koneksi, $queryGetPesanan);

    if (!$resultGetPesanan) {
        die("Query failed: " . mysqli_error($koneksi));
    }

    $dataGetPesanan = mysqli_fetch_assoc($resultGetPesanan);

    // Set your Merchant Server Key
    Midtrans\Config::$serverKey    = 'SB-Mid-server-g1xgwS71x-r-rdzLX4q-e2Cs';
    // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    Midtrans\Config::$isProduction = false;
    // Set sanitization on (default)
    Midtrans\Config::$isSanitized  = true;
    // Set 3DS transaction for credit card to true
    Midtrans\Config::$is3ds        = true;

    $params = [
        'transaction_details'   => [
            'order_id'          => $dataGetPesanan['no_pesanan'],
            'gross_amount'      => $dataGetPesanan['total_bayar'],
        ],
        'customer_details'      => [
            'firt_name'         => $dataGetPesanan['nama'],
            'last_name'         => '',
            'phone'             => $dataGetPesanan['no_hp'],
        ]
    ];

    $snapToken = Midtrans\Snap::getSnapToken($params);

    // Update snap token pesanan
    $idPesanan = $dataGetPesanan['id'];
    $queryUpdateTokenPesanan = "UPDATE pesanan SET snap_token = '$snapToken' WHERE id = '$idPesanan'";
    $resultUpdateTokenPesanan = mysqli_query($koneksi, $queryUpdateTokenPesanan);

    if (!$resultUpdateTokenPesanan) {
        die("Query gagal dijalankan pada saat update snap token pesanan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    }

    // Pindahkan data cart ke table order details
    // Dan kurangi stok product
    // $queryGetKeranjang = "SELECT * FROM keranjang WHERE id_user = '$idUser'";
    $queryGetKeranjang = "SELECT keranjang.*,  produk.nama as nama_produk, keranjang.harga as harga_produk
                        FROM keranjang
                        JOIN produk ON keranjang.id_produk = produk.id
                        WHERE keranjang.id_user = '$idUser'";
    $resultGetKeranjang = mysqli_query($koneksi, $queryGetKeranjang);

    if (!$resultGetKeranjang) {
        die("Query failed: " . mysqli_error($koneksi));
    }

    while ($row = mysqli_fetch_assoc($resultGetKeranjang)) {
        // Mengambil data produk dari database
        $idProduk = $row['id_produk'];
        $queryProduk = "SELECT * FROM produk WHERE id = $idProduk";
        $resultProduk = mysqli_query($koneksi, $queryProduk);

        if (mysqli_num_rows($resultProduk) > 0) {
            // Mendapatkan data produk
            $stok = mysqli_fetch_assoc($resultProduk)["stok"];

            // Mengupdate stok produk
            $stokBaru = $stok - $row['qty'];
            $queryUpdateProduk = "UPDATE produk SET stok = $stokBaru WHERE id = $idProduk";

            $resultUpdateProduk = mysqli_query($koneksi, $queryUpdateProduk);
            if (!$resultUpdateProduk) {
                die("Query failed: " . mysqli_error($koneksi));
            }
        }

        // tambah ke detail pesanan
        $queryDetailPesanan = "INSERT INTO detail_pesanan (id_pesanan, id_user, id_produk, nama_produk, harga, qty)
          VALUES ('" . $dataGetPesanan['id'] . "', '" . $idUser . "', '" . $idProduk . "', '" . $row['nama_produk'] . "', '" . $row['harga_produk'] . "', '" . $row['qty'] . "')";

        $resultDetailPesanan = mysqli_query($koneksi, $queryDetailPesanan);
        if (!$resultDetailPesanan) {
            die("Query failed: " . mysqli_error($koneksi));
        }
    }

    // Menghapus keranjang berdasarkan id user
    $queryHapusKeranjang = "DELETE FROM keranjang WHERE id_user = '$idUser' ";

    $resultHapusKeranjang = mysqli_query($koneksi, $queryHapusKeranjang);
    if (!$resultHapusKeranjang) {
        die("Query failed: " . mysqli_error($koneksi));
    }

    echo "<script>alert('Pesanan berhasil dibuat.');window.location='?page=pesanan';</script>";
}

?>

<script>
    $('#nama, #no_hp, #kota, #berat, #kurir, #layanan, #alamat').keyup(function() {

        if ($('#nama').val() != '' && $('#no_hp').val() != '' && $('#kota').val() != '' && $(
                '#berat').val() != '' && $('#kurir').val() != '' &&
            $('#layanan').val() != '' && $('#alamat').val() != '') {
            $('#buat-pesanan').removeAttr('disabled');
        } else {
            $('#buat-pesanan').attr('disabled', true);
        }

    });

    $(document).on('change', '#kota', function() {
        $('#kurir').val('');
        $('#layanan').empty();
        $('#ongkos-kirim').text('Rp');
        $('#total-bayar').text('Rp');
        $('#ongkos-kirim-input').val('');
        $('#total-bayar-input').val('');
    });

    $(document).on('change', '#kurir', function() {
        const kota = $('#kota').val(); // jatim
        const berat = $('#berat').val(); // 8.000
        const kurir = $(this).val();

        $('#layanan').empty();
        $('#ongkos-kirim').text('Rp');
        $('#total-bayar').text('Rp');
        $('#ongkos-kirim-input').val('');
        $('#total-bayar-input').val('');

        if (kurir) {
            $.ajax({
                url: 'page/checkout/ongkir.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    "kota": kota.split('_')[0],
                    "berat": berat,
                    "kurir": kurir,
                },
                success: function(data) {
                    // console.log(data);

                    const ongkosKirim = data[0].cost[0].value;
                    const totalHarga = '<?= $totalHarga ?>';
                    const totalBayar = ongkosKirim + parseFloat(totalHarga);

                    $('#ongkos-kirim').text(`Rp${ongkosKirim.toLocaleString('id-ID')}`);
                    $('#total-bayar').text(`Rp${totalBayar.toLocaleString('id-ID')}`);
                    $('#ongkos-kirim-input').val(ongkosKirim);
                    $('#total-bayar-input').val(totalBayar);
                    $('#layanan').empty();

                    $.each(data, function(key, val) {
                        // OKE (Ongkos Kirim Ekonomis) - Biaya 12000 - Estimasi 2-3 Hari
                        $('#layanan').append(`
                                <option value="${val.service} (${val.description})_${val.cost[0].value}_${val.cost[0].etd}">
                                    ${val.service} (${val.description}) - Biaya (Rp${val.cost[0].value.toLocaleString('id-ID')}) - Estimasi (${val.cost[0].etd} hari)
                                </option>
                            `);
                    });
                }
            });
        } else {
            $('#layanan').empty();
        }
    });

    $(document).on('change', '#layanan', function() {
        const layanan = $(this).val();
        const totalHarga = '<?= $totalHarga ?>';

        // Contoh data: OKE (Ongkos Kirim Ekonomis)_12000_2-3
        const ongkosKirim = parseFloat(layanan.split('_')[1]);
        const totalBayar = ongkosKirim + parseFloat(totalHarga);

        $('#ongkos-kirim').text(`Rp${ongkosKirim.toLocaleString('id-ID')}`);
        $('#total-bayar').text(`Rp${totalBayar.toLocaleString('id-ID')}`);
        $('#ongkos-kirim-input').val(ongkosKirim);
        $('#total-bayar-input').val(totalBayar);
    });
</script>
<!-- / Content -->