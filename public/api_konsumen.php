<?php

$url = "https://siskaperbapo.jatimprov.go.id/harga/tabel.nodesign/";

// Data yang akan dikirim (POST)
$postData = http_build_query([
    'tanggal' => date('Y-m-d'), // Menggunakan tanggal hari ini secara otomatis
    'kabkota' => 'blitarkab'
]);

// Header request
$headers = [
    "accept: */*",
    "content-type: application/x-www-form-urlencoded; charset=UTF-8",
    "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36",
    "x-requested-with: XMLHttpRequest"
];

// Inisialisasi cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Eksekusi cURL
$response = curl_exec($ch);
curl_close($ch);

// Cek jika respons valid
if (!$response) {
    echo json_encode(["error" => "Gagal mengambil data"]);
    exit;
}

// Load HTML ke DOMDocument
$dom = new DOMDocument();
libxml_use_internal_errors(true);
$dom->loadHTML($response);
libxml_clear_errors();

// XPath untuk mencari tabel
$xpath = new DOMXPath($dom);
$rows = $xpath->query("//table[contains(@class, 'table')]/tr");

// Debugging jumlah data yang ditemukan
if ($rows->length === 0) {
    echo json_encode(["error" => "Tabel tidak ditemukan"]);
    exit;
}

// Daftar item yang harus diabaikan
$excludeItems = [
    "Semen Gresik",
    "Semen Tiga Roda",
    "Semen Padang",
    "Semen Tonasa",
    "Semen Bosowa",
    "Semen Dynamix",
    "KAYU BALOK MERANTI (4 X 10)",
    "Papan Meranti (4m X 3cm X 20mm)",
    "TRIPLEK (6MM)",
    "Besi Beton 6 mm (12/9m)",
    "Besi Beton 8 mm (12/9m)",
    "Besi Beton 10 mm (12/9m)",
    "Besi Beton 12 mm (12/9m)",
    "Paku Ukuran 10Cm",
    "Paku Ukuran 2 Cm",
    "Paku Ukuran 3Cm",
    "Paku Ukuran 4Cm",
    "Paku Ukuran 5Cm",
    "Paku Ukuran 7Cm",
    "GAS ELPIGI 3 Kg",
    "Pupuk KCL Non Subsidi",
    "Pupuk NPK Non Subsidi",
    "Pupuk SP 35 Non Subsidi",
    "Pupuk Urea Non Subsidi",
    "Pupuk ZA Non Subsidi"
];

// Array untuk menyimpan hasil
$data = [];

// Looping setiap baris tabel
foreach ($rows as $row) {
    $cols = $row->getElementsByTagName('td');

    // Lewati baris yang tidak memiliki cukup kolom (misal header)
    if ($cols->length < 7) continue;

    $namaBahanPokok = trim($cols->item(1)->nodeValue);

    // Cek apakah mengandung '- '
    if (strpos($namaBahanPokok, '- ') === false) continue;

    // Hapus '- ' dari nama bahan pokok
    $namaBahanPokok = str_replace('- ', '', $namaBahanPokok);

    // Cek apakah nama bahan pokok ada dalam daftar pengecualian
    if (in_array($namaBahanPokok, $excludeItems)) continue;

    // Parsing data per baris
    $item = [
        "no" => trim($cols->item(0)->nodeValue),
        "nama_bahan_pokok" => $namaBahanPokok,
        "satuan" => trim($cols->item(2)->nodeValue),
        "harga_kemarin" => trim($cols->item(3)->nodeValue),
        "harga_sekarang" => trim($cols->item(4)->nodeValue),
        "perubahan_rp" => trim($cols->item(5)->nodeValue),
        "perubahan_persen" => trim($cols->item(6)->nodeValue)
    ];

    // Tambahkan ke array hasil
    $data[] = $item;
}

// Output hasil dalam format JSON
header('Content-Type: application/json');
echo json_encode($data, JSON_PRETTY_PRINT);
