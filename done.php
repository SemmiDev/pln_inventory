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

    $sql = "INSERT INTO material_out(
        material_code,
        total,
        created_at,
        letter_number,
        letter_to,
        letter_for,
        based_on,
        contract_spk_factur,
        tug8_tug9,
        delivery_with
    ) VALUES (
        '$materialCode',
        '$jumlahKeluar',
        '$input->created_at',
        '$input->letter_number',
        '$input->letter_to',
        '$input->letter_for',
        '$input->based_on',
        '$input->contract_spk_factur',
        '$input->tug8_tug9',
        '$input->delivery_with'
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
    window.location.href = "index.php";
    </script>
</body>

</html>