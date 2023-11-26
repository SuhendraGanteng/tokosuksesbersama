<?php
$kota = $_POST['kota'];
$berat = $_POST['berat'];
$kurir = $_POST['kurir'];

$ch = curl_init(); // Inisialisasi cURL

$headers = array(
    'key: 5efe551e2379ddaf663c4e3aa4880746', // Menambahkan header key
);

$data = array(
    'origin' => 364, // Pontianak
    'destination' => $kota,
    'weight' => $berat,
    'courier' => $kurir,
);

$options = array(
    CURLOPT_URL => 'https://api.rajaongkir.com/starter/cost', // URL endpoint
    CURLOPT_RETURNTRANSFER => true, // Mengembalikan response sebagai string
    CURLOPT_POST => true, // Menggunakan metode POST
    CURLOPT_POSTFIELDS => http_build_query($data), // Mengirim data dalam format URL-encoded
    CURLOPT_HTTPHEADER => $headers, // Menambahkan header ke permintaan
);

curl_setopt_array($ch, $options); // Mengatur opsi cURL

$response = curl_exec($ch); // Eksekusi permintaan cURL
$err = curl_error($ch); // Tangkap error cURL

curl_close($ch); // Tutup koneksi cURL

if ($err) {
    echo 'cURL Error #:' . $err; // Menampilkan pesan error jika terjadi kesalahan cURL
} else {
    $response = json_decode($response, true); // Mendecode respons JSON menjadi array asosiatif
    echo json_encode($response['rajaongkir']['results'][0]['costs']); // Mengembalikan respons dalam format JSON
}
