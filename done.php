<?php

include 'koneksi.php';

$barangKeluar = $_GET['barang_keluar'];
$barangKeluar = json_decode($barangKeluar);

// loop and update the stock_sap in database based on material_code
foreach ($barangKeluar as $barang) {
    $materialCode = $barang->material_code;
    $jumlahKeluar = $barang->jumlah_keluar;
    // stock_spa -= $jumlahKeluar
    $sql = "UPDATE material SET stock_sap = stock_sap - $jumlahKeluar WHERE material_code = '$materialCode'";
    $result = mysqli_query($db, $sql);
}
?>


<script>
// remove input from local storage
localStorage.removeItem('input');
// redirect index.php
window.location.href = "index.php";
</script>
