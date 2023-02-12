<?php

error_reporting(1);

$server = "localhost";
$user = "root";
$pass = "";
$database = "pln_inventory";

$db = mysqli_connect($server, $user, $pass, $database);

if (!$db) {
    die("<script>alert('Gagal tersambung dengan database.')</script>");
}
