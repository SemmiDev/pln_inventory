<?php

include 'koneksi.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM material WHERE material_id = '$id'";
    $query = mysqli_query($db, $sql);

    if ($query) {
        header('Location: index.php?status=sukses%20dihapus');
    } else {
        header('Location: index.php?status=gagal%20dihapus');
    }
}
