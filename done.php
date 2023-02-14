<?php

include 'koneksi.php';

$input = $_GET['input'];
$input = json_decode($input);
$barangKeluar = $input->barang_keluar;

foreach ($barangKeluar as $barang) {
    $materialCode = $barang->material_code;
    $jumlahKeluar = $barang->jumlah_keluar;

    $sql = "UPDATE material SET stock_sap = stock_sap - $jumlahKeluar WHERE material_code = '$materialCode'";
    $result = mysqli_query($db, $sql);

    $sql = "SELECT * FROM material WHERE material_code = '$materialCode'";
    $result = mysqli_query($db, $sql);
    $data = mysqli_fetch_object($result);

    $sql = "INSERT INTO transactions(
        material_code,
        created_at,
        material_description,
        terima,
        keluar,
        keterangan,
        jumlah_saldo
    ) VALUES (
        '$materialCode',
        '$input->created_at',
        '$data->material_description',
        0,
        $jumlahKeluar,
        'Keluar',
        $data->stock_sap
    )";

    $result = mysqli_query($db, $sql);
}

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
