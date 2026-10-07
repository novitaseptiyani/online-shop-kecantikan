<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "20222_wp2_412023015";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");

?>
