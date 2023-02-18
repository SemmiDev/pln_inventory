<?php

include 'koneksi.php';

$input = $_GET['input'];
$input = json_decode($input);
$barangKeluar = $input->barang_keluar;

$totalKeluar = 0;
foreach ($barangKeluar as $barang) {
    $materialDesc = $barang->material_description;
    $jumlahKeluar = $barang->jumlah_keluar;
    $totalKeluar += $jumlahKeluar;

    $sql = "UPDATE material SET stock_sap = stock_sap - $jumlahKeluar WHERE material_description = '$materialDesc'";
    $result = mysqli_query($db, $sql);

    $sql = "SELECT * FROM material WHERE material_description = '$materialDesc'";
    $result = mysqli_query($db, $sql);
    $data = mysqli_fetch_object($result);

    date_default_timezone_set('Asia/Jakarta');
    $createdAt = $input->created_at;  // 2023-03-10
    $currenHourMinute = date('H:i:s'); //  00:00:00
    $format = $createdAt . ' ' . $currenHourMinute;  // 2023-03-10 00:00:00
}

$sql = "INSERT INTO transactions(
        material_id,
        created_at,
        material_description,
        terima,
        keluar,
        keterangan,
        jumlah_saldo
    ) VALUES (
        '$data->material_id',
        '$format',
        '$data->material_description',
        0,
        '$totalKeluar',
        '$input->keterangan',
        '$data->stock_sap'
    )";

$result = mysqli_query($db, $sql);
?>

<!DOCTYPE html>
<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Done</title>

</head>



<body>
    <script>
        localStorage.removeItem('input');
        localStorage.removeItem('total');
        window.location.href = "index.php";
    </script>
</body>



</html>
